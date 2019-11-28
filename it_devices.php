<?php
include 'header.php';
require 'nav.php';
require 'config.php';

$database = new Conn;
$db = $database->openConnection();
 
$query = $db->query("SELECT * FROM news WHERE category='it_devices'");
$row = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $r){
	echo "<br><br>";
	echo "<h1>" .$r['title']. "</h1>";
	echo "<p> Date: " .$r['date']. ", Category: " .$r['category']. "</p>";
	echo "<img src=" .$r['image']." >";
	echo "<p>" .$r['text']. "</p><br>";

	$_SESSION['valid_user'] = "user_id";
		if(isset($_SESSION['user_id']) && $_SESSION['user_id'] ==1){
			$_SESSION['admin'] = 1;	
			echo "<p><a class='deletebutton' href='delete_post.php?news_id=".$r['news_id'] ."'>Delete post</a></p>";
			echo "<hr>";
		}
		$news_id = $r['news_id'];
		$query2 = $db->query("SELECT * FROM comments WHERE devices_id='$news_id'");
		$row2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($row2 as $r2) {
			echo "<p>" .$r2['comment']. "</p>";
			$_SESSION['username'] = "username";
			if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $r2['user_id']) {
				echo "<p><a class='deletebutton' href='delete_comment.php?comment_id=".$r2['comment_id']."'>Delete</a></p>";
		    }	
			echo "<hr>";
			echo "<br><br>";
			$_SESSION['valid_user'] = "user_id";
		        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] ==1){
			        $_SESSION['admin'] = 1;	
			        echo "<p><a class='deletebutton' href='delete_comment.php?comment_id=".$r2['comment_id']."'>Delete</a></p>";
		        }
		}
				if(isset($_SESSION['user_id'])){
			?>
				<form action="" method="POST">
					<input type="text" name="news_id" value="<?php echo $r['news_id']; ?>" hidden>
					<input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
					<textarea type="text" name="comment"  cols="50" rows="4"></textarea><br>
					<input class ="comm" type="submit" name="commentAdd" value="Add comment">
				</form>
				<br><br>
			<?php

		if(isset($_POST['commentAdd'])){
			$comment=$_POST['comment'];
			$user_id=$_POST['user_id'];
			$news_id=$_POST['news_id'];
			
			$sql ="INSERT INTO comments (comment_id, comment, user_id, news_id, jobs_id, devices_id) VALUES (null, '".$_POST['comment']."', '".$user_id."', 0, 0, '".$news_id."' )";
			#echo $sql;
			$db->exec($sql);	
						
		}
	}
}
	$database->closeConnection();
	include 'footer.php'; 
?>	