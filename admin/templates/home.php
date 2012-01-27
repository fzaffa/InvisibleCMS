<html>
  <head>
    <title>Admin Page</title>
  </head>
  <body>
    <div id="wrapper">
      <ul>
      <?php 
        while($row = mysql_fetch_assoc($result)){
      ?>
        <li><?php echo $row['title'] ?></li>
      <?php } ?>
      </ul>
    </div>
  </body>
</html>
