<?php
	$db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
	
	if ($db->connect_error) {
	   die ("Connection failed: " . $db -> connect_error);
	}

	$gid = $_REQUEST["gid"];
	$qty = $_REQUEST["qty"];
  if($qty>=1){
  $qty-=1;
	$q= "UPDATE glist SET qty=$qty WHERE g_id = $gid ";
  $r = $db->query($q);
  }

	$db->close();
?>
