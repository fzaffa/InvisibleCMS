<?php
$host = "localhost";
$user = "root";
$pass = "zaffaron";
$db = "mycms";
mysql_connect($host, $user, $pass)
	or die(mysql_error());
mysql_select_db($db);
?>
