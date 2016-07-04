<html>
<head>
  <title><?= $page->title ?></title>
  <link rel="stylesheet" type="text/css" href="App/Views/pages/stile.css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
		<div id="logo"><h1>InvisibleCMS</h1></div>
            <div id="nav">
                <ul>
                <? foreach($menu as $item): ?>
                <li><a href="<?= $item->slug ?> "><?= $item->title ?></a></li>
                <? endforeach ?>
                </ul>
            </div>
</div>
<div id="cont">
<p class="body">
    <?= $page->body; ?>
</p>

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
