<?php
$filepath = "./";
require_once 'engine/init.php';
?>
<h1>Znote's External Open Tibia Services Server (ZEOTSS)</h1>
<p>ZEOTSS is a php json API service. It is meant to be used as a common portal for Znote AAC users.<br>
Two services I intend to create is an IP validation for paypal scammers, and other OT resources that can be sentralised.<br>
If you wish to use ZEOTSS services, feel free to <a href="register.php">register your website</a> to gain access to its services.</p>
<table>
	<tr>
		<td width="200" valign="top">
			<h2>Installed Modules</h2>
			<p><a target="_BLANK" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/list.php">http://<?php echo $_SERVER['HTTP_HOST'] ?>/list.php</a></p>
			<iframe src="list.php?debug=1" width="400" height="458"></iframe>
		</td>
		<td valign="top">
			<h2>Usage:</h2>
			<p>With php curl you can call any API links with get or post.
				<br>By using ?debug=true as url parameter you will render the debug version of the response, 
				<br>making it human eye friendly.</a></p>
				<p>For more information including the source code, visit our <a target="_BLANK" href="https://github.com/Znote/ZEOTSS">Github Page</a>.</p>
				<h2>Sample Module</h2>
				<p><a target="_BLANK" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/modules/samples/blank.php">http://<?php echo $_SERVER['HTTP_HOST'] ?>/modules/samples/blank.php</a></p>
				<iframe src="modules/samples/blank.php?debug=1" width="400" height="295"></iframe>
		</td>
		<td valign="top">
			<h2>ZEOTSS Contributors:</h2>
			<?php
			if(function_exists('curl_version')) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'https://api.github.com/repos/Znote/ZEOTSS');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_USERAGENT, 'ZEOTSS'); // GitHub requires user agent header.
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$contributors = json_decode(curl_exec($curl), true); // Sorted by contributions.
			foreach($contributors as $key => $contributor)
			{
				if ($key == 'owner') {
					?>
					<div class="contributor">
						<a href="<?php echo $contributor['html_url']; ?>">
							<img src="<?php echo $contributor['avatar_url']; ?>size=80" style="width: 80px; height: 80px" /><br/>
							<span><?php echo $contributor['login']; ?></span>
						</a>
					</div>
					<?php
				}
			}
		} else {
			?>
			<p>PHP cURL disabled, but you can view the link: <a target="_BLANK" href="https://github.com/Znote/ZEOTSS/graphs/contributors">Contributors</a></p>
			<?php
		}
		?>
		</td>
	</tr>
</table>
