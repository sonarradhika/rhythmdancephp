<?php 
include 'head.html.php';
echo "<body>";
include 'header.html.php';
include 'nav.html.php';
echo "<main class='main-content'>";
echo isset($main) ? $main : '';
echo "</main>";
include 'footer.html.php';
echo "</body></html>";