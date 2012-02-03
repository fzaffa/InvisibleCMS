<?php
$host = "";
$user = "";
$pass = "";
$db = "";
mysql_connect($host, $user, $pass)
	or die(mysql_error());
mysql_select_db($db);
function clean_query($query){
	if(get_magic_quotes_gpc()){
		$query = stripslashes($query);
	}
	$query = mysql_real_escape_string($query);
	return $query ;
}
?>
