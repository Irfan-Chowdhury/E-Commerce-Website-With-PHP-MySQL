<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db= new Database();
        $this->fm= new Format();
    }

    // ******************** For productadd.php *************************

    public function productInsert($data, $file) //--->> Method-1 
    {
        $productName=$this->fm->validation($data['productName']);
        $catId      =$this->fm->validation($data['catId']);
        $brandId    =$this->fm->validation($data['brandId']);
        $body       =$this->fm->validation($data['body']);
        $price      =$this->fm->validation($data['price']);
        $type       =$this->fm->validation($data['type']);

        $productName= mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId      = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId    = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body       = mysqli_real_escape_string($this->db->link, $data['body']);
        $price      = mysqli_real_escape_string($this->db->link, $data['price']);
        $type       = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
        
        if ( $productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $file_name=="" || $type=="" ) 
        {
            $msg= "<span class='error'>Product Feild must not be empty !</span>";
            return $msg;
        }
        elseif ($file_size >1048567) 
        {
            echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } 
        elseif (in_array($file_ext, $permited) === false) 
        {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        }
        else 
        {
            move_uploaded_file($file_temp, $uploaded_image);
            $query="INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) 
            VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type') ";
            $inserted_row=$this->db->insert($query);
            if ($inserted_row) {
                $msg= "<span class='success'>Product Inserted succesfully </span>";
                return $msg;
            }else {
                $msg= "<span class='error'>Product Inserted Failed</span>";
                return $msg;
            }
        }
    }

    // ******************** For productlist.php *************************

    public function getAllProduct() //--->> Method-2 
    {
        //$query="SELECT *FROM tbl_product ORDER BY productId DESC";
        $query="SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
                FROM ((tbl_category 
                INNER JOIN tbl_product ON tbl_category.catId = tbl_product.catId) 
                INNER JOIN tbl_brand ON tbl_brand.brandId = tbl_product.brandId) ORDER BY productId DESC";
        $result=$this->db->select($query);
        return $result;
    }


    public function delProductById($delid) //--->> Method-5
    {   
        $query ="SELECT *FROM tbl_product WHERE productId='$delid' ";
        $getData = $this->db->select($query);
        if ($getData) 
        {
            while($delImg= $getData->fetch_assoc())
            {
                // $delLinnk= $delImg['image'];
                unlink($delImg['image']);
            }
        }

        $delquery="DELETE FROM tbl_product WHERE productId='$delid' ";
        $productDelete= $this->db->delete($delquery);
        if($productDelete){
            echo  "<span class='success'>Product Deleted Successfully..</span>";
        }else {
            echo "<span class='error'>Product Not Deleted..</span>";
        }
    }

    // ******************** For productedit.php *************************

    public function getProductById($productid) //----> Method-3
    {
        $query  = "SELECT *FROM tbl_product WHERE productid='$productid' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file, $productid) //----> Method-4
    {
        $productName=$this->fm->validation($data['productName']);
        $catId      =$this->fm->validation($data['catId']);
        $brandId    =$this->fm->validation($data['brandId']);
        $body       =$this->fm->validation($data['body']);
        $price      =$this->fm->validation($data['price']);
        $type       =$this->fm->validation($data['type']);

        $productName= mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId      = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId    = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body       = mysqli_real_escape_string($this->db->link, $data['body']);
        $price      = mysqli_real_escape_string($this->db->link, $data['price']);
        $type       = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
        
        if ( $productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $type=="" ) 
        {
            $msg= "<span class='error'>Product Feild must not be empty !</span>";
            return $msg;
        } 
        else 
        {
            if (!empty($file_name)) //--->when image file axists
            {            
                if ($file_size >1048567) 
                {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } 
                elseif (in_array($file_ext, $permited) === false) 
                {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                }
                else 
                {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query="UPDATE tbl_product
                            SET
                            productName='$productName', 
                            catId='$catId', 
                            brandId='$brandId', 
                            body='$body', 
                            price='$price', 
                            image='$uploaded_image', 
                            type='$type'
                            WHERE productId='$productid' ";  

                    $updated_row=$this->db->update($query) ;
                    if ($updated_row) 
                    {
                        $msg= "<span class='success'>Product Updated succesfully </span>";
                        return $msg;
                    }
                    else 
                    {
                        $msg= "<span class='error'>Product Updated Failed</span>";
                        return $msg;
                    }
                }
            }
            else  //--->when image file does not axists
            {
                $query="UPDATE tbl_product
                        SET
                        productName='$productName', 
                        catId='$catId', 
                        brandId='$brandId', 
                        body='$body', 
                        price='$price', 
                        type='$type'
                        WHERE productId='$productid' ";  

                $updated_row=$this->db->update($query) ;
                if ($updated_row) 
                {
                    $msg= "<span class='success'>Product Updated succesfully </span>";
                    return $msg;
                }
                else 
                {
                    $msg= "<span class='error'>Product Updated Failed</span>";
                    return $msg;
                }
            }
        }
    }


    // *************************** For index.php ********************************

    public function getFeaturedProduct()  //---> Method-6
    {
        $query="SELECT *FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
        $result=$this->db->select($query);
        return $result;
    }

    public function getNewProduct()  //---> Method-7
    {
        $query="SELECT *FROM tbl_product ORDER BY productId  LIMIT 4";
        $result=$this->db->select($query);
        return $result;
    }

    // *************************** For details.php ********************************

    public function getSingleProduct($productid) //---> Method-8 
    {
        // $query="SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
        //         FROM ((tbl_category 
        //         INNER JOIN tbl_product ON tbl_category.catId = tbl_product.catId) 
        //         INNER JOIN tbl_brand ON tbl_brand.brandId = tbl_product.brandId) ORDER BY productId DESC";
        
        $query="SELECT P.*, C.catName, B.brandName 
                FROM tbl_product as P, tbl_category as C, tbl_brand as B
                WHERE P.catId = C.catId AND P.brandId = B.brandId AND P.productId='$productid' ";
        $result=$this->db->select($query);
        return $result;
    }

    // *************************** For header.php ********************************

    public function latestFromIphone()  //---> Method-9
    {
        $query="SELECT *FROM tbl_product WHERE brandId='3' ORDER BY productId  LIMIT 1";
        $result=$this->db->select($query);
        return $result;
    }

    public function latestFromSamsung()  //---> Method-10 
    {
        $query="SELECT *FROM tbl_product WHERE brandId='4' ORDER BY productId  LIMIT 1";
        $result=$this->db->select($query);
        return $result;
    }

    public function latestFromAcer()  //---> Method-11
    {
        $query="SELECT *FROM tbl_product WHERE brandId='2' ORDER BY productId  LIMIT 1";
        $result=$this->db->select($query);
        return $result;
    }

    public function latestFromCanon()  //---> Method-12
    {
        $query="SELECT *FROM tbl_product WHERE brandId='5' ORDER BY productId  LIMIT 1";
        $result=$this->db->select($query);
        return $result;
    }
    

// *************************** For productbycat.php ********************************

    public function productByCat($catId) //---> Method-13
    {
        $catId= mysqli_real_escape_string($this->db->link, $catId); //for more Security

        $query="SELECT *FROM tbl_product WHERE catId='$catId' ";
        $result=$this->db->select($query);
        return $result;
    }
// *************************** For details.php ********************************

    public function insertCompareData($productId,$customerId) //---> Method-14
    {
        $productId   = mysqli_real_escape_string($this->db->link, $productId);
        $customerId= mysqli_real_escape_string($this->db->link, $customerId);

        $chkquery="SELECT *FROM tbl_compare WHERE customerId='$customerId' AND productId='$productId' ";
        $check=$this->db->select($chkquery);
        if ($check) {
            $msg= "<span class='error'>Already Added </span>";
            return $msg;
        }

        $query="SELECT *FROM tbl_product WHERE productId='$productId' ";
        $result=$this->db->select($query)->fetch_assoc();
        if ($result) 
        {
            $productId = $result['productId'];
            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $query="INSERT INTO tbl_compare (customerId,productId,productName,price,image)
                    VALUES ('$customerId','$productId','$productName','$price','$image')";
            
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) 
            {
                $msg= "<span class='success'>Added ! Check Compare Page</span>";
                return $msg;
            
            }else 
            {
                $msg= "<span class='success'>Not Added ! </span>";
                return $msg;
            }

        }
    }

