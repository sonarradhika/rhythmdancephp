<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php';
ob_start();
?>
<h1><?php htmlout($pageTitle); ?></h1>
<form action="?<?php htmlout($action); ?>" method="post">
  <div>
    <label for="name">Name: <input type="text" name="name"
        id="name" value="<?php htmlout($name); ?>"></label>
  </div>
  <div>
    <label for="description">Description: 
      <textarea name="description" id="description" rows="4" cols="50"><?php htmlout($description); ?></textarea>
  </div>
  <div>
    <label for="image">Image name<input type="text" name="image"
        id="image" value="<?php htmlout($image); ?>"></label>
  </div>
  <div>
    <input type="hidden" name="id" value="<?php htmlout($id); ?>">
    <?php if ($action === 'addform'): ?>
      <input type="hidden" name="addform" value="1">
    <?php elseif ($action === 'editform'): ?>
      <input type="hidden" name="editform" value="1">
    <?php endif; ?>
    <input type="submit" value="<?php htmlout($button); ?>">
  </div>
</form>
<?php
$main = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/templates/template.php';
?>
