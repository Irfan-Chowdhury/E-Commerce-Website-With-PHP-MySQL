<?php include 'inc/header.php' ?>
<?php
    $login = Session::get("customerLogin");  //watch Customer.php, method-2
    if ($login == false) 
    {   
        header("Location:login.php");
    }
?>
<!-- -------------- for Remove  -->
<?php
    if (isset($_GET['delwlistid'])) {
        $productId= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['delwlistid']); //you can ignore this line
        $delWlist= $product->delWlistData($customerId,$productId); //Check clas-Product, Method-19
    }
?>
<!-- ________________ X _________________ -->
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
					<h2>Wish List</h2>
					<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
                                <th>Image</th>
								<th>Action</th>
							</tr>
<!------------ 1st -------------- -->		
<?php
    $getProduct= $product->getWlistData($customerId); //Check clas-Product, Method-18
    if ($getProduct) {
        $i = 0;
        while ($result = $getProduct->fetch_assoc()) {
            $i++;
?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['productName']; ?></td>
                            <td>$ <?php echo $result['price']; ?></td>
                            <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>										
                            <td>
                                <a href="details.php?productid=<?php echo $result['productId'];?>">Buy Now || </a>
                                <a href="?delwlistid=<?php echo $result['productId'];?>">Remove</a>
                            </td>
    <?php } } ?> 
						</tr>
				<!-- _______________________________ X ________________________________ -->	
						</table>
				</div>

<!-- ------------ without login you can not seen ----------- -->
<?php 
    $login = Session::get("customerLogin");
    if ($login == true ) { ?>
                <div class="shopping">
                    <div class="shopleft" style="width:100%;text-align:center;">
                        <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                    </div>
                </div>
<?php } ?>
<!-- ______________________ X ____________________________________	 -->
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php' ?>