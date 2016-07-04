<html>
<head>
    <title><?= $page->title ?></title>
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
        <?= $page->body ?>
        
    </div>
</div>
</body>
</html>