<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
<!--------------- 1st Get Iphone Product info for index.php -------------- -->
		<?php  
			$getIphone = $product->latestFromIphone();  //---> Method-1  (goto class-Product.php, Method-9)
			if ($getIphone) 
			{
				while ($result= $getIphone->fetch_assoc()) 
				{
		?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<span style="color:Blue"><?php echo $result['productName'];?></p>
						<p><?php echo $fm->textShorten($result['body'],50);?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>			
				<?php } } ?>		
	<!-- _______________________________ X ________________________________ -->

	<!--------------- 2nd Get Samsung Product info for index.php -------------- -->
		<?php  
				$getSamsung = $product->latestFromSamsung();  //---> Method-1  (goto class-Product.php, Method-10)
				if ($getSamsung) 
				{
					while ($result= $getSamsung->fetch_assoc()) 
					{
		?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<span style="color:Blue"><?php echo $result['productName'];?></p>
						<p><?php echo $fm->textShorten($result['body'],50);?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
		<?php } } ?>		
	<!-- _______________________________ X ________________________________ -->			
			</div>

			<div class="section group">

	<!--------------- 3rd Get Acer Product info for index.php -------------- -->
		<?php  
				$getAcer = $product->latestFromAcer();  //---> Method-1  (goto class-Product.php, Method-11)
				if ($getAcer) 
				{
					while ($result= $getAcer->fetch_assoc()) 
					{
		?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>ACER</h2>
						<span style="color:Blue"><?php echo $result['productName'];?></p>
						<p><?php echo $fm->textShorten($result['body'],50);?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
		<?php } } ?>		
	<!-- _______________________________ X ________________________________ -->	
			   
	<!--------------- 4th Get Canon Product info for index.php -------------- -->
		<?php  
				$getCanon = $product->latestFromCanon();  //---> Method-1  (goto class-Product.php, Method-12)
				if ($getCanon) 
				{
					while ($result= $getCanon->fetch_assoc()) 
					{
		?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Canon</h2>
						<span style="color:Blue"><?php echo $result['productName'];?></p>
						<p><?php echo $fm->textShorten($result['body'],50);?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
		<?php } } ?>		
	<!-- _______________________________ X ________________________________ -->	
				
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>