<?php
include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php';
ob_start();
?>
<h1>Log In</h1>
<p>Please log in to view the page that you requested.</p>
<?php if (isset($loginError)): ?>
    <p><?php echo htmlspecialchars($loginError); ?></p>
<?php endif; ?>
<form action="" method="post">
 <div>
    <label for="email">Email: <input type="text" name="email" id="email"></label>
  </div>
  <div>
    <label for="password">Password: <input type="password" name="password" id="password"></label>
  </div>
  <div>
    <input type="hidden" name="action" value="login">
    <input type="submit" value="Log in">
  </div>
</form>
<p><a href="/rhythmdance/home.php">Return to home</a></p>
<?php
$main = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/templates/template.php';
?>
