<?php

include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/db.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/access.inc.php';

//****************************************
//Don't forget to update server path
//****************************************

if (!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}

if (!userHasRole('Account Administrator'))
{
	$error = 'Only Account Administrator may access this page.';
	include '../accessdenied.html.php';
	exit();
}

if (isset($_GET['add']))
{
  $pageTitle = 'New User';
  $action = 'addform';
  $firstname = '';
  $lastname = '';
  $email = '';
  $phone = '';
  $interest = '';
  $message = '';
  $password ='';
  $id = '';
  $button = 'Add user';
  $isAdmin = true; // Flag to indicate this is admin user management

  // Fetch all roles
  try {
    $result = $pdo->query('SELECT id, description FROM role');
    $allRoles = $result->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $error = 'Error fetching roles: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  $userRoles = [];

  include 'form.html.php';
  exit();
}

if (isset($_POST['addform']))
{
  try {
    $sql = 'INSERT INTO user SET
              firstname = :firstname,
              lastname = :lastname,
              email = :email,
              phone = :phone,
              interest = :interest,
              message = :message,
              password =:password';
    $s = $pdo->prepare($sql);
    $s->bindValue(':firstname', $_POST['firstname']);
    $s->bindValue(':lastname', $_POST['lastname']);
    $s->bindValue(':email', $_POST['email']);
    $s->bindValue(':phone', $_POST['phone']);
    $s->bindValue(':interest', $_POST['interest']);
    $s->bindValue(':message', $_POST['message']);
    $s->bindValue(':password', $_POST['password']);
    $s->execute();
  } catch (PDOException $e) {
    // Check for duplicate entry or integrity constraint violation
    if ($e->getCode() == 23000) {
      if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
        $error = 'A user with this email already exists.';
      } else {
        $error = 'Could not add user: Integrity constraint violation.';
      }
    } else {
      $error = 'Error adding submitted user: ' . $e->getMessage();
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  $userid = $pdo->lastInsertId();
  // Add password if provided (optional for admin adding users)
  if (isset($_POST['password']) && $_POST['password'] != '') {
    $password = md5($_POST['password'] . 'ijdb');
    try {
      $sql = 'UPDATE user SET password = :password WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':password', $password);
      $s->bindValue(':id', $userid);
      $s->execute();
    } catch (PDOException $e) {
      $error = 'Error setting user password.';
      include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
      exit();
    }
  }
  // Add roles if provided
  if (isset($_POST['roles'])) {
    foreach ($_POST['roles'] as $role) {
      try {
        $sql = 'INSERT INTO userrole SET userid = :userid, roleid = :roleid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':userid', $userid);
        $s->bindValue(':roleid', $role);
        $s->execute();
      } catch (PDOException $e) {
        $error = 'Error assigning selected role to user.';
        include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
        exit();
      }
    }
  }
  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
  try {
    $sql = 'SELECT id, firstname, lastname, email, phone, interest, message FROM user WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Error fetching user details.';
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  $row = $s->fetch();
  $pageTitle = 'Edit User';
  $action = 'editform';
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $phone = $row['phone'];
  $interest = $row['interest'];
  $message = $row['message'];
  $id = $row['id'];
  $button = 'Update user';
  $isAdmin = true;
  // Fetch all roles
  try {
    $result = $pdo->query('SELECT id, description FROM role');
    $allRoles = $result->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $error = 'Error fetching roles: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  // Fetch user roles
  try {
    $result = $pdo->prepare('SELECT roleid FROM userrole WHERE userid = :userid');
    $result->bindValue(':userid', $id);
    $result->execute();
    $userRoles = array_map(function($row) { return $row['roleid']; }, $result->fetchAll(PDO::FETCH_ASSOC));
  } catch (PDOException $e) {
    $error = 'Error fetching user roles: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  include 'form.html.php';
  exit();
}

if (isset($_POST['editform']))
{
  // Check for duplicate email (other than this user)
  try {
    $sql = 'SELECT COUNT(*) FROM user WHERE email = :email AND id != :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':email', $_POST['email']);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
    $count = $s->fetchColumn();
    
  } catch (PDOException $e) {
    $error = 'Error checking for duplicate email: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  try {
    $sql = 'UPDATE user SET
      firstname = :firstname,
      lastname = :lastname,
      email = :email,
      phone = :phone,
      interest = :interest,
      message = :message
      WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':firstname', $_POST['firstname']);
    $s->bindValue(':lastname', $_POST['lastname']);
    $s->bindValue(':email', $_POST['email']);
    $s->bindValue(':phone', $_POST['phone']);
    $s->bindValue(':interest', $_POST['interest']);
    $s->bindValue(':message', $_POST['message']);
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Error updating submitted user.';
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  if (isset($_POST['password']) && $_POST['password'] != '') {
    $password = md5($_POST['password'] . 'ijdb');
    try {
      $sql = 'UPDATE user SET password = :password WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':password', $password);
      $s->bindValue(':id', $_POST['id']);
      $s->execute();
    } catch (PDOException $e) {
      $error = 'Error setting user password.';
      include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
      exit();
    }
  }
  // Remove all roles for this user
  try {
    $sql = 'DELETE FROM userrole WHERE userid = :userid';
    $s = $pdo->prepare($sql);
    $s->bindValue(':userid', $_POST['id']);
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Error removing old user roles: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  // Add new roles
  if (isset($_POST['roles'])) {
    foreach ($_POST['roles'] as $role) {
      try {
        $sql = 'INSERT INTO userrole SET userid = :userid, roleid = :roleid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':userid', $_POST['id']);
        $s->bindValue(':roleid', $role);
        $s->execute();
      } catch (PDOException $e) {
        $error = 'Error assigning selected role to user.';
        include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
        exit();
      }
    }
  }
  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
  try {
    $sql = 'DELETE FROM user WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Error deleting user.';
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

// Display user list
try {
  $result = $pdo->query('SELECT id, firstname, lastname, email, phone, interest, message FROM user');
} catch (PDOException $e) {
  $error = 'Error fetching users from the database!';
  include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
  exit();
}

$users = [];
try {
  foreach ($result as $row) {
    $users[] = array(
      'id' => $row['id'],
      'firstname' => $row['firstname'],
      'lastname' => $row['lastname'],
      'email' => $row['email'],
      'phone' => $row['phone'],
      'interest' => $row['interest'],
      'message' => $row['message'],
    );
  }
} catch (PDOException $e) {
  $error = 'Error fetching users from the database!';
  include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
  exit();
}

include 'user.html.php';
