<html>
<head>
  <title><?php echo $title ?></title>
  <link rel="stylesheet" type="text/css" href="App/Views/pages/stile.css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
		<div id="logo"><h1>Invisible CMS</h1></div>
			<div id="nav">
				<ul>
					<? foreach($menu as $item): ?>
						<li><a href="<?= $item->slug ?> "><?= $item->title ?></a></li>
					<? endforeach ?>
				</ul>
			</div>
</div>
<div id="cont">
<?php echo $body ?>
<form method="post" action="#">
	<label>Nome</label><input type="text" /><br />
	<label>E-Mail</label><input type="text" /><br />
	<label>Telefono</label><input type="text" /><br />
	<label>Messaggio</label><textarea></textarea>
</form>
</div>
</div>
</body>
</html>