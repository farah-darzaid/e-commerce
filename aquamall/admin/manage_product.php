<?php 
include("../includes/connection.php");
//the action will start if user press button
if(isset($_POST['submit'])){
	//fetch data from web form
	$product_name  = $_POST['product_name'];
	$product_price = $_POST['product_price'];
	$product_desc  = $_POST['product_desc'];
	$cat_name      = $_POST['cat_name'];
	$cat_id        = $_POST['cat_id'];
	$pro_image     = $_FILES['pro_image']['name'];
	$tmp_name      = $_FILES['pro_image']['tmp_name'];
	$path          = "upload/"; 
	move_uploaded_file($tmp_name, $path.$pro_image);

	$query = "INSERT INTO product(product_name,product_price,product_desc,cat_id,pro_image) VALUES('$product_name','$product_price','$product_desc','$cat_id','$pro_image')";
	//perform the query 
	//echo $query;die;
	

	mysqli_query($conn,$query);
	//stop inserting while refrexh
	header("Location:manage_product.php");
	exit;
}
include("../includes/admin_header.php");
?>

<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">Add New Product</div>
						<div class="card-body">
							<div class="card-title">
								<h3 class="text-center title-2">New Product</h3>
							</div>
							<hr>
							<form action="" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Product name</label>
									<input id="cc-pament" name="product_name" type="text" class="form-control" aria-required="true" aria-invalid="false">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Product price</label>
									<input id="cc-pament" name="product_price" type="number" class="form-control" aria-required="true" aria-invalid="false">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Product description</label>
									<input id="cc-pament" name="product_desc" type="text" class="form-control" aria-required="true" aria-invalid="false">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Product image</label>
									<input id="cc-pament" name="pro_image" type="file" class="form-control" aria-required="true" aria-invalid="false">
								</div>
								<div  class="form-group">
									<label for="cc-payment" class="control-label mb-1">Cat_ID</label>
									<select id="cc-pament" name="cat_id" class="form-control" required>
										<?php
										$query = "SELECT * FROM category";
										$result = mysqli_query($conn,$query);
										while ( $row = mysqli_fetch_assoc($result)){
											echo  "<option value ='{$row['cat_id']}'>{$row['cat_name']}</option>";
											}
										?>
									</select>

								</div>
								<div>
									<button id="payment-button"name="submit" type="submit" class="btn btn-lg btn-info btn-block" >
										<span id="payment-button-amount" >Add Product</span>
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
							<th>product Name</th>
							<th>cat Name</th>
							<th>price</th>
							<th>descrption</th>
							<th>Cat_#</th>
							<th>Image</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						//query to select from DB table
						$query = "SELECT * FROM product 
									INNER JOIN category ON
									category.cat_id = product.cat_id";
						$result = mysqli_query($conn,$query);
						//To take all records
						while ($row = mysqli_fetch_assoc($result)){
							//Print records
							echo "<tr>"; 
							echo "<td> {$row['product_name']} </td>";
							echo "<td> {$row['cat_name']} </td>";
							echo "<td> {$row['product_price']} </td>";
							echo "<td> {$row['product_desc']} </td>";
							echo "<td> {$row['cat_id']} </td>";
							echo "<td><img src = 'upload/{$row['pro_image']}' </td>";
							
							//send hovered id in query string 
							echo "<td><a href='edit_product.php?product_id={$row["product_id"]}' class='btn btn-warning'> Edit </a></td>";
							echo "<td> <a href='delete_product.php?product_id={$row["product_id"]}'class='btn btn-danger'>Delete </a></td>";
							echo "</tr>";

						}

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include("../includes/admin_footer.php") ; ?>