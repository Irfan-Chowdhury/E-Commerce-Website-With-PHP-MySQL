<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath = realpath(dirname(__FILE__)); 	//Option-2
    include_once ($filepath.'/../classes/Customer.php');
?>
<?php
    if (!isset($_GET['customerId']) || $_GET['customerId']==NULL) {
		echo "<script>window.location='inbox.php';</script>";
	}else{
        $customerId= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['customerId']); //you can ignore this line
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        echo "<script>window.location='inbox.php';</script>";
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock"> 

<!-- ************* 1st ***********************   -->
<?php
    $customer= new Customer();
    $getCustomer=$customer->getCustomerData($customerId);  //Method-1  (Watch Customer.php,method-3)
    if ($getCustomer) {
        while ($result=$getCustomer->fetch_assoc()) {
?>
                 <form action="" method="POST"> <!-- there is prob in action method if i use catedit.php-->
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['address']; ?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>City</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['city']; ?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Country</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['country']; ?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Zipcode</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['zipcode']; ?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['phone']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

						<tr>
                            <td></td> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } }  ?>  <!-- -->
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>