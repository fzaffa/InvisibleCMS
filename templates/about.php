<html>
<head>
    <title><?= $page->title ?></title>
    <link rel="stylesheet" type="text/css" href="templates/stile.css" />
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo"><h1>Invisible CMS</h1></div>
        <div id="nav">
            <?= $menu->getMenu()->menuPresenter(); ?>
        </div>
    </div>
    <div id="cont">
        <?= $page->body ?>
    </div>
</div>
</div>
</body>
</html>