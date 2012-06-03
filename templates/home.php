<html>
<head>
  <title><?php echo $title ?></title>
  <link rel="stylesheet" type="text/css" href="templates/stile.css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
		<div id="logo"><h1>Invisible CMS</h1></div>
<?php include "menu.php"; ?>
</div>
<div id="cont">
<!-- <?php include "templates/sidebar.php"; ?> -->
<?php echo $body ?>

<div class="mezzo">
	<h3><?php get_title('first'); ?></h3>
	<?php get_content('first'); ?>
</div>
<div class="mezzo">
	<h3><?php get_title('second'); ?></h3>
	<?php get_content('second'); ?>
</div>
	
</div>
</div>
</div>
</body>
</html>
