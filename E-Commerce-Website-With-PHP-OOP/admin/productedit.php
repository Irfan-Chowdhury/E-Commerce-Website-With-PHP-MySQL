<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php
//    ---------------- For Get productid from productlist.php  ------------     

    if (!isset($_GET['productid']) || $_GET['productid']==NULL) {
        echo "<script>window.location='productlist.php';</script>";
    }else{
        //$catid=$_GET['catid'];
        $productid= preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['productid']); //you can ignore this line
    }

//    ---------------- 2nd For Submit for Update Product  ------------     
    $product= new Product();

    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) 
    {
        $updatetProduct  = $product->productUpdate($_POST, $_FILES, $productid); //--> watch class/Product, method-4
	}
?>
<!-- _________________________ X _______________________________ -->

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">  
        <!-- ---------------For Show Suuccess Or Error Msg------------------- -->
        <?php
            if (isset($updatetProduct)) 
            {
                echo $updatetProduct;
            }
        ?>

    <!-- --------------- 1st For Get Data ------------------- -->
        <?php
            $getProduct=$product->getProductById($productid); //--- 1st Method
            if ($getProduct) 
            {
                while ($value_pro=$getProduct->fetch_assoc()) 
                {
        ?>
    <!-- ---------------------------------- -->
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value_pro['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                              <option>Select Category</option>
                     <!-- ----------------- For Select Category Option ----------------- -->
                        <?php 
                            $cat=new Category();
                            $getCat=$cat->getAllCat();
                            if ($getCat) 
                            {
                                while ($result =$getCat->fetch_assoc())
                                { 
                            ?>
                                <option <?php 
                                        if ($value_pro['catId']==$result['catId']) { ?>
                                            selected="selected"
                                        <?php } ?>                                    
                                        value="<?php echo $result['catId']; ?>"> <?php echo $result['catName']; ?>
                                </option>       
                        <?php } } ?> 
                    <!-- ___________________ X ______________________ -->    
                        </select>                    
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                    <!-- -------------- For Select Brand Option------------------- -->
                        <?php
                            $brand= new Brand();
                            $getBrand=$brand->getAllBrand();
                            if ($getBrand) 
                            {
                                while ($result=$getBrand->fetch_assoc()) 
                                {
                        ?>
                            <option <?php 
                                        if ($value_pro['brandId']==$result['brandId']) { ?>
                                            selected="selected"
                                    <?php } ?>
                                    value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                        <?php } }?>
                    <!-- _________________________ X _______________________________ -->                        
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                             <?php echo $value_pro['body']; ?>
                        </textarea>
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value_pro['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value_pro['image'];?>" height="80px" width="200px" alt="">
                        <input type="file" name="image">
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                    <!-- ---------------  For Select Option -------------- -->
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php if ($value_pro['type']==0) { ?>
                                <option selected="selected" value="0">Featured</option>
                                <option value="1">General</option>
                            <?php }else { ?>
                                <option selected="selected" value="1">General</option>
                            <?php } ?>
                        </select>
                    <!-- ---------------  X -------------- -->                        
                    </td>
                </tr>        
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } }?>
     <!-- ______________________________ X X X_________________________________ -->            
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>