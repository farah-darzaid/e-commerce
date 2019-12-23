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
	//header("Location:manage_product.php");
	exit;
}
include("../includes/admin_header.php");
?>
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="table-responsive m-b-40">
				<table class="table table-borderless table-data3">
					<thead>
						<tr>
							<th>product Name</th>
							<th>price</th>
							<th>descrption</th>
							<th>Image</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						//query to select from DB table
						$query = "SELECT * FROM product WHERE cat_id={$_GET['cat_id']}";
						$result = mysqli_query($conn,$query);
						//To take all records
						while ($row = mysqli_fetch_assoc($result)){
							//Print records
							echo "<tr>"; 
							echo "<td> {$row['product_name']} </td>";
							echo "<td> {$row['product_price']} </td>";
							echo "<td> {$row['product_desc']} </td>";
							echo "<td><img src = 'upload/{$row['pro_image']}' </td>";
							
							//send hovered id in query string 
							
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