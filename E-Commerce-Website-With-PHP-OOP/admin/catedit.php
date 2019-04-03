<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid']==NULL) {
		echo "<script>window.location='catlist.php';</script>";
	}else{
        //$catid=$_GET['catid'];
        $catid= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['catid']); //you can ignore this line

    }

    $cat= new Category();
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $catName    = $_POST['catName'];
		$updatetCat  = $cat->catUpdate($catName,$catid);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
         <!-- **************************************   -->
            <?php
                if (isset($updatetCat)) {
                    echo $updatetCat;
                }
            ?>
        <!-- ----------------------------------------- -->
            <?php
                $getCat=$cat->getCatById($catid);
                if ($getCat) {
                    while ($result=$getCat->fetch_assoc()) {
            ?>
        <!-- **************************************   -->
                 <form action="" method="POST"> <!-- there is prob in action method if i use catedit.php-->
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } }  ?>  <!-- -->
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>