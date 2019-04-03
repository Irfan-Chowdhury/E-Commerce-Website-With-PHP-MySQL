<?php include 'inc/header.php' ?>
<?php include 'inc/slider.php' ?>
<?php 
	//echo session_id(); //------->> Just For Understand

	// $filepath =realpath(dirname(__FILE__));  //------->> Just For Understand
	// echo $filepath;
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  <!-- ---------------- 1st Get All Product for 'Featured Product' -------------- -->
		  	<?php
				$getFpd = $product->getFeaturedProduct();  //F=featured,pd=product Watch- class/Product.php, method-6
				if ($getFpd) 
				{
					while ($result = $getFpd->fetch_assoc()) 
					{
		 	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
			<?php } } ?>	
		<!-- _______________________________ X ________________________________ -->
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

		 <!-- ---------------- 2nd Get All Product for 'Featured Product' -------------- -->
			<?php
				$getNpd = $product->getNewProduct(); //N=New, pd=product
				if ($getNpd) 
				{
					while ($result = $getNpd->fetch_assoc()) 
					{
		 	?>	
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
			<?php } } ?>
		<!-- _______________________________ X ________________________________ -->		
			</div>
    </div>
 </div>
</div>
	 

<?php include 'inc/footer.php' ?>
