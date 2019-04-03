<?php include 'inc/header.php' ?>

<!-- ------------------- 1st For (wihtout login Nobody can acces this page) -------------------- -->
<?php 
	$login = Session::get("customerLogin");  //watch Customer.php, method-2
	if ($login == false) {   
		header("Location:login.php");
	}
?>
<!-- __________________________ X ____________________________________	-->

<!-- ------------------- 3,4 For order -------------------- -->
 <?php
    if (isset($_GET['orderid']) && $_GET['orderid']=='order') { //line 161
        
        $customerId = Session::get("customerId");
        
        $insertOrder = $cart->orderProduct($customerId); // Method-3 (watch Cart.php, method-7)
        
        $delCart = $cart->delCustomerCart();             // Method-4 (watch Cart.php, methos-6)
        
        header("Location:success.php");
    }
 ?>
 <!-- __________________________ X ____________________________________	-->
 <style>
 .tblone{width:550px;margin:0 auto; border:2px solid #ddd;}
 .tblone tr td{text-align:justify;}
 .division{width:50%;float:left}    
 .tbltwo{float:right;text-align:left;width:60%;border:2px solid #ddd;margin-right:14px;margin-top:12px;}
 .tbltwo tr td{text-align:justify;padding:5px 10px;}
 .ordernow{padding-bottom:30px;}
 .ordernow a{width: 200px;margin: 20px auto 0;text-align: center;padding: 5px;font-size: 30px;display: block;background: #ff0000;color:#fff;border-radius: 3px; }
 </style>
 
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="division">
                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
    <!-- ---------------- 1st Get Card's Product under each sessionId -------------- -->		
<?php
    $getProduct = $cart->getCardProduct();   //---> Method-1  (Goto Cart.php, method-2)
    if ($getProduct) {
        $sum=0; //check line-81
        $quantity=0; //check line-78
        $i = 0;
        while ($result = $getProduct->fetch_assoc()) {
            $i++;
?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td>$ <?php echo $result['price']; ?></td>
						<td><?php echo $result['quantity']; ?></td>
						<td>$
<?php 
    $total = $result['price'] * $result['quantity'];
    echo $total; 
?>
						</td>
					</tr>
<?php 
      $sum = $sum + $total; //--for showing sum
      $quantity = $quantity + $result['quantity']; //--for showing quantity
    } } 
?>
<!-- _______________________________ X ________________________________ -->	
						</table>
				
						<table class="tbltwo">
							<tr>
                                <td>Sub Total</td>
                                <td>:</td>
								<td>$ <?php echo $sum; ?></td>
							</tr>
							<tr>
                                <td>VAT</td>
                                <td>:</td>
								<td>10% ($ <?php echo $vatResult= $sum * 0.1 ;?> )</td>  
							</tr>
							<tr>
                                <td>Grand Total</td>
                                <td>:</td>
								<td>$
<?php 
    $vatResult= $sum + ($sum*(10/100));
    echo $vatResult;
?>
                                </td>                                
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>:</td>
								<td><?php echo $quantity; ?></td>
							</tr>
					   </table>	
            </div>
            <div class="division">
<!-- ------------------- 2nd For (Get Customer Details from tbl_customer) -------------------- -->
<?php 
    $customerId= Session::get("customerId"); //watch Customer.php, method-2
    $getData = $customer->getCustomerData($customerId); //-->Method-2 (watch Customer.php, method-3)
    if ($getData) {
        while ($result = $getData->fetch_assoc()){
?>
			<table class="tblone">
                <tr>
                    <td colspan="3"><h2>Your Profile Details</h2></td>
                </tr>
                <tr>
                    <td width='20%'>Name</td>
                    <td width='5%'>:</td>
                    <td><?php echo $result['name']; ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email']; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address']; ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['city']; ?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode']; ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country']; ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="editprofile.php">Update Details</a></td>
                </tr>

            </table>	
<?php } } ?>
<!-- __________________________ X ____________________________________	--> 
            </div>

 		</div>
     </div>
    </div>
     <div class="ordernow"><a href="?orderid=order">Order</a></div>
</div>

<?php include 'inc/footer.php' ?>


