<?php

include "../conn.php";
if(!isset($_POST['submit'])){
	include "templates/editpage.php";
}
else
{
	$page = $_POST['page'];
	$title = $_POST['title'];
	$body = $_POST['body'];
	$template = $_POST['template'];
	if($_POST['inmenu'] == "inmenu"){
		$inmenu = 1;
	} else
	{
		$inmenu = 0;
	}
	var_dump($title, $body, $inmenu, $page);
	$sql = "INSERT INTO pages (title, body, template, inmenu) VALUES ('$title', '$body', '$template', '$inmenu')";
	$result = mysql_query($sql)
		or die(mysql_error());
	header('Location: index.php');
}
?>