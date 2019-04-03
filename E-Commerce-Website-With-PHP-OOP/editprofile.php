<?php include 'inc/header.php' ?>

<!-- ------------------- 1st For (wihtout login if he try to acces main page) -------------------- -->
<?php 
	$login = Session::get("customerLogin");  //watch Customer.php, method-2
    if ($login == false) 
    {   
		header("Location:login.php");
	}

// <!-- ------------------- 3rd Use For Update Profile-------------------- -->
    
    $customerId = Session::get("customerId");  //watch Customer.php, method-2
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))  //Method-2 (watch class-Customer.php, method-1)
    {     
        $updateCustomer = $customer->customerUpdate($_POST,$customerId); //Method-3 (watch class/Customer.php, method-4)
	}
?>
<!-- __________________________ X ____________________________________	-->

 <style>
 .tblone{width:550px;margin:0 auto; border:2px solid #ddd;}
 .tblone tr td{text-align:justify;}
 </style>
 
 <div class="main">
    <div class="content">
    	<div class="section group">

<!-- ------------------- 2nd For (Get Customer Details from tbl_customer) -------------------- -->
<?php 
    $customerId= Session::get("customerId");            //watch Customer.php, method-2
    $getData = $customer->getCustomerData($customerId); //-->Method-2 (watch Customer.php, method-3)
    if ($getData) {
        while ($result = $getData->fetch_assoc()){
?>
        <form action="" method="post"> 
			<table class="tblone">

<?php 
    if(isset($updateCustomer)){  // For Message Show according to method-3
        echo "<tr><td colspan='2'>".$updateCustomer."</tr></td>";
    } 
?>
                <tr>
                    <td colspan="2"><h2>Update Profile Details</h2></td>
                </tr>
                <tr>
                    <td width='20%'>Name</td>
                    <td><input type="text"name="name" value="<?php echo $result['name']; ?>"></td>

                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text"name="phone" value="<?php echo $result['phone']; ?>"></td>

                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text"name="email" value="<?php echo $result['email']; ?>"></td>

                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text"name="address" value="<?php echo $result['address']; ?>"></td>

                </tr>
                <tr>
                    <td>City</td>
                    <td><input type="text"name="city" value="<?php echo $result['city']; ?>"></td>

                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td><input type="text"name="zipcode" value="<?php echo $result['zipcode']; ?>"></td>

                </tr>
                <tr>
                    <td>Country</td>
                    <td><input type="text"name="country" value="<?php echo $result['country']; ?>"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Save"></td>
                </tr>

               

            </table>	
    <?php } } ?>
 <!-- __________________________ X ____________________________________	-->   
    
    </form>

 		</div>
 	</div>
</div>

<?php include 'inc/footer.php' ?>


