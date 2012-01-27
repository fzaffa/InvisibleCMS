<html>
<head>
	<title><?php echo $title ?></title>
</head>
<body>
<?php
  foreach($menu as $mitem){
?>
  <li><a href="?page=<?php echo $mitem; ?>"><?php echo $mitem; ?></a></li>
<?php
  }
?>
<?php echo $body ?>
</body>
</html>
