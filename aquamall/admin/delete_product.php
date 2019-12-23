<?php 

include("../includes/connection.php");
	$select = "SELECT * FROM product WHERE product_id = {$_GET['product_id']}";
	$result = mysqli_query($conn,$select);
	$row    = mysqli_fetch_assoc($result);

	unlink("upload/".$row['pro_image']);

	$query  = "DELETE FROM product WHERE product_id = {$_GET['product_id']}";
	$result = mysqli_query($conn,$query);
	header("Location:manage_category.php");

