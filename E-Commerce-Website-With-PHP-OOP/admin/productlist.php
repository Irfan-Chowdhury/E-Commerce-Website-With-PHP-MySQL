<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include_once '../helpers/Format.php';?>

<?php
	 $product= new Product();
	 $fm	 = new Format();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>

		<!-- *************** 2nd for Delete ********************************	 -->
		<?php 
			if(isset($_GET['delproduct'])){
				//$delid=$_GET['delcat'];
				$delid= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['delproduct']); //you can ignore this line
				$deleteProduct= $product->delProductById($delid);
			}
		?>
    <!-- ____________________X__________________________	 -->		
 
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Pruduct Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
	<!-- ****************** 1st *****************************	 -->
		<?php
			$getProduct= $product->getAllProduct();
			if ($getProduct) {
				$i=0;
				while ($result=$getProduct->fetch_assoc()) {
					$i++;
		?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
					<td><?php echo $fm->textShorten($result['body'],30) ;?></td>
					<td>$<?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="40px" width="60px" alt=""> </td>
					<td>
						<?php 
							if ($result['type']==0) 
							{
								echo "Featured";
							}
							else
							{
								echo "General";
							}
						?>
					</td>
					<td>
						<a href="productedit.php?productid=<?php echo $result['productId']; ?>">Edit || </a>  
						<a onclick="return confirm('Are you sure to Delete ?');" href="?delproduct=<?php echo $result['productId']; ?>">Delete</a>
					</td>
				</tr>
		<?php } } ?>	
    <!-- ___________________ X _____________________________	 -->
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
