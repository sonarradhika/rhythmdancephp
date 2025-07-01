<?php include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php'; ?>


    <?php
    ob_start();
    ?>
    <h1>Manage Users</h1>
    <p><a href="?add">Add new user</a></p>
    <ul>
      <?php foreach ($users as $user): ?>
        <li>
          <form action="" method="post" style="margin-bottom:0;">
            <div class="admin-list-row">
              <span>
                <?php htmlout($user['firstname']); ?> <?php htmlout($user['lastname']); ?> |
                Email: <?php htmlout($user['email']); ?> |
                Phone: <?php htmlout($user['phone']); ?> |
                Interest: <?php htmlout($user['interest']); ?> |
                Message: <?php htmlout($user['message']); ?>
              </span>
              <span class="user-actions">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
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
