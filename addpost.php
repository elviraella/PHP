<?php
include 'header.php';
include 'nav.php';
require 'config.php';

if(isset($_POST['add'])){
	
	$databasa = new Conn;
	$db = $databasa->openConnection();

	$title =    $_POST['title'];
	$date =     $_POST['date'];
	$category = $_POST['category'];
	$image=     $_POST['image'];
	$text =     $_POST['text'];

    if(empty($_POST['title']) || empty($_POST['date']) || empty($_POST['category']) || empty          ($_POST['image']) || empty($_POST['text'])) {
        echo "<p> Something's missing. Please check and try again. </p>";
        exit();

    }else{

	    $sql = array($title, $date, $category, $image, $text); 
        $stmt = $db->prepare("INSERT INTO news (title, date, category, image, text) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute($sql);

	}
	
}
	

?>

<div class="content">
	<br><br><br>
	<h2 style="text-align:left;">Add new post</h2>
		<form action=" " method="POST">
		<table class="table table-striped">
			<tr>
							<td>Title</td>
							<td><input type="text" name="title"></td>
						</tr>
						<tr>
							<td>Published</td>
							<td><input type="date" name="date"></td>
						</tr>
						<tr>
							<td>Category</td>
							<td><input type="text" name="category"></td>
						</tr>
						<tr>
							<td>Path to image</td>
							<td><input type="text" name="image"></td>
						</tr>
						<tr>
							<td>Text</td>
							<td><textarea type="text" name="text" cols="50" rows="18"></textarea></td>
						</tr>
						<tr>
							<td></td>
			<td><input style="width:100px; text-align:center;" class="addbutton" type="submit" name="add" value="Add"></td>
</table>
		
	</form>
</div>
</body>
</html>
