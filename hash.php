<?php

$plainPassword = 'password'; // Replace with your actual password

echo '<h1>Hash Algorithms</h1>';

echo '<h2>Using hash() function (not recommended for passwords)</h2>';
$hashed_crc32 = hash('crc32', $plainPassword);
echo '<p>The crc32 hash is 8 characters and looks like this: ' . $hashed_crc32 . '</p>';

$hashed_md5 = hash('md5', 'password');
echo '<p>The md5 hash is 32 characters and looks like this: ' . $hashed_md5 . '</p>';

$hashed_md5_crack = hash('md5', 'p@assw0rd' . 'ijdb');
echo '<p>The md5 password crack = ' . $hashed_md5_crack . '</p>';

$hashed_ripemd128 = hash('ripemd128', $plainPassword);
echo '<p>The ripemd128 hash is 32 characters and looks like this: ' . $hashed_ripemd128 . '</p>';

$hashed_tiger128_3 = hash('tiger128,3', $plainPassword);
echo '<p>The tiger128,3 hash is 32 characters and looks like this: ' . $hashed_tiger128_3 . '</p>';

$hashed_haval128_3 = hash('haval128,3', $plainPassword);
echo '<p>The haval128,3 hash is 32 characters and looks like this: ' . $hashed_haval128_3 . '</p>';

$hashed_sha1 = hash('sha1', $plainPassword);
echo '<p>The sha1 hash is 40 characters and looks like this: ' . $hashed_sha1 . '</p>';

$hashed_sha256 = hash('sha256', $plainPassword);
echo '<p>The sha256 hash is 64 characters and looks like this: ' . $hashed_sha256 . '</p>';

$hashed_snefru = hash('snefru', $plainPassword);
echo '<p>The snefru hash is 64 characters and looks like this: ' . $hashed_snefru . '</p>';

$hashed_gost = hash('gost', $plainPassword);
echo '<p>The gost hash is 64 characters and looks like this: ' . $hashed_gost . '</p>';

$hashed_sha512 = hash('sha512', $plainPassword);
echo '<p>The sha512 hash is 128 characters and looks like this: ' . $hashed_sha512 . '</p>';

$hashed_whirlpool = hash('whirlpool', $plainPassword);
echo '<p>The whirlpool hash is 128 characters and looks like this: ' . $hashed_whirlpool . '</p>';


echo '<h2> Using password_hash() function (recommended for passwords)</h2>';

$hashed_sha3 = hash('sha3-512', $plainPassword);
echo '<p>The SHA-3-512 hash is ' . strlen($hashed_sha3) . ' characters and looks like this: ' . $hashed_sha3 . '</p>';

// Generate an Argon2 hash
$hashed_argon2i = password_hash($plainPassword, PASSWORD_ARGON2I);
echo '<h3>The Argon2i hash is optimised to resist side-channel attacks</h3>';
echo '<p>The Argon2i hash is ' . strlen($hashed_argon2i) . ' characters and looks like this= ' . $hashed_argon2i . '</p>';

// Generate an Argon2 hash
$hashed_argon2id = password_hash($plainPassword, PASSWORD_ARGON2ID);
echo '<h3>The Argon2id hash is a hybrid version and maximises resistance to GPU cracking attacks</h3>';
echo '<p>The Argon2id hash is ' . strlen($hashed_argon2id) . ' characters and looks like this= ' . $hashed_argon2id . '</p>';


?>

