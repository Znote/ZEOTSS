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
			<p>http://<?php echo $_SERVER['HTTP_HOST'] ?>/zeotss/list.php</p>
			<iframe src="list.php?debug=1" width="400" height="330"></iframe>
			<h2>Sample Module</h2>
			<p>http://<?php echo $_SERVER['HTTP_HOST'] ?>/zeotss/modules/samples/blank.php</p>
			<iframe src="modules/samples/blank.php?debug=1" width="400" height="300"></iframe>
		</td>
		<td valign="top">
			<h2>Usage:</h2>
			<p>With php curl you can call any API links with get or post.
				<br>By using ?debug=true as url parameter you will render the debug version of the response, 
				<br>making it human eye friendly.</a></p>
		</td>
	</tr>
</table>
