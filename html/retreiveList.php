<?php

	$db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
	
	if ($db->connect_error) {
	   die ("Connection failed: " . $db -> connect_error);
	}

	$uid = $_REQUEST["uid"];
	$fid = $_REQUEST["fid"];
  
  
	$q= "SELECT * FROM glist WHERE f_id = $fid ORDER BY qty ASC, dt DESC LIMIT 10";
	$r = $db->query($q);

	$arr=array();
	while ($row = $r->fetch_assoc()){
		$arr[]= $row;
	}

	$JSON_response = json_encode($arr);
	echo $JSON_response;

	$db->close();
?>
