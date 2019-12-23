<?php 
//the action will start if user press button
include("../includes/connection.php");
if(isset($_POST['submit'])){
		//fetch data from web form
	$email       = $_POST['admin_email'];
	$password    = $_POST['admin_password'];
	$fullname    = $_POST['fullname'];
	//get data from file
	$admin_image = $_FILES['admin_image']['name'];
	$tmp_name    = $_FILES['admin_image']['tmp_name'];
	$path        = "upload/";

	move_uploaded_file($tmp_name, $path.$admin_image);


	$query = "insert into admin(admin_email,admin_password,fullname,admin_image) values('$email','$password','$fullname','$admin_image')";
		//perform the query 
	mysqli_query($conn,$query);
}
include("../includes/admin_header.php");
?>

<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">Create Admin</div>
						<div class="card-body">
							<div class="card-title">
								<h3 class="text-center title-2">New Admin</h3>
							</div>
							<hr>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Admin Email</label>
									<input id="cc-pament" name="admin_email" type="email" class="form-control" aria-required="true" aria-invalid="false">
								</div>
								<div class="form-group has-success">
									<label for="cc-name" class="control-label mb-1">Admin Password</label>
									<input id="cc-name" name="admin_password" type="password" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
									autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
									<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
								</div>
								<div class="form-group">
									<label for="cc-number" class="control-label mb-1">Admin Full Name</label>
									<input id="cc-number" name="fullname" type="text" class="form-control cc-number identified visa" value="" data-val="true"
									data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
									autocomplete="cc-number">
									<span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
								</div>
								<div class="form-group">
									<label for="cc-number" class="control-label mb-1">Admin Image</label>
									<input id="cc-number" name="admin_image" type="file" class="form-control cc-number identified visa" data-val="true"
									data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
									autocomplete="cc-number">
									<span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
								</div>
								
								<div>
									<button id="payment-button"name="submit" type="submit" class="btn btn-lg btn-info btn-block" >
										<span id="payment-button-amount" >Save</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


			<div class="table-responsive m-b-40">
				<table class="table table-borderless table-data3">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Image</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						//query to select from DB table
						$query  = "SELECT * FROM admin";
						$result = mysqli_query($conn,$query);
							//To take all records
						while ( $row = mysqli_fetch_assoc($result)){
							//Print records
							echo "<tr>"; 
							echo "<td> {$row['admin_id']} </td>";
							echo "<td> {$row['fullname']} </td>";
							echo "<td> {$row['admin_email']} </td>";
							echo "<td> <img src ='upload/{$row['admin_image']}'></td>";
							//send hovered id in query string 
							echo "<td><a href='edit_admin.php?admin_id={$row["admin_id"]}' class='btn btn-warning'> Edit </a></td>";
							echo "<td> <a href='delete_admin.php?admin_id={$row["admin_id"]}'class='btn btn-danger'>Delete </a></td>";
							echo "</tr>";

						}

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<link href="font/font-face.css" rel="stylesheet">
<?php include("../includes/admin_footer.php") ; ?>