<?php
$host = "yourhost";
$user = "youruser";
$pass = "yourpass";
$db = "yourdatabase";
mysql_connect($host, $user, $pass)
	or die(mysql_error());
mysql_select_db($db);
?>