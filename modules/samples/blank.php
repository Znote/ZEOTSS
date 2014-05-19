<?php require_once '../../module.php';
// Blank/empty module, nice code to start with when making custom stuff.

// Configure module version number
$response['version']['module'] = 1;

/* Do PHP logic, you got access to:
	-Znote AAC sql functions:
		:mysql_select_single("QUERY");
		:mysql_select_multi("QUERY");
		:mysql_update("QUERY"), mysql_insert("QUERY"), mysql_delete("QUERY")

	-Config values
		:etc $config['vocations']

	-Cache system
		:Sample:
		$cache = new Cache('engine/cache/api/ApiModuleName');
		if ($cache->hasExpired()) {
			$players = mysql_select_multi("SELECT `name`, `level`, `experience` FROM `players` ORDER BY `experience` DESC LIMIT 5;");
			
			$cache->setContent($players);
			$cache->save();
		} else {
			$players = $cache->load();
		}
*/

// Save the results of previous logic to the response
$response['data']['title'] = "The fabulous blank page!";

// Send the response through JSON API
SendResponse($response);
?>