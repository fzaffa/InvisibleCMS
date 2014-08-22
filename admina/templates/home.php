<html>
  <head>
    <title>Admin Page</title>
  </head>
  <body>
    <div id="wrapper">
    <a href="newpage.php">New Page</a>
    <a href="..">View Site</a>
    <a href="logout.php">Logout</a>
      <ul>
      <?php 
        foreach($pages as $page){
      ?>
        <li><a href="editpage.php?page=<?= $page->title?>"><?= $page->title?></a></li>
      <?php } ?>
      </ul>
    </div>
  </body>
</html>
