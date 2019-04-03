<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	// include '../classes/Cart.php';       	//option-1  OR 
	$filepath = realpath(dirname(__FILE__)); 	//Option-2
	include_once ($filepath.'/../classes/Cart.php');
	$cart = new Cart();
	$fm   = new Format();
?>
<!-- ********************* 2nd (for shifted মানে  ডাটাবাজে status=1 আপডেট হবে)********************	 -->
<?php
if (isset($_GET['shiftId'])) {
	 $customerId = $_GET['shiftId'];
	 $time = $_GET['time'];
	 $price = $_GET['price'];
	 $shifted = $cart->productShifted($customerId,$time,$price); //Method-2  (watch class/Cart.php, Method-11)
}

//  ********************* 3rd (for Deleted ) ****************************************
if (isset($_GET['delProId'])) {
	$customerId = $_GET['delProId'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$delOrder = $cart->deProductShifted($customerId,$time,$price); //Method-2  (watch class/Cart.php, Method-12)
}
?>
<!-- ____________________________________ X _____________________________________________	 -->
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<?php
	if (isset($shifted)) {  //for shifted Message Show
		echo $shifted;
	}

	if (isset($delOrder)) {  //for Remove Message Show
		echo $delOrder;
	}
?>				
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>OrderId</th>
							<th>Order Time</th>
							<th>ProductId</th>
							<th>ProductName</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>CustomerId</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<!-- ********************* 1st (for Shwing Order list in inbox)********************	 -->
<?php
	$getOrder = $cart->getAllOrderProduct(); //Method-1  (watch Cart.php, method-10)
	if ($getOrder) {
		$i=0;
		while ($result= $getOrder->fetch_assoc()) {
			$i++;
?>					    
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['orderId']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productId']; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td>$ <?php echo $result['price']; ?></td>
							<td><?php echo $result['customerId']; ?></td>
							<td><a href="customer.php?customerId=<?php echo $result['customerId']; ?>">View Details</a></td>
					<?php if ($result['status']=='0') { ?>
							
							<td><a href="?shiftId=<?php echo $result['customerId'];?>
										  &price=<?php echo $result['price'];?>
										  &time=<?php echo $result['date'];?>">Shifted</a></td>
							
					<?php } elseif($result['status']=='1') { ?>
					
							<td>Pending</td>												
					
					<?php }else { ?>
							<td><a href="?delProId=<?php echo $result['customerId'];?>
										  &price=<?php echo $result['price'];?>
										  &time=<?php echo $result['date'];?>">Remove</a></td>
					<?php } ?>		
						</tr>
<?php } } ?>
<!-- ____________________________________ X _____________________________________________	 -->
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
