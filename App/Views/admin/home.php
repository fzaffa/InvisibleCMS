<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/Assets/admin.css" />
</head>
<?= var_dump($page) ?>
<body>

<header>
    <div class="headwrap">
        <h1 class="logo">
            InvisibleCMS
        </h1>
        <ul clas="nav">
            <li><a href="/">View Site</a></li>
        </ul>
        <a href="logout" class="btn-grey">Logout</a>
    </div>
</header>
<div class="wrapper">

    <div class="content">
        <div class="table-caption">
            <h2 class="caption">
                Pages
            </h2>
            <a href="create" class="btn-green">New Page</a>
        </div>
        <table class="page-list">
            <thead>
            <tr>
                <td>Title</td>
                <td>Template</td>
                <td>Created At</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($pages as $page){
            ?>
            <tr>
                <td><?= $page->title?></td>
                <td><?= $page->template.".php"?></td>
                <td>2014-09-12</td>
                <td><a href="/admin/edit/<?= $page->slug?>">Edit</a>-Delete</td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>