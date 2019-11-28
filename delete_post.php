<?php
require 'config.php';
	
	$database = new Conn;
	$db = $database->openConnection();
	
	$news_id = $_GET['news_id'];
	
	$sql="DELETE FROM news WHERE news_id ='$_GET[news_id]'";
	$db->exec($sql);
	$database->closeConnection();
	header("location:admin_panel.php");
?>