<?php include 'inc/header.php' ?>

<!-- ------------------- 1st For (wihtout login if he try to acces this page) -------------------- -->
<?php 
	$login = Session::get("customerLogin");  //watch Customer.php, method-2
	if ($login == false) {   
		header("Location:login.php");
	}
?>
<!-- __________________________ X ____________________________________	-->
 
 <style>
.psuccess{width:500px;min-height: 200px;text-align: center;border: 1px solid;margin: 0 auto; padding: 20px;}
.psuccess h2{border-bottom: 1px solid #ddd; margin-bottom: 20px;padding-bottom:10px; }
.psuccess p{ line-height:25px; font-size:18px; text-align:left}
 </style>
 
 <div class="main">
    <div class="content">
    	<div class="section group">            
            <div class="psuccess">
                <h2>Payment Successful</h2>
<!-- ------------------- 2nd  -------------------- -->
<?php
    $customerId = Session::get('customerId');
    $amount = $cart->paybleAmount($customerId); //Method-1 (watch-class/Cart.php, Method-7)
    if ($amount) {
        $sum = 0;
        while ($result = $amount->fetch_assoc()) {
            $price = $result['price'];
            $sum   = $sum + $price;
        }
    }
?>                
                <p style='color:red'>Total Payble Amount (Including Vat) : $ 
<?php
    $vat    = $sum * 0.1;  //this line sometime create problem and show undefined varible= sum
    $total  = $sum + $vat;
    echo   $total;
?>
<!-- __________________________ X ____________________________________	-->
                </p>
                <p>Thanks for Purchase recieve. Your Order Succesfully.We will contact you ASAP with delivery details.Here is your Order detals... 
                    <a href="orderdetails.php">Visit Here..</a>  </p>
            </div>
 		</div>
 	</div>
</div>
</div>

<?php include 'inc/footer.php' ?>


