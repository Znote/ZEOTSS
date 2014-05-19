<?php
$filepath = "./";
require_once 'engine/init.php';
if (isset($_POST['website'])) {
	$website = $_POST['website'];
	$website = htmlentities(strip_tags($mysql->escape($website)));

	$email = $_POST['email'];
	$email = htmlentities(strip_tags($mysql->escape($email)));
	
	$status = false;

	if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 5 && strlen($website) > 5) {
		$status = true;
	}

	if ($status) {
		$password = rand(10000000, 99999999);
		$encp = sha1($password);
		$ip = ip2long(gethostbyname($website));
		$time = time();

		// Check if site already exist
		$exist = $mysql->select_single("SELECT `id` FROM `sites` WHERE `name` = '{$website}' LIMIT 1;");
		if (!$exist) {
			$mysql->insert("INSERT INTO `sites` (`name`, `ip`, `password`, `created`, `email`) VALUES ('{$website}', '{$ip}', '{$encp}', '{$time}', '{$email}');");
			echo "REGISTER COMPLETE: Your password is: $encp <br>Don't forget it!";
		} else {
			echo "Site already registered.";
		}
		
	} else {
		echo "Registration failed, invalid data?";
	}
}
?>
<h1>Register your website to use ZEOTSS API.</h1>
<form action="" method="post">
	<label for="website">Website: </label><input id="website" name="website" placeholder="Your Website" type="text">
	<br><label for="email">Email: </label><input id="email" name="email" placeholder="Your Email" type="text">
	<br><input type="submit" value="Create Account">
</form>