<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php'; ?>
	
	<!--*************************************************************
				Don't forget to change server path
	************************************************************* -->
	
<?php
$main = '<h1>Access Denied</h1><p>' . (isset($error) ? htmlspecialchars($error) : 'You do not have permission to access this page.') . '</p>';
include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/templates/template.php';