// *************************** For compare.php ********************************

    public function getCompareData($customerId)  //Method-15
    {
        $query = "SELECT *FROM tbl_compare WHERE customerId='$customerId' ORDER BY compareId DESC ";
        $result= $this->db->select($query);
        return $result;
    }

// *************************** For header.php ********************************

    public function delCompareData($customerId) //Method-16
    {
        $query = "DELETE FROM tbl_compare WHERE customerId='$customerId' ";
        $deldata= $this->db->delete($query);
    }

    // *************************** For details.php ********************************
    
    public function insertWlistData($productId,$customerId) //Method-17
    {
        $chkquery="SELECT *FROM tbl_wlist WHERE customerId='$customerId' AND productId='$productId' ";
        $check=$this->db->select($chkquery);
        if ($check) 
        {
            $msg= "<span class='error'>Already Added </span>";
            return $msg;
        }

        $query = "SELECT * FROM tbl_product WHERE productId= '$productId' ";
        $result= $this->db->select($query)->fetch_assoc();
        if ($result) 
        {
            $productId = $result['productId'];
            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $query="INSERT INTO tbl_wlist (customerId,productId,productName,price,image)
                    VALUES ('$customerId','$productId','$productName','$price','$image')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) 
            {
                $msg= "<span class='success'>Added ! Check Wlist Page</span>";
                return $msg;

            }
            else 
            {
                $msg= "<span class='success'>Not Added ! </span>";
                return $msg;
            }
        }
    }

    // *************************** For header.php ********************************

    public function getWlistData($customerId) //Method-18
    {
        $query = "SELECT *FROM tbl_wlist WHERE customerId='$customerId' ORDER BY wlistId DESC ";
        $result= $this->db->select($query);
        return $result;
    }

    // *************************** For wlist.php ********************************

    public function delWlistData($customerId,$productId) //Method-19
    {
        $query = "DELETE FROM tbl_wlist WHERE customerId='$customerId' AND productId='$productId' ";
        $result= $this->db->delete($query);
        return $result;
    }
}

?>