<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
	 $cat= new Category();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
				
	<!-- *************** 2nd for Delete ********************************	 -->
		<?php 
			if(isset($_GET['delcat'])){
				//$delid=$_GET['delcat'];
				$delid= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['delcat']); //you can ignore this line
				$deleteCat= $cat->delCatById($delid);
			}
		?> 
    <!-- ____________________X__________________________	 -->
		        <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

	<!-- ****************** 1st *****************************	 -->
			<?php
				$getCat= $cat->getAllCat();
				if ($getCat) {
					$i=0;
					while ($result=$getCat->fetch_assoc()) {
						$i++;
			?>
    <!-- ___________________X___________________________	 -->
					<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td>
								<a href="catedit.php?catid=<?php echo $result['catId']; ?>">Edit ||</a>  
								<a onclick="return confirm('Are you sure to Delete !');" href="?delcat=<?php echo $result['catId']; ?>">Delete</a>
							</td>
						</tr>
				<?php } }  ?>		
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

