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

	// Register the visitor for that account
	$visitorpost = array(
		'longip' => isset($_POST['longip']) ? (int)$_POST['longip'] : false,
		'register' => isset($_POST['register']) ? (int)$_POST['register'] : false
	);
	if (!in_array(false, $visitorpost)) {
		$time = time();
		// See if visitor already exist in site db:
		$visitor = $mysql->select_single("SELECT `id` FROM `visitors` WHERE `site_id`='".$site['id']."' AND `longip`='".$visitorpost['longip']."' LIMIT 1;");
		if ($visitor !== false) {
			// Visitor already registered.
			$response['data']['visitor']['exist'] = true;
			$response['data']['visitor']['added'] = false;
			if ($visitor['lastseen'] < $time - 3600) {
				$mysql->update("UPDATE `visitors` SET `lastseen`='$time' WHERE `id`='".$visitor['id']."' LIMIT 1;");
			}
		} else {
			// Visitor need to be registered.
			$response['data']['visitor']['exist'] = false;
			$mysql->insert("INSERT INTO `visitors` (`site_id`, `longip`, `registered`, `added`, `lastseen`) VALUES ('".$site['id']."', '".$visitorpost['longip']."', '".$visitorpost['register']."', '$time', '$time');");
			$response['data']['visitor']['added'] = true;
		}
	} else {
		$response['data']['visitor']['error'] = "Invalid post data. Expecting longip containing longip IPv4 representation and register containing 0 or 1 depending on if visitor has logged in.";
		$response['data']['visitor']['postdata'] = $visitorpost;
	}
	// visitor (id, siteid, longip, registered)
} else {
	$response['data']['exist'] = false;
	$response['data']['error'] = "Website is not registered at configured ZEOTSS service.";
}


// Send the response through JSON API
SendResponse($response);
?>