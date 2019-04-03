<?php 
        include 'lib/Session.php'; 
		Session::init();

		include_once 'lib/Database.php';
		include_once 'helpers/Format.php';
		
		spl_autoload_register(function($class){
			include_once "classes/".$class.".php";
		});

		$db 			= new Database();
		$fm 			= new Format();
		$product 	= new Product();
		$category = new Category();
		$brand    = new Brand();
		$cart 		= new Cart();
		$customer = new Customer();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
				
				<!-- -----------1st For Showing Total amount in card ------------------- -->
										<?php
												$getData = $cart->checkCartTable(); //--->Method-1  (Go class-Cart.php, Method-5)
												if ($getData) {
													$sum = Session::get("sum"); //from cart.php
													$quantity = Session::get("quantity"); //from cart.php
													echo "$".$sum." | Qnt:".$quantity;
												}
												else
												{
													echo "(Empty)";
												}
										?>
				<!-- ___________ X ________________ -->
							</span>
							</a>
						</div>
			      </div>
		   <div class="login">

<!-- 3rd after logout it's Session will destroy & redirct into login.php and also delete Cart/Compare tble data ------------------- -->
<?php
	if(isset($_GET['customerId'])){
			$customerId= Session::get("customerId");
			$delCart 	 = $cart->delCustomerCart();  //watch Cart.php, methos-6
			$delCompare= $product->delCompareData($customerId); //watch Product.php, methos-16
			Session::destroy();
	}
?>
<!-- _______________________ X ________________________ -->

<!-- -----------2nd For Showing Login or Logout option------------------- -->
<?php 
		$login = Session::get("customerLogin");  //watch Customer.php, method-2
		if ($login == false) { ?>
						<a href="login.php">Login</a>
<?php } else {  ?>
						<a href="?customerId=<?php Session::get("customerId"); ?>">Logout</a>
<?php } ?>	  
<!-- ______________________ X ________________ -->
			 </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="topbrands.php">Top Brands</a></li>

<!-- -----------7th for shwing compare if data in exists database------------------- -->
<?php
	$customerId= Session::get("customerId");
	$getProduct= $product->getCompareData($customerId); //Check clas-Product, Method-15
	if ($getProduct) {
?>
		<li><a href="compare.php">Compare</a></li>
<?php } ?>	
<!-- ______________ X _________________________		 -->

<!-- ----------8th for shwing WishList if data in exists database------------------- -->
<?php
	$checkWlist= $product->getWlistData($customerId); //Check clas-Product, Method-18
	if ($checkWlist) {
?>
		<li><a href="wishlist.php">WishList</a></li>
<?php } ?>	
<!-- ______________ X _________________________		 -->

		<li><a href="contact.php">Contact</a></li>

<!-- --(No need) ---------5th (Cart will be show after Checking Data from Cart table  )------------------- -->
<?php
	$checkCart = $cart->checkCartTable(); //watch Cart.php, method-5 
	if ($checkCart) { ?>

		<li><a href="cart.php">Cart</a></li>
		<li><a href="payment.php">Payment</a></li>

<?php	} ?>
<!-- ______________________ X ________________ -->		

<!-- ---------6th for Showing 'Order Details' after Checking from tbl_order and also Showing when customer "Logged In"------------------- -->	  
<?php
		$customerId= Session::get("customerId");
		$checOrder = $cart->checkOrder($customerId); //method-6  (watch- Cart.php, method-9) 
		if ($checOrder) { ?>

			<li><a href="orderdetails.php">Order Details</a></li>

<?php	} ?>
<!-- ______________________ X ________________ -->

<!-- -----------4th (Profile will be show after login )------------------- -->
<?php
		$loginProfile = Session::get("customerLogin"); //watch Customer.php, method-2
		if ($loginProfile == true) { ?>

			<li><a href="profile.php">Profile</a> </li>

<?php } ?>		
<!-- ______________________ X ________________ -->	  
	  <div class="clear"></div>
	</ul>
</div>