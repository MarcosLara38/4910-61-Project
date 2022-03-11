<?php

/* NOTES-- Try to show the list of images that were sent and next to it a list of ingerdients found.
    From there the user can update the list by typing it out. */


    $db = mysqli_connect("localhost", "root", "", "photos");
    $sql = "SELECT imageId FROM output_images ORDER BY imageId DESC"; 
    $result = mysqli_query($db, $sql);
?>
<HTML>
<HEAD>
<TITLE>List BLOB Images</TITLE>
<link href="imageStyles.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
<?php
	while($row = mysqli_fetch_array($result)) {
	?>
		<img src="imageView.php?image_id=<?php echo $row["imageId"]; ?>" /><br/>
	
<?php		
	}
    mysqli_close($db);
?>
</BODY>
</HTML>