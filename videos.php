<?php
	//ha a gomb nyomva van
	if (isset($_POST['upload'])){
		//elmentsuk a feltoltott kepet
		$target = "./".basename($_FILES['video']['name']);
		
		//kapcsolodas az adatbazishoz
		$db = mysqli_connect("localhost","root","","videok");
		
		//Minden vegrehajtott adat
		$video = $_FILES['video']['name'];
		$text = $_POST['text'];
		
		$sql = "INSERT INTO video (video ,text) VALUES ('$video' , '$text')";
		mysqli_query($db, $sql); //elmentsuk az adatokat az images adatbazisba
		
		if(move_uploaded_file($_FILES['video']['tmp_name'], $target)){
			$msg = "Video uploaded successfully";
		}
		else{
			$msg = "There was a problem uploading Video";
		}
	}

?>



<!DOCTYPE html>
<html>
	<head>
		<title>Video Upload</title>
		<link rel = "stylesheet" type = "text/css" href = "style.css">
	</head>
	
	<body>
		<div id = "content">
		<?php
			$db = mysqli_connect("localhost","root","","videok");
			$sql = "SELECT * FROM video";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result)){
				echo "<div id = 'video_div'>";
					//echo "<video src = '".$row['video']."'>";
					//echo "<p>".$row['text']."</p>";
					echo "<video width='500' height='500' controls>
						<source src='" .$row['video']. "'type='video/mp4'>
						</video>";
					echo "<p>".$row['text']."</p>";
				echo "</div>";
				
			}
		
		?>
			<form method = "post" action = "videos.php" enctype = "multipart/form-data">
				<input type = "hidden" name = "size" value = "1000000">
					<div>
						<input type = "file" name = "video">
					</div>
					<div>
						<textarea name = "text" cols = "40" rows = "5" placeholder = "Video leírása..."></textarea>
					</div>
					<div>
						<input type = "submit" name = "upload" value = "Upload Video">
					</div>
			</form>
		</div>
	</body>
</html>