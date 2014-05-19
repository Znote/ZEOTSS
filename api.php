<?php
require_once 'engine/init.php';
// Initiate default config if nothing is specified (outdated config file)
if (!isset($config['api']['debug'])) $config['api']['debug'] = false;

$response = array(
	'version' => array()
);

if (isset($moduleVersion)) $response['version']['module'] = $moduleVersion;
function SendResponse($response) {
	global $config;
	if ($config['api']['debug']) data_dump($response, false, "Response (debug mode)");
	else {
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
?>