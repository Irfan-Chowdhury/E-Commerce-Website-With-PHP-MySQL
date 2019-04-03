<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db= new Database();
        $this->fm= new Format();
    }

        // ******************** For brandadd.php *************************
    public function brandInsert($brandName) //--->> Method-1 
    {
        $brandName=$this->fm->validation($brandName);
        $brandName= mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) 
        {
            $msg= "<span class='error'>Brand Feild must not be empty </span>";
            return $msg;
        }else {
            $query="INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
            $brandInsert=$this->db->insert($query);
            if ($brandInsert) {
                $msg= "<span class='success'>Brand Inserted succesfully </span>";
                return $msg;
            }else {
                $msg= "<span class='error'>Brand Inserted Failed</span>";
                return $msg;
            }
        }
    }

    // ******************** For brandlist.php *************************

    public function getAllBrand() //--->> Method-2
    {
        $query="SELECT *FROM tbl_brand ORDER BY brandId DESC";
        $result=$this->db->select($query);
        return $result;
    }
    
    // ******************** For brandlist.php *************************
    public function getBrandById($brandid)    //--->> Method-3
    {
        $query  = "SELECT *FROM tbl_brand WHERE brandId='$brandid' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function delBrandById($delid)     //--->> Method-5
    {
        $query="DELETE FROM tbl_brand WHERE brandId='$delid' ";
        $brandDelete= $this->db->delete($query);
        if($brandDelete)
        {
            echo  "<span class='success'>Brand Deleted Successfully..</span>";
        }
        else 
        {
            echo "<span class='error'>Brand Not Deleted..</span>";
        }
    }
    
    // ******************** For brandedit.php *************************

    public function brandUpdate($brandName,$brandid)  //--->> Method-4
    {
        $brandName=$this->fm->validation($brandName);
        $brandName= mysqli_real_escape_string($this->db->link, $brandName);
        $brandid= mysqli_real_escape_string($this->db->link, $brandid);

        if (empty($brandName)) 
        {
           echo "<span class='error'>Brand Feild must not be empty </span>";
        }
        else 
        {
            $query="UPDATE tbl_brand 
                    SET
                    brandName='$brandName' 
                    WHERE brandId='$brandid' ";
            $brandUpdate=$this->db->update($query);
            if ($brandUpdate) 
            {
                echo  "<span class='success'>Brand Updated succesfully </span>";
            }
            else 
            {
                echo "<span class='error'>Brand Updated Failed</span>";
            }
        }
    }
}

?>