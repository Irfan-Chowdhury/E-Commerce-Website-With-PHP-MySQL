<?php include 'inc/header.php' ?>
<!-- ------------------- 1st For (wihtout login if he try to acces mmain page) -------------------- -->
<?php 
	$login = Session::get("customerLogin");  //watch Customer.php, method-2
	if ($login == false) {   
		header("Location:login.php");
	}
?>
<!-- __________________________ X ____________________________________	-->
<style>
.tblone tr td{text-align:justify}
</style>

<?php
if (isset($_GET['customerId'])) {
    $customerId = $_GET['customerId'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $confirm = $cart->productShiftConfirm($customerId,$time,$price); //Method-3  (watch class/Cart.php, Method-13)
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
                <h2>Your Ordered Details</h2>
                <table class="tblone">
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
<!-- ---------------- 2nd Get Card's Product under each customerId -------------- -->		
<?php
    $customerId= Session::get("customerId");
    $getOrder = $cart->getOrderProduct($customerId);   //---> Method- 2 (watch Cart.php, method-8) 
    if ($getOrder) {
        $i = 0;
        while ($result = $getOrder->fetch_assoc()) {
            $i++;
?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName']; ?></td>
                        <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                        <td><?php echo $result['quantity']; ?></td>
                        <td>$ <?php echo $result['price']; ?></td>
                        <td><?php echo $fm->formatDate($result['date']); ?></td>
                        <td>
<?php 
    if ($result['status']=='0') {
        echo "Pending";
    }elseif($result['status']=='1'){ 
        echo "shifted";
 }else {
        echo "ok";
    } 
?>                      </td>
              
<?php if($result['status']=='1') { ?>

                        <td><a href="?customerId=<?php echo $customerId; ?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Confirm</a></td>

<?php }elseif ($result['status']=='2') { ?>

                        <td>ok</td>

<?php }elseif ($result['status']=='0') { ?>
                        
                        <td>N/A</td>
<?php }  ?>
                    </tr>

<?php } } ?>
<!-- _______________________________ X ________________________________ -->	
						</table>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>

<?php include 'inc/footer.php' ?> 