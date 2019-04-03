<?php include 'inc/header.php' ?>
<?php
    $login = Session::get("customerLogin");  //watch Customer.php, method-2
    if ($login == false) 
    {   
        header("Location:login.php");
    }
?>
<style>
    table.tblone img{height:90px; width:100px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
					<h2>Compare</h2>
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
    $customerId= Session::get("customerId");
    $getProduct= $product->getCompareData($customerId); //Check clas-Product, Method-15
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
                            <td><a href="details.php?productid=<?php echo $result['productId'];?>">View</a></td>
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