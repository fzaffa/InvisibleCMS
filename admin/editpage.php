<?php

include "../conn.php";
if(!isset($_POST['submit'])){

	if(!isset($_REQUEST['page'])){
  	header("location: index.php");
	}
	$page = clean_query($_REQUEST['page']);

	$sql = "SELECT * FROM pages WHERE id = '$page'";
	$result = mysql_query($sql)
	  or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	include "templates/editpage.php";
}
else
{
	$page = clean_query($_POST['page']);
	$title = clean_query($_POST['title']);
	$body = clean_query($_POST['body']);
	$template = clean_query($_POST['template']);
	if($_POST['inmenu'] == "inmenu"){
		$inmenu = 1;
	} else
	{
		$inmenu = 0;
	}
	var_dump($title, $body, $inmenu, $page);
	$sql = "UPDATE pages SET title = '$title', body = '$body', template = '$template', inmenu = '$inmenu' WHERE id = '$page'";
	$result = mysql_query($sql)
		or die(mysql_error());
	header('Location: index.php');
}
?>
