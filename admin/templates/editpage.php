<html>
  <head>
  <title>Edit Page: <?php echo $row['title']; ?></title>
  </head>
  <body>
    <div id="wrapper">
    <form method="post" atcion="editpage.php">
    <input type="hidden" name="page" value="<?php echo $row['id'] ?>" /><br />
    	<label>Title</label><input type="text" name="title" value="<?php echo $row['title']; ?>" /><br />
    	<label>template</label><input type="text" name="template" value="<?php echo $row['template']; ?>" /><br />
    	<label>In Menu</label><input type="checkbox" name="inmenu" value="inmenu" <?php if($row['inmenu']== 1){ echo "checked=\"checked\"";} ?> /><br />
      <label>Body</label><textarea name="body"><?php echo $row['body']; ?></textarea><br />
      <input type="submit" name="submit" value="Edit" />
      </form>
    </div>
  </body>
</html>
