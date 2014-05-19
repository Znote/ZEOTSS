<?php require_once '../../module.php';
// Blank/empty module, nice code to start with when making custom stuff.

// Configure module version number
$response['version']['module'] = 1;

// Fetch connecting IP
$ip = ip2long($_SERVER['REMOTE_ADDR']);

// Check if IP exist
$site = $mysql->select_single("SELECT * FROM `sites` WHERE `ip`='$ip' LIMIT 1;");

if ($site !== false) {
	$response['data']['exist'] = true;

	// Fetch visitors:
	$visitors = $mysql->select_multi("SELECT `id`, `longip`, `registered`, `added`, `lastseen` FROM `visitors` WHERE `site_id`='".$site['id']."' ORDER BY `lastseen` ASC;");
	$dayago = time() - (24 * 3600);
	$weekago = time() - (7 * 24 * 3600);
	$visitorcount = 0;
	$visitorweekcount = 0;
	$visitordaycount = 0;
	$Rvisitorcount = 0;
	$Rvisitorweekcount = 0;
	$Rvisitordaycount = 0;
	foreach ($visitors as $visitor) {
		if ($visitor['lastseen'] > $weekago) {
			$visitorweekcount++;
			if ($visitor['registered'] == 1) $Rvisitorweekcount++;
			if ($visitor['lastseen'] > $dayago) {
				$visitordaycount++;
				if ($visitor['registered'] == 1) $Rvisitordaycount++;
			}
		}
		$visitorcount++;
		if ($visitor['registered'] == 1) $Rvisitorcount++;
	}
	$response['data']['visitors']['daily'] = array(
		'registered' => $Rvisitordaycount,
		'visited' => $visitordaycount
	);
	$response['data']['visitors']['weekly'] = array(
		'registered' => $Rvisitorweekcount,
		'visited' => $visitorweekcount
	);
	$response['data']['visitors']['total'] = array(
		'registered' => $Rvisitorcount,
		'visited' => $visitorcount
	);
	
} else $response['data']['exist'] = false;

// Send the response through JSON API
SendResponse($response);
?>