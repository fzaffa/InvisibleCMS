<?php

include "../conn.php";

if(!isset($_REQUEST['page'])){
  header("location: index.php");
}
$page = $_REQUEST['page'];

$sql = "SELECT * FROM pages WHERE id = '$page'";
$result = mysql_query($sql)
  or die(mysql_error());
$row = mysql_fetch_assoc($result);
include "templates/editpage.php";
?>
