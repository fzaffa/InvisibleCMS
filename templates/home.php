<html>
<head>
  <title><?= $page->title ?></title>
  <link rel="stylesheet" type="text/css" href="templates/stile.css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
		<div id="logo"><h1>So' figo So' bello So' fotomodello</h1></div>
            <div id="nav">
                <?= $menu->getMenu()->menuPresenter(); ?>
            </div>
</div>
<div id="cont">
<?= $page->body ?>

<div class="mezzo">
	<h3><?= $page->displaySectionTitle('Lato') ?></h3>
    <p><?= $page->displaySection('Lato') ?></p>
</div>
<div class="mezzo">
    <h3><?= $page->displaySectionTitle('Sinistra') ?></h3>
    <p><?= $page->displaySection('Sinistra') ?></p>
</div>
	
</div>
</div>
</div>
</body>
</html>
