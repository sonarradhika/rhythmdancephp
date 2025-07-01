<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/db.inc.php';


if (isset($_GET['add']))
{
  // Set default values
  $pageTitle = 'New User';
  $action = 'addform';
  $firstname = '';
  $lastname = '';
  $email = '';
  $phone = '';
  $interest = '';
  $message = '';
  $button = 'Register';

  include 'register.html.php';
  exit();
}

if (isset($_GET['addform']))
{
  
  // Input validation (basic)
  if (!isset($_POST['terms'])) {
    $error = 'You must agree to the terms.';
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';

    exit();
  }

  try {
    $sql = 'INSERT INTO user SET
              firstname = :firstname,
              lastname = :lastname,
              email = :email,
              phone = :phone,
              interest = :interest,
              
              message = :message';

    $s = $pdo->prepare($sql);
    $s->bindValue(':firstname', $_POST['firstname']);
    $s->bindValue(':lastname', $_POST['lastname']);
    $s->bindValue(':email', $_POST['email']);
    $s->bindValue(':phone', $_POST['phone']);
    $s->bindValue(':interest', $_POST['interest']);
    $s->bindValue(':message', $_POST['message']);
    
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Error registering new user: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/error.html.php';
    exit();
  }

  header('Location:.'); // Or success.php
  exit();
}
// Quick test output — skip the HTML file for now


include 'register.html.php';
