<?php


$hashed = hash('md5', 'password'.'ijdb');
echo '<p>The md5 hash is 32 characters and looks like this = ' .$hashed . '<p>';

$hashed = hash('md5', '1234'.'datamano');
echo '<p>The md5 password crack = ' .$hashed . '<p>';



?>