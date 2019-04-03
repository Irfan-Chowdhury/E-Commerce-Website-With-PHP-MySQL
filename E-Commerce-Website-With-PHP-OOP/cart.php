<?php include 'inc/header.php' ?>
<?php 

	if(isset($_GET['delcartid']))  // <<----- for Delete Cart
	{
		//$delid=$_GET['delcat'];
		$delid= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['delcartid']);
		$deleteCart= $cart->delCartById($delid);  //--->Method-3.1 (goto classes/Cart.php, Method-4)
		
	}
		// ------------------------------------------
		
	if ($_SERVER['REQUEST_METHOD']=='POST') //<<----- for Update
	{
        $cartId     = $_POST['cartId'];
        $quantity   = $_POST['quantity'];
		$updateCard = $cart->updateCardQuantity($cartId, $quantity);  //--->Method-2 (goto classes/Cart.php, Method-3)
		if ($quantity <=0 ) {
			//$deleteCart= $cart->delCartById($delid); //wrong system, explain in photo
			$deleteCart= $cart->delCartById($cartId); //--->Method-3.2 (goto classes/Cart.php, Method-4)
		}
	}
		// ------------------------------------------

		if (!isset($_GET['id'])) //<<----- Refresh for Auto Updated for total amount and quantity in "Cart" When add new cart or delete
		{
			echo "<meta http-equiv='refresh' content='0;URL=?id=live' />";
		}

?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
					<h2>Your Cart</h2>
				
					<?php if (isset($updateCard)) {echo $updateCard;}?>  <!-- Show Message -->
					<?php //if (isset($deleteCart)) {echo $deleteCart;}?>  <!-- Show Message -->

					<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="15%">Action</th>
							</tr>
			<!-- ---------------- 1st Get Card's Product under each sessionId -------------- -->		
						<?php
							$getProduct = $cart->getCardProduct();   //---> Method-1  (Goto Cart.php Method-2)
							if ($getProduct) 
							{
								$sum=0; //check line-77
								$quantity=0; //check line-78
								$i = 0;
								while ($result = $getProduct->fetch_assoc()) 
								{
									$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>$ <?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$ 
									<?php 
										$total = $result['price'] * $result['quantity'];
										echo $total; 
									?>
								</td>
	<!-- for Delete cart -->    <td><a onclick="return confirm('Are you sure to Delete !');" href="?delcartid=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>
							<?php 
								$sum = $sum + $total; //--for showing sum
								$quantity = $quantity + $result['quantity']; //--for showing quantity

								Session::set("sum",$sum);
								Session::set("quantity",$quantity);
							?>		
					<?php } } ?> 
						
				<!-- _______________________________ X ________________________________ -->	
						</table>
				
				<!-- ---------------- 2nd For Check Cart for header.php -------------- -->		
					<?php 
						$getData= $cart->checkCartTable(); //--->Method-4 (Go to class-Cart.php, method-5)
						if($getData)
						{
					?>	
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$ <?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10 %</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$
									<?php 
										$vatResult= $sum + ($sum*(10/100));
										echo $vatResult;
									?>
								</td>
							</tr>
					   </table>	
					
					<?php 
						} else {
							 //header("Location:index.php");
							echo "<h3 style='color:red'>Empty Cart.. Pls Shop Now </h3>";
						} 
					?> 
			<!-- _______________________________ X ________________________________ -->  
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php' ?>
