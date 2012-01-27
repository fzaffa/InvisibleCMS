<?php
  foreach($menu as $mitem){
?>
  <li><a href="?page=<?php echo $mitem; ?>"><?php echo $mitem; ?></a></li>
<?php
  }
?>