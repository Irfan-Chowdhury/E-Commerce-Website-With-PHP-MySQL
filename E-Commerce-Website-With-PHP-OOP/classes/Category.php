<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
    // include_once '../lib/Database.php';
    // include_once '../helpers/Format.php';
?>

<?php
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db= new Database();
        $this->fm= new Format();
    }    

    // ******************** For catadd.php *************************
    public function catInsert($catName) //--->> Method-1 
    {
        $catName=$this->fm->validation($catName);
        $catName= mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) 
        {
           $msg= "<span class='error'>Category Feild must not be empty </span>";
           return $msg;
        }else {
            $query="INSERT INTO tbl_category(catName) VALUES('$catName')";
            $catInsert=$this->db->insert($query);
            if ($catInsert) {
                $msg= "<span class='success'>Category Inserted succesfully </span>";
                return $msg;
            }else {
                $msg= "<span class='error'>Category Inserted Failed</span>";
                return $msg;
            }
        }
    }

    // ******************** For catlist.php *************************

    public function getAllCat() //--->> Method-2 & also use for 'details.php'
    {
        $query="SELECT *FROM tbl_category ORDER BY catId DESC";
        $result=$this->db->select($query);
        return $result;
    }

    public function delCatById($delid) //--->> Method-5
    {
        $query="DELETE FROM tbl_category WHERE catId='$delid' ";
        $catDelete= $this->db->delete($query);
        if($catDelete){
            echo  "<span class='success'>Category Deleted Successfully..</span>";
        }else {
            echo "<span class='error'>Category Not Deleted..</span>";
        }
    }


    // ******************** For catedit.php *************************

    public function getCatById($catid)  // --->> Method-3 

    {
        $query  = "SELECT *FROM tbl_category WHERE catId='$catid' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function catUpdate($catName,$catid) // --->> Method-4
    {
        $catName=$this->fm->validation($catName);
        $catName= mysqli_real_escape_string($this->db->link, $catName);
        $catid= mysqli_real_escape_string($this->db->link, $catid);

        if (empty($catName)) 
        {
           $msg= "<span class='error'>Category Feild must not be empty </span>";
           return $msg;
        }else {
            $query="UPDATE tbl_category 
                    SET
                    catName='$catName' 
                    WHERE catId='$catid' ";
            $catUpdate=$this->db->update($query);
            if ($catUpdate) {
                $msg= "<span class='success'>Category Updated succesfully </span>";
                return $msg;
            }else {
                $msg= "<span class='error'>Category Updated Failed</span>";
                return $msg;
            }
        }
    }
}

?>