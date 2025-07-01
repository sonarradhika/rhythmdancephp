<?php
$main = '<div class="main-centered">
<form action="#" method="post" id="theForm">
    <div class="form-container">
        <fieldset>
            <legend>Contact Us</legend>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" required>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" required>
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>
            <label for="phone">Phone Number
                <span class="tooltip"></span>
            </label>
            <input type="text" name="phone" id="phone" required>
            <label for="interest">Interest</label>
            <select name="interest" id="interest">
                <option value="">Select Interest</option>
                <option value="CD">Classical Dance</option>
                <option value="SC">Semi Classical Dance</option>
                <option value="BD">Bollywood Dance</option>
                <option value="CT">Contemporary Dance</option>
                <option value="FD">Folk Dance</option>
            </select>
            <label for="message">Message <br> (Max 20 words)</label>
            <textarea name="message" id="message" rows="4" cols="50" placeholder="Enter your message (Max 20 words)"></textarea>
            <input type="checkbox" name="terms" id="terms" required> I agree to the terms.
            <input type="submit" value="Register" id="submit">
        </fieldset>
    </div>
</form>
</div>';
include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/templates/template.php'; 