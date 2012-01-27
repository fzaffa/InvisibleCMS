<?php
include "../conn.php";

$sql = "SELECT * FROM pages";
$result = mysql_query($sql)
  or die(mysql_error());
include "templates/home.php";

?>
