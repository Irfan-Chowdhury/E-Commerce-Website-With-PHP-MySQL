<?php include 'inc/header.php' ?>

<?php
	if (!isset($_GET['catId']) || $_GET['catId']==NULL) {
		echo "<script>window.location='404.php';</script>";
	}
	else
	{
		//$catid=$_GET['catid'];
		$catId= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['catId']); //you can ignore this line
	}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
		<!--------------- 2nd for Category Name -------------- -->
		<?php 
			$catName = $category->getCatById($catId);  //---> Method-2  (goto class-Category.php, Method-3)
			if ($catName){
				while ($result = $catName->fetch_assoc()) {			
		?>    
    		<h3>Latest from <?php echo $result['catName'];?> Category</h3>
		<?php } } ?>	
    <!-- _______________________________ X ________________________________ -->			
				</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
	<!--------------- 1st Category Product info for productbycat.php -------------- -->
		<?php  
			$productByCat = $product-> productByCat($catId); //---> Method-1  (goto class-Product.php, Method-13)
			if ($productByCat) 
			{
				while ($result = $productByCat->fetch_assoc()) 
				{
		?>
			<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
			</div>
		
		<?php } }
			   else{
			   echo "<h3 style='color:red'>Sorry !! Products of this Category are not available. </h3>";
			
		 } ?>	
	<!-- _______________________________ X ________________________________ -->	
		</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php' ?>
