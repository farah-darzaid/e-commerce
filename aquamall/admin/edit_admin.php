<?php

//the action will start if user press button
include("../includes/connection.php");
if(isset($_POST['submit'])){
		//fetch data from web form
	$email    = $_POST['admin_email'];
	$password = $_POST['admin_password'];
	$fullname = $_POST['fullname'];
	//get data from file
	$admin_image = $_FILES['admin_image']['name'];
	$tmp_name    = $_FILES['admin_image']['tmp_name'];
	$path        = "upload/";

	move_uploaded_file($tmp_name, $path.$admin_image);

	//check if user change image
	if($_FILES['admin_image']['error'] == 0){
		//return admin records
		$select = "SELECT * FROM admin WHERE admin_id= {$_GET['admin_id']}";
		$result = mysqli_query($conn,$select);
		$row    = mysqli_fetch_assoc($result);
		//delete image from upload file
		unlink("upload/".$row['admin_image']);

		//set new image 
		$query = "UPDATE admin SET admin_email = '$email',
		admin_password = '$password',
		fullname = '$fullname',
		admin_image = '$admin_image'
		where admin_id={$_GET['admin_id']}";
	}
	//if user dosnt change image
	else {
		$query = "UPDATE admin SET admin_email = '$email',
		admin_password = '$password',
		fullname = '$fullname'
		where admin_id={$_GET['admin_id']}";
	}
		//perform the query 
	mysqli_query($conn,$query);
	header("Location:manage_admin.php");

}
//Fetch old data
$query  = "SELECT * FROM admin WHERE admin_id = {$_GET['admin_id']}";
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
						<div class="card-header">Update Admin</div>
						<div class="card-body">
							<div class="card-title">
								<h3 class="text-center title-2">Edit Admin</h3>
							</div>
							<hr>
							<form action="" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Admin Email</label>
									<input id="cc-pament" name="admin_email" type="email" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $row['admin_email']?>">
								</div>
								<div class="form-group has-success">
									<label for="cc-name" class="control-label mb-1">Admin Password</label>
									<input id="cc-name" name="admin_password" type="password" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
									autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error"  value="<?php echo $row['admin_password']?>">
									<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
								</div>
								<div class="form-group">
									<label for="cc-number" class="control-label mb-1">Admin Full Name</label>
									<input id="cc-number" name="fullname" type="text" class="form-control cc-number identified visa"  data-val="true"
									data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
									autocomplete="cc-number"  value="<?php echo $row['fullname']?>">
									<span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
								</div>
								<div class="form-group">
									<label for="cc-number" class="control-label mb-1">Admin Image</label>
									<input id="cc-number" name="admin_image" type="file" class="form-control cc-number identified visa"  data-val="true"
									data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
									autocomplete="cc-number"  value="<?php echo $row['admin_image']?>">
									<span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
								</div>
								
								<div>
									<button id="payment-button"name="submit" type="submit" class="btn btn-lg btn-info btn-block" >
										<span id="payment-button-amount" >Edit</span>
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