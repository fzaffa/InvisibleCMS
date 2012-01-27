<?php
$host = "";
$user = "";
$pass = "";
$db = "";
mysql_connect($host, $user, $pass)
	or die(mysql_error());
mysql_select_db($db);
?>
