<?php include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php'; ?>

    <!-- register.html -->
    <?php
    ob_start();
    ?>

        <form action="?addform" method="post" id="theForm">
            <div class="form-container">
                <fieldset>
                    <legend>Register as a New User</legend>

                    <label for="firstName">First Name
                        <input type="text" name="firstname" id="firstName" value="<?php htmlout($firstname); ?>" required>
                    </label><br>

                    <label for="lastName">Last Name
                        <input type="text" name="lastname" id="lastName" value="<?php htmlout($lastname); ?>" required>
                    </label><br>

                    <label for="email">Email Address
                        <input type="email" name="email" id="email" value="<?php htmlout($email); ?>" required>
                    </label><br>

                    <label for="phone">Phone Number
                        <input type="text" name="phone" id="phone" value="<?php htmlout($phone); ?>" required>
                    </label><br>

                    <label for="interest">Interest
                        <select name="interest" id="interest" required>
                        <option value="">Select Interest</option>
                        <option value="CD" <?php if ($interest == 'CD') echo 'selected'; ?>>Classical Dance</option>
                        <option value="SC" <?php if ($interest == 'SC') echo 'selected'; ?>>Semi Classical Dance</option>
                        <option value="BD" <?php if ($interest == 'BD') echo 'selected'; ?>>Bollywood Dance</option>
                        <option value="CT" <?php if ($interest == 'CT') echo 'selected'; ?>>Contemporary Dance</option>
                        <option value="FD" <?php if ($interest == 'FD') echo 'selected'; ?>>Folk Dance</option>
                        </select>
                    </label><br>

                    <label for="message">Message (Max 20 words)<br>
                        <textarea name="message" id="message" rows="4" cols="50"><?php htmlout($message); ?></textarea>
                    </label><br>

                    <?php if (!isset($isAdmin) || !$isAdmin): ?>
                    <label>
                        <input type="checkbox" name="terms" required> I agree to the terms.
                    </label><br><br>
                    <?php endif; ?>

                    <input type="submit"  value="<?php htmlout($button); ?>">
                </fieldset>
            </div>
        </form>


    
    <?php
    $main = ob_get_clean();
    include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/templates/template.php';
    ?>