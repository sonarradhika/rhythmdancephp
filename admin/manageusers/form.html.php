<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php'; ?>
	
	<!--*************************************************************
				Don't forget to change server path
	************************************************************* -->

  
    <?php
    ob_start();
    ?>
    <h1><?php htmlout($pageTitle); ?></h1>
    <form action="?<?php htmlout($action); ?>" method="post" class="form-container">
      <div>
        <label for="firstname">First Name: <input type="text" name="firstname" id="firstname" value="<?php htmlout($firstname); ?>" required></label>
      </div>
      <div>
        <label for="lastname">Last Name: <input type="text" name="lastname" id="lastname" value="<?php htmlout($lastname); ?>" required></label>
      </div>
      <div>
        <label for="email">Email: <input type="email" name="email" id="email" value="<?php htmlout($email); ?>" required></label>
      </div>
      <div>
        <label for="phone">Phone: <input type="text" name="phone" id="phone" value="<?php htmlout($phone); ?>" required></label>
      </div>
      <div>
        <label for="interest">Interest:
          <select name="interest" id="interest" required>
            <option value="">Select Interest</option>
            <option value="CD" <?php if ($interest == 'CD') echo 'selected'; ?>>Classical Dance</option>
            <option value="SC" <?php if ($interest == 'SC') echo 'selected'; ?>>Semi Classical Dance</option>
            <option value="BD" <?php if ($interest == 'BD') echo 'selected'; ?>>Bollywood Dance</option>
            <option value="CT" <?php if ($interest == 'CT') echo 'selected'; ?>>Contemporary Dance</option>
            <option value="FD" <?php if ($interest == 'FD') echo 'selected'; ?>>Folk Dance</option>
          </select>
        </label>
      </div>
      <div>
        <label for="message">Message (Max 20 words):<br>
          <textarea name="message" id="message" rows="4" cols="50"><?php htmlout($message); ?></textarea>
        </label>
      </div>
      <div>
        <label for="password">Set password: <input type="password" name="password" id="password" value ="<?php htmlout($password); ?>"></label>
      </div>
      <div>
        <label for="roles">Assign Roles:</label>
        <select name="roles[]" id="roles" multiple size="3" style="width: 100%; min-width: 250px; max-width: 100%;">
          <?php if (isset($allRoles) && is_array($allRoles)): ?>
            <?php foreach ($allRoles as $role): ?>
              <option value="<?php echo htmlspecialchars($role['id']); ?>" <?php if (isset($userRoles) && in_array($role['id'], $userRoles)) echo 'selected'; ?>>
                <?php echo htmlspecialchars($role['description']); ?>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
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
