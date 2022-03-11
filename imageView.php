<?php
/* Displays all the images that were sent to the database */

    $db = mysqli_connect("localhost", "root", "", "photos");

    if(isset($_GET['image_id'])) {
        $sql = "SELECT imageType,imageData FROM output_images WHERE imageId=" . $_GET['image_id'];
		$result = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
	}
	mysqli_close($db);
?>