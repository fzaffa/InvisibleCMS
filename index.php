<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "conn.php";

function get_content($slug)
{
	$sql = "SELECT * FROM sections WHERE slug = '$slug';";
	$result = mysql_query($sql)
	or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	echo $row['cont'];
}

function get_title($slug)
{
	$sql = "SELECT * FROM sections WHERE slug = '$slug';";
	$result = mysql_query($sql)
	or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	echo $row['title'];
}
//Legge che pagina è


if(!isset($_REQUEST['page'])){
  $page = 'home';
}else{
  $page = clean_query($_REQUEST['page']);
}

$menusql = "SELECT title FROM pages WHERE inmenu = 1";
$menuresult = mysql_query($menusql)
  or die(mysql_error());
$menu = array();
while($row = mysql_fetch_assoc($menuresult)){
  $menu[]= $row['title'];
}
$sql = "SELECT * FROM pages WHERE title = '$page'";
$result = mysql_query($sql)
	or die(mysql_error());
$row = mysql_fetch_assoc($result);
extract($row);
include "templates/".$template.".php";

?>
