<?php
	require 'config.php';
	
	$database = new Conn;
	$db = $database->openConnection();
	
	$comment_id = $_GET['comment_id'];
	
	$sql="DELETE FROM comments WHERE comment_id ='$_GET[comment_id]'";
	$db->exec($sql);
	$database->closeConnection();
	header("location:index.php");
?>