<html>
  <head>
    <title>Admin Page</title>
  </head>
  <body>
    <div id="wrapper">
    <a href="newpage.php">New Page</a>
     <a href="..">View Site</a>
      <ul>
      <?php 
        while($row = mysql_fetch_assoc($result)){
      ?>
        <li><a href="editpage.php?page=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></li>
      <?php } ?>
      </ul>
    </div>
  </body>
</html>
