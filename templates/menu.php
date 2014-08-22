<div id="nav">
	<ul>
<?php
  foreach($menu as $mitem){
?>
  <li><a href="<?php echo strtolower($mitem); ?>"><?php echo $mitem; ?></a></li>
<?php
  }
?>
	</ul>
</div>