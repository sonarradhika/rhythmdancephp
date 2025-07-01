<?php

include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/db.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/access.inc.php';

/*************************************************************
//Don't forget to change server path
/*************************************************************/

if (!userIsLoggedIn())
{
  include '../login.html.php';
  exit();
}

if (!userHasRole('Content Editor'))
{
  $error = 'Only Content Editor may access this page.';
  include '../accessdenied.html.php';
  exit();
}

if (isset($_GET['add']))
{
  $pageTitle = 'New Dance Style';
  $action = 'addform';
  $name = '';
  $description = '';
  $image = '';
  $id = '';
  $button = 'Add dancestyle';

  include 'form.html.php';
  exit();
}

if (isset($_POST['addform']))
{
  // Check for duplicate dance style name
  try {
    $sql = 'SELECT COUNT(*) FROM dance_styles WHERE style_name = :name';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $_POST['name']);
    $s->execute();
    $count = $s->fetchColumn();
    if ($count > 0) {
      $error = 'A dance style with this name already exists.';
      include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
      exit();
    }
  } catch (PDOException $e) {
    $error = 'Error checking for duplicate dance style: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  try {
    $sql = 'INSERT INTO dance_styles (style_name, description, image) VALUES (:name, :description, :image)';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $_POST['name']);
    $s->bindValue(':description', $_POST['description']);
    $s->bindValue(':image', $_POST['image']);
    $s->execute();
  } catch (PDOException $e) {
    if ($e->getCode() == 23000) {
      $error = 'Could not add dance style: Integrity constraint violation.';
    } else {
      $error = 'Error adding submitted dancestyle: ' . $e->getMessage();
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
  try
  {
    $sql = 'SELECT style_id, style_name, description, image FROM dance_styles WHERE style_id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
    $row = $s->fetch();

    $pageTitle = 'Edit Dance Style';
    $action = 'editform';
    $name = $row['style_name'];
    $description = $row['description'];
    $image = $row['image'];
    $id = $row['style_id'];
    $button = 'Update dancestyle';

    include 'form.html.php';
    exit();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching dancestyle details.';
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
}

if (isset($_POST['editform']))
{
  // Check for duplicate dance style name (other than this id)
  try {
    $sql = 'SELECT COUNT(*) FROM dance_styles WHERE style_name = :name AND style_id != :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $_POST['name']);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
    $count = $s->fetchColumn();
    if ($count > 0) {
      $error = 'A dance style with this name already exists.';
      include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
      exit();
    }
  } catch (PDOException $e) {
    $error = 'Error checking for duplicate dance style: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  try {
    $sql = 'UPDATE dance_styles SET style_name = :name, description = :description, image = :image WHERE style_id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':name', $_POST['name']);
    $s->bindValue(':description', $_POST['description']);
    $s->bindValue(':image', $_POST['image']);
    $s->execute();
  } catch (PDOException $e) {
    if ($e->getCode() == 23000) {
      $error = 'Could not update dance style: Integrity constraint violation.';
    } else {
      $error = 'Error updating submitted dancestyle: ' . $e->getMessage();
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }
  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
  try
  {
    $sql = 'DELETE FROM dance_styles WHERE style_id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error deleting dancestyle.';
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

// Display dancestyle list

try
{
  $result = $pdo->query('SELECT style_id, style_name, description, image FROM dance_styles');
  $categories = [];
  foreach ($result as $row)
  {
    $categories[] = array(
      'id' => $row['style_id'],
      'name' => $row['style_name'],
      'description' => $row['description'],
      'image' => $row['image']
    );
  }
}
catch (PDOException $e)
{
  $error = 'Error fetching Dance Styles from database!';
  include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
  exit();
}

include 'categories.html.php';
