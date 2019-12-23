<?php 
include("../includes/connection.php");
//the action will start if user press button
if(isset($_POST['submit'])){
	//fetch data from web form
	$cat_name    = $_POST['cat_name'];
	$cat_image   = $_FILES['cat_image']['name'];
	$tmp_name    = $_FILES['cat_image']['tmp_name'];
	$path        ="upload/"; 
	move_uploaded_file($tmp_name, $path.$cat_image);

	$query = "insert into category(cat_name,cat_image) values('$cat_name','$cat_image')";
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
						<div class="card-header">Add New Category</div>
						<div class="card-body">
							<div class="card-title">
								<h3 class="text-center title-2">New Category</h3>
							</div>
							<hr>
							<form action="" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Category name</label>
									<input id="cc-pament" name="cat_name" type="text" class="form-control" aria-required="true" aria-invalid="false">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Category image</label>
									<input id="cc-pament" name="cat_image" type="file" class="form-control" aria-required="true" aria-invalid="false">
								</div>
								
								<div>
									<button id="payment-button"name="submit" type="submit" class="btn btn-lg btn-info btn-block" >
										<span id="payment-button-amount" >Add Category</span>
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
							<th>Image</th>
							<th>Name</th>
							<th>View</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						//query to select from DB table
						$query  = "SELECT * FROM category";
						$result = mysqli_query($conn,$query);
						//To take all records
						while ( $row = mysqli_fetch_assoc($result)){
							//Print records
							echo "<tr>"; 
							echo "<td> {$row['cat_id']} </td>";
							echo "<td><img src = 'upload/{$row['cat_image']}' </td>";
							echo "<td> {$row['cat_name']} </td>";
							echo "<td><a href='view_pro.php?cat_id={$row["cat_id"]}'><button type='button' class='btn btn-success btn-lg'>View Product</button></a></td>";
							//send hovered id in query string 
							echo "<td><a href='edit_cat.php?cat_id={$row["cat_id"]}' class='btn btn-warning'> Edit </a></td>";
							echo "<td> <a href='delete_cat.php?cat_id={$row["cat_id"]}'class='btn btn-danger'>Delete </a></td>";
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