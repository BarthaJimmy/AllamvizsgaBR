<?php
	//ha a gomb nyomva van
	if (isset($_POST['upload'])){
		//elmentsuk a feltoltott kepet
		$target = "./".basename($_FILES['image']['name']);
		
		//kapcsolodas az adatbazishoz
		$db = mysqli_connect("localhost","root","","kepek");
		
		//Minden vegrehajtott adat
		$image = $_FILES['image']['name'];
		$text = $_POST['text'];
		
		$sql = "INSERT INTO images (image ,text) VALUES ('$image' , '$text')";
		mysqli_query($db, $sql); //elmentsuk az adatokat az images adatbazisba
		
		if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
			$msg = "Image uploaded successfully";
		}
		else{
			$msg = "There was a problem uploading image";
		}
	}

?>



<!DOCTYPE html>
<html>
	<head>
		<title>Image Upload</title>
		<link rel = "stylesheet" type = "text/css" href = "style.css">
	</head>
	
	<body>
		<div id = "content">
		<?php
			$db = mysqli_connect("localhost","root","","kepek");
			$sql = "SELECT * FROM images";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result)){
				echo "<div id = 'img_div'>";
					echo "<img src = '".$row['image']."'>";
					echo "<p>".$row['text']."</p>";
				echo "</div>";
			}
		
		?>
			<form method = "post" action = "index.php" enctype = "multipart/form-data">
				<input type = "hidden" name = "size" value = "1000000">
					<div>
						<input type = "file" name = "image">
					</div>
					<div>
						<textarea name = "text" cols = "40" rows = "5" placeholder = "Kép leírása..."></textarea>
					</div>
					<div>
						<input type = "submit" name = "upload" value = "Upload Image">
					</div>
			</form>
		</div>
	</body>
</html>