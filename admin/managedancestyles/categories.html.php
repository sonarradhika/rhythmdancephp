<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php';
ob_start();
?>
<h1>Manage Dance Styles</h1>
<p><a href="?add">Add new dancestyle</a></p>
<ul>
  <?php foreach ($categories as $dancestyle): ?>
    <li>
      <form action="" method="post" style="margin-bottom:0;">
        <div class="admin-list-row">
          <span>
            <?php htmlout($dancestyle['name']); ?>
          </span>
          <span class="user-actions">
            <input type="hidden" name="id" value="<?php echo $dancestyle['id']; ?>">
            <input type="submit" name="action" value="Edit">
            <input type="submit" name="action" value="Delete">
          </span>
        </div>
      </form>
    </li>
  <?php endforeach; ?>
</ul>
<p><a href="..">Return to home</a></p>
<?php include '../logout.inc.html.php'; ?>
<?php
$main = ob_get_clean();
include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/templates/template.php';
?>
