<?php
	$conn = mysqli_connect("localhost","root","","foodgallery") or die("Falha: ".mysqli_connect_error());	
	mysqli_set_charset($conn, "utf8");
?>