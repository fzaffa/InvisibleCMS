<html>
  <head>
  <title>Edit Page: <?php echo $row['title']; ?></title>
  </head>
  <body>
    <div id="wrapper">
    <form method="post" atcion="editpage.php">
    <input type="hidden" name="page" value="<?php echo $row['id'] ?>" />
    	<input type="text" name="title" value="<?php echo $row['title']; ?>" />
    	<input type="checkbox" name="inmenu" value="inmenu" <?php if($row['inmenu']== 1){ echo "checked=\"checked\"";} ?> />
      <textarea name="body"><?php echo $row['body']; ?></textarea>
      <input type="submit" name="submit" value="Edit" />
      </form>
    </div>
  </body>
</html>
