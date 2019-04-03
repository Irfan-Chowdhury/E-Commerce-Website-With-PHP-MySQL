<?php include 'inc/header.php' ?>
<!-- ------------------- 3rd For -> (if anyone try to acces login.php page when he already logged in) -------------------- -->
<?php 
		$login = Session::get("customerLogin"); //watch Customer.php, method-2
		if ($login == true) {   
			header("Location:index.php");
		}
?>
<!-- __________________________ X ____________________________________	-->

<!-- ------------------- 2nd For Login -------------------- -->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) { //Method-2 (watch class-Customer.php, method-1)
		$customerLogin = $customer->customerLogin($_POST); //Method-2 (watch class-Customer.php, method-2)
	}
?>
	<div class="main">
			<div class="content">
					<div class="login_panel">
							<h3>Existing Customers</h3>
							<p>Sign in with the form below.</p>
							<form action="" method="post">
									<input type="text" name="email" placeholder="Email">
									<input type="password" name="password" placeholder="Password">
									<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
									<div class="buttons">
                                        <div><button class="grey" name="login">Sign In</button></div>
                                    </div> <br>
							</form>
<?php
	if (isset($customerLogin)) {  //show Message
		echo $customerLogin;
	}
?>
<!-- __________________________ X ____________________________________	-->
            </div>
        </div>


<!-- ------------------- 1st For Registration -------------------- -->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
			$customerReg = $customer->customerRegistration($_POST); //Method-1st (watch class-Customer.php, method-1)
		}
?>
        <div class="register_account">
            <h3>Register New Account</h3>
<?php
	if (isset($customerReg)) {  //show Message
		echo $customerReg;
	}
?>
<!-- __________________________ X ____________________________________-->
            <form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Name">
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="City">
                                </div>

                                <div>
                                    <input type="text" name="zipcode" placeholder="Zip-Code">
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Email">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Address">
                                </div>
                                <div>
                                    <input type="text" name="country" placeholder="Country">
                                </div>
                                <!-- <div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
				 </div>		         -->

                                <div>
                                    <input type="text" name="phone" placeholder="Phone">
                                </div>

                                <div>
                                    <input type="password" name="password" placeholder="Password">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search">
                    <div><button class="grey" name="register">Create Account</button></div>
                </div>
                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>

<?php include 'inc/footer.php' ?> 