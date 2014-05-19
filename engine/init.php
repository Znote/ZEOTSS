<?php
// Verify the PHP version, gives tutorial if fail.
if (version_compare(phpversion(), '5.3.3', '<')) die('PHP 5.3.3 or higher is required');
if (!isset($filepath)) $filepath = '../';

session_start();
ob_start();
require $filepath.'/engine/config.php';
if (isset($_GET['debug']) && $_GET['debug'] == 1) {
	$config['api']['debug'] = true;
}
require $filepath.'/engine/mysql.php';
$mysql = new Mysql($config['mysql']);
require $filepath.'/engine/cache.php';
require $filepath.'/engine/functions.php';
?>