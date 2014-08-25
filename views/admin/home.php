<html>
  <head>
    <title>Admin Page</title>
  </head>
  <body>
  <?php var_dump(Message::recive('errors')); ?>
    <div id="wrapper">
    <a href="new/">New Page</a>
    <a href="/">View Site</a>
    <a href="logout/">Logout</a>
      <ul>
      <?php 
        foreach($pages as $page){
      ?>
        <li><a href="/admin/edit/<?= $page->slug?>"><?= $page->title?></a></li>
      <?php } ?>
      </ul>
    </div>
  </body>
</html>
