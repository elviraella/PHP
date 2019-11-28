<?php  	include 'header.php';
		require 'nav.php';
		require 'config.php';
	
	$database = new Conn;
	$db = $database->openConnection();
	$query = $db->query("SELECT * FROM news");
	$row = $query->fetchAll(PDO::FETCH_ASSOC);
	
		foreach($row as $r){
			echo "<div class='grid'>";
			echo "<br><br>";
			echo "<h1>" .$r['title']. "</h1>";
			echo "<p> Date: " .$r['date']. ", Category: " .$r['category']. "</p>";
			echo "<div class='image'> <img src=" .$r['image']." > </div>";
			echo "<p>" . substr($r['text'], 0, 100) . "</p>";
			echo "<p><a class='readmore' href='".$r['category'].".php'>Read more</a></p>";	
			echo "</div>";
		}

		include 'footer.php';
?>