<?php

//the action will start if user press button
include("../includes/connection.php");
if(isset($_POST['submit'])){
	//fetch data from web form
	$cat_name    = $_POST['cat_name'];
	$cat_image   = $_FILES['cat_image']['name'];
	$tmp_name    = $_FILES['cat_image']['tmp_name'];
	$path        ="upload/"; 
	move_uploaded_file($tmp_name, $path.$cat_image);

	if($_FILES['cat_image']['error'] == 0){
		//return admin records
		$select = "SELECT * FROM category WHERE cat_id={$_GET['cat_id']}";
		$result = mysqli_query($conn,$select);
		$row    = mysqli_fetch_assoc($result);
		//delete image from upload file
		unlink("upload/".$row['cat_image']);

		//set new image 
		$query = "UPDATE category SET cat_name = '$cat_name',
		cat_image = '$cat_image'
		where cat_id={$_GET['cat_id']}";
		mysqli_query($conn,$query);
	}
	else {
		$query = "UPDATE category SET cat_name = '$cat_name' where cat_id={$_GET['cat_id']}";
			//perform the query 
		mysqli_query($conn,$query);
	}
	header("Location:manage_category.php");
}
//Fetch old data

$query  = "SELECT * FROM category WHERE cat_id = {$_GET['cat_id']}";
$result = mysqli_query($conn,$query);
$row    = mysqli_fetch_assoc($result);



include("../includes/admin_header.php");
?>

<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">Update category</div>
						<div class="card-body">
							<div class="card-title">
								<h3 class="text-center title-2">Edit category name</h3>
							</div>
							<hr>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Category name</label>
									<input id="cc-pament" name="cat_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $row['cat_name']?>">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Category image</label>
									<input id="cc-pament" name="cat_image" type="file" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $row['cat_image']?>" >
								</div>
								
								<div>
									<button id="payment-button"name="submit" type="submit" class="btn btn-lg btn-info btn-block" >
										<span id="payment-button-amount" >save</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php include("../includes/admin_footer.php") ; ?>