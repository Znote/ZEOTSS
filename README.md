ZEOTSS
======

Znote's External Open Tibia Services Server (ZEOTSS)
Official server: [http://zeotss.znote.eu/] (http://zeotss.znote.eu/)

After you register your server at [ZEOTSS Web register page](http://zeotss.znote.eu/register.php) you can start using it.

Sample code of registeringing visitors who have registered to your site on ZEOTSS:
```php
// ZEOTSS: Register visitor
$config['zeotss']['server'] = "http://zeotss.znote.eu/";
$curl_connection = curl_init($config['zeotss']['server']."modules/visitor/registervisitor.php");
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 0);
$post_string = "longip=".ip2long($_SERVER['REMOTE_ADDR'])."&register=1";
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
$result = curl_exec($curl_connection);
data_dump(false, array($result), "CURL DATA");
curl_close($curl_connection);

// Check if site is registered on ZEOTSS and can use its utilities:
$result = json_decode($result);
if ($result->data->exist === false) {
	?>
	<script type="text/javascript">
	alert("Error: ZEOTSS site validation failed, have you registered? Register at: <?php echo $config['zeotss']['server']; ?>");
	</script>
	<?php
}
```