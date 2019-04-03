<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db =new Database();
        $this->fm =new Format();

    }

    // ******************** For details.php *************************

    public function addToCard($quantity, $productid)  //---> Method-1 
    {
        $quantity   =$this->fm->validation($quantity);
        $quantity   = mysqli_real_escape_string($this->db->link, $quantity);
        $productid  = mysqli_real_escape_string($this->db->link, $productid);
        $sId        = session_id();

        $queryProduct = "SELECT *FROM tbl_product WHERE productId ='$productid' ";
        $result= $this->db->select($queryProduct)->fetch_assoc();

        // echo "<pre>";  //-->for check result
        // print_r($result);
        // echo "</pre>";

        $productName = $result['productName'];
        $price       = $result['price'];
        $image       = $result['image'];

        
        $checkQuery = "SELECT * FROM tbl_cart WHERE productId = '$productid' AND sId= '$sId' " ; //Avoid Adding Same Product
        $getProduct = $this->db->select($checkQuery);
        if ($getProduct) 
        {
            $msg = "Product Already Added !";
            return $msg;
        }else 
            {
                $query="INSERT INTO tbl_cart (sId, productId, productName, price,quantity,image) 
                        VALUES('$sId','$productid','$productName','$price','$quantity','$image') ";
                
                $inserted_row=$this->db->insert($query);
                if ($inserted_row) {
                    header("Location:cart.php");
                }else {
                    header("Location:404.php");
                }
            }     
    }

    // ******************** For cart.php/ paymentoffline.php *************************
   
    public function getCardProduct() //---> Method-2
    {
        $sId = session_id();

        $query = "SELECT *FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCardQuantity($cartId, $quantity) //---> Method-3
    {
        $cartId   =$this->fm->validation($cartId);
        $quantity =$this->fm->validation($quantity);

        $cartId   = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $query ="UPDATE tbl_cart
                 SET
                 quantity= '$quantity' 
                 WHERE cartId= '$cartId' ";
        
        $updated_row=$this->db->update($query) ;
        if ($updated_row) 
        {
            // $msg= "<span style='color:green; font-size:18px'>Quantity Updated succesfully </span>";
            // return $msg;
            header("Location:cart.php");
        }
        else 
        {
            $msg= "<span style='color:red; font-size:18px'> Quantity Update Failed</span>";
            return $msg;
        }
    }


    public function delCartById($delid)   //---> Method-4
    {
        $delquery="DELETE FROM tbl_cart WHERE cartId='$delid' ";
        $cartDelete= $this->db->delete($delquery);

        if($cartDelete)
        {
            echo "<script>window.location ='cart.php'; </script> ";
            // $msg = "<span style='color:green; font-size:18px'>Cart Deleted Successfully..</span>";
            // return $msg;
        }
        else 
        {
            $msg = "<span style='color:red; font-size:18px'>Cart Not Deleted ..</span>";
            return $msg;
        }
    }

// ******************** For cart.php *************************

    public function checkCartTable()  //--->Method-5  (No Need thid method from header.php method-5)
    {
        $sId = session_id();

        $query = "SELECT *FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);
        return $result;
    }


    // ******************** For header.php *************************
 
    public function delCustomerCart()  //--->> Method-6
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId='$sId' ";
        $this->db->delete($query);
    }

    // ******************** For paymentoffline.php *************************

    public function orderProduct($customerId)  //--->> Method-7 (Origial 7)
    {
        $sId = session_id();

        $query = "SELECT *FROM tbl_cart WHERE sId = '$sId' ";
        $getProduct = $this->db->select($query);

        if ($getProduct) 
        {
            while ($result = $getProduct->fetch_assoc()) 
            {
                $productId   = $result['productId'];
                $productName = $result['productName'];
                $quantity    = $result['quantity'];
                $price       = $result['price'] * $quantity;
                $image       = $result['image'];

                $query="INSERT INTO tbl_order (customerId, productId, productName, quantity, price, image) 
                        VALUES('$customerId','$productId','$productName','$quantity','$price','$image') ";
                
                //$inserted_row = $this->db->insert($query);        
                 $this->db->insert($query);        
            }
        }
        
    }

// ******************** For success.php *************************

    public function paybleAmount($customerId) //--->> Method-7 (mistake duplicate 7)
    {
        $query = "SELECT price FROM tbl_order WHERE customerId= '$customerId' AND date= now()";
        $result =$this->db->select($query);
        return $result;
    }

// ******************** For orderdetails.php *************************

    public function getOrderProduct($customerId) //--->> Method-8
    {
        $query = "SELECT  *FROM tbl_order WHERE customerId= '$customerId' ORDER BY date DESC";
        $result =$this->db->select($query);
        return $result;
    }

    // ******************** For header.php *************************

    public function checkOrder($customerId)  //--> Method-9
    {
        $query = "SELECT * FROM tbl_order WHERE customerId='$customerId' ";
        $result =$this->db->select($query);
        return $result;
    }

     // ******************** For admin/inbox.php *************************

    public function getAllOrderProduct() //--> Method-10
    {
        $query = "SELECT * FROM tbl_order ORDER BY date DESC";
        $result =$this->db->select($query);
        return $result;
    }

    public function productShifted($customerId,$time,$price)  //--> Method-11
    {
        $customerId =$this->fm->validation($customerId);
        $time       =$this->fm->validation($time);
        $price      =$this->fm->validation($price);

        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $time       = mysqli_real_escape_string($this->db->link, $time);
        $price      = mysqli_real_escape_string($this->db->link, $price);
    
        $query="UPDATE tbl_order 
                SET
                status='1'
                WHERE customerId='$customerId' AND date='$time' AND price='$price' ";
        $updated_row=$this->db->update($query);
        if ($updated_row) 
        {
            $msg= "<span class='success'> Updated succesfully </span>";
            return $msg;
        }
        else 
        {
            $msg= "<span class='error'>Not Updated Failed</span>";
            return $msg;
        } 

    }


    public function deProductShifted($customterId,$time,$price) //--> Method-12
    {
        $customterId = mysqli_real_escape_string($this->db->link, $customterId);
        $time       = mysqli_real_escape_string($this->db->link, $time);
        $price      = mysqli_real_escape_string($this->db->link, $price);

        $query ="DELETE FROM tbl_order WHERE customerId='$customterId' AND date='$time' AND price='$price'";
        $delData=$this->db->delete($query);
        if ($delData) {
            $msg= "<span class='success'>Data Removed succesfully </span>";
            return $msg;
        }else {
            $msg= "<span class='error'>Data Removed Failed</span>";
            return $msg;
        }
    }

 // ******************** For orderdetails.php *************************

    public function productShiftConfirm($customerId,$time,$price) //--> Method-13
    {
        // $customerId =$this->fm->validation($customerId);
        // $time       =$this->fm->validation($time);
        // $price      =$this->fm->validation($price);

        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $time       = mysqli_real_escape_string($this->db->link, $time);
        $price      = mysqli_real_escape_string($this->db->link, $price);
    
        $query="UPDATE tbl_order 
                SET
                status='2'
                WHERE customerId='$customerId' AND date='$time' AND price='$price' ";
        $updated_row=$this->db->update($query);
        if ($updated_row) 
        {
            $msg= "<span class='success'> Updated succesfully </span>";
            return $msg;
        }
        else 
        {
            $msg= "<span class='error'>Not Updated Failed</span>";
            return $msg;
        } 
    }

}
?>