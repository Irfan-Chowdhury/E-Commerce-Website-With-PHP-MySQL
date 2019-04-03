<?php include 'inc/header.php' ?>
<style>
.mybutton{width:100px; float:left; margin-right:50px;}
</style>
<?php
    if (isset($_GET['productid'])) {
        $productid= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['productid']); //you can ignore this line
    }

// ----------------------------------------------------
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) 
	{
        $quantity    = $_POST['quantity'];
		$addCart     = $cart->addToCard($quantity, $productid);  //--->Method-2 (goto classes/Cart.php, Method-1)
	}
// ----------------------------------------------------
	$customerId= Session::get("customerId");
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['compare'])) {
		$productId    = $_POST['productId'];
		$insertCompare = $product->insertCompareData($productId,$customerId);  //watch class/Product.php ,method-14
	}
// ----------------------------------------------------

	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['wlist'])) {
		$insertWlist = $product->insertWlistData($productid,$customerId);  //watch class/Product.php ,method-17
	}

?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
	<!-- ---------------- 1st Get All Product for 'Details' -------------- -->
<?php
	$getproduct = $product->getSingleProduct($productid); //--->Method-1  (goto classes/Product.php, method-8) 
	if ($getproduct){
		while ($result = $getproduct->fetch_assoc()) {
?>			
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>			
				</div>
				<span  style="color:red;font-size:18px;">

<?php if (isset($addCart)) {echo $addCart;}?>  <!-- Show Message -->
<?php if (isset($insertCompare)) {echo $insertCompare;}?>  <!-- Show Message -->
<?php if (isset($insertWlist)) {echo $insertWlist;}?>  <!-- Show Message -->
				
				</span>

<!-- ---------------- without login can not see 'Add Compare' -------------- -->
<?php
	$login = Session::get("customerLogin");  //watch Customer.php, method-2
	if ($login == true) { 
?>  
					<div class="add-cart">
						<div class="mybutton">
							<form action="" method="post">
								<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'] ?>" /> 
								<input type="submit" class="buysubmit" name="compare" value="Added Compare">  <!-- line 17 -->
							</form>
						</div>
						<div class="mybutton">	
							<form action="" method="post">
								<input type="submit" class="buysubmit" name="wlist" value="Save to list">  
							</form>
						</div>
					</div>
<?php } ?>						
<!-- ______________________________ X __________________________________	 -->
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['body']; ?></p>					
	    </div>
<?php } } ?>						
<!-- _______________________________ X ________________________________ -->
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>

	<!-- ---------------- 2nd Get All Category for 'Details' -------------- -->	
<?php
	$getCategory = $category->getAllCat(); //--->Method-3
	if ($getCategory) {
		while ($catresult = $getCategory->fetch_assoc()) {
?>	
					<ul>
				      <li><a href="productbycat.php?catId=<?php echo $catresult['catId']; ?>"><?php echo $catresult['catName']; ?></a></li>
    				</ul>
<?php } } ?>
	<!-- _______________________________ X ________________________________ -->		
 				</div>
 		</div>
 	</div>
	</div>

	<?php include 'inc/footer.php' ?>


