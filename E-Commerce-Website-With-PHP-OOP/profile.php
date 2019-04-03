<?php include 'inc/header.php' ?>

<!-- ------------------- 1st For (wihtout login if he try to acces main page) -------------------- -->
<?php 
	$login = Session::get("customerLogin");  //watch Customer.php, method-2
	if ($login == false) {   
		header("Location:login.php");
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

<?php include 'inc/footer.php' ?>


