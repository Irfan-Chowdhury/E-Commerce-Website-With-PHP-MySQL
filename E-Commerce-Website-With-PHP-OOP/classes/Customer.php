<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
    class Customer
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db =new Database();
            $this->fm =new Format();

        }
    // ******************** For login.php *************************

        public function customerRegistration($data) //--->> Method-1
        {
            $name     =$this->fm->validation($data['name']);
            $address  =$this->fm->validation($data['address']);
            $city     =$this->fm->validation($data['city']);
            $country  =$this->fm->validation($data['country']);
            $zipcode  =$this->fm->validation($data['zipcode']);
            $phone    =$this->fm->validation($data['phone']);
            $email    =$this->fm->validation($data['email']);
            $password =$this->fm->validation($data['password']);

            $name     = mysqli_real_escape_string($this->db->link, $data['name']);
            $address  = mysqli_real_escape_string($this->db->link, $data['address']);
            $city     = mysqli_real_escape_string($this->db->link, $data['city']);
            $country  = mysqli_real_escape_string($this->db->link, $data['country']);
            $zipcode  = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email    = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if ($name == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" || $password == "" ) 
            {
                $msg= "<span class='error'> Feild must not be empty !</span>";
                return $msg;
            }
            $mailquery = "SELECT *FROM tbl_customer WHERE email ='$email' LIMIT 1";
            $mailcheck =$this->db->select($mailquery);
            if ($mailcheck != false) 
            {
                $msg= "<span class='error'>Email already exists !</span>";
                return $msg;

            }
            else
            {
                $query="INSERT INTO tbl_customer (name,address,city,country,zipcode,phone,email,password) 
                        VALUES('$name','$address','$city','$country','$zipcode','$phone','$email','$password') ";
                $inserted_row=$this->db->insert($query);
                if ($inserted_row) 
                {
                    $msg= "<span class='success'>Customer Data Inserted succesfully </span>";
                    return $msg;
                }
                else 
                {
                    $msg= "<span class='error'>Customer Data Inserted Failed</span>";
                    return $msg;
                }
            }
        
        }


        public function customerLogin($data)  //--->> Method-2
        {
            $email    =$this->fm->validation($data['email']);
            $password =$this->fm->validation($data['password']);

            $email    = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            
            if (empty($email) || empty($password)) 
            {
                $msg= "<span class='error'> Feild must not be empty !</span>";
                return $msg;
            }

            $query  ="SELECT *FROM tbl_customer WHERE email ='$email' AND password='$password' ";
            $result = $this->db->select($query);
            if ($result != false) 
            {
                $value = $result->fetch_assoc();
                Session::set("customerLogin",true);
                Session::set("customerId",$value['customerId']);
                Session::set("customerName",$value['name']);
                header("Location:orderdetails.php");                
                //header("Location:profile.php");                
            
            }else {
                $msg= "<span class='error'> Email or Password not matched !</span>";
                return $msg;                   
            }
        }

    // ******************** For profile.php/customer.php *************************

        public function getCustomerData($customerId) //--->> Method-3
        {
            $query= "SELECT *FROM tbl_customer WHERE customerId= '$customerId' ";
            $result = $this->db->select($query);
            return $result;
        }


    // ******************** For editprofile.php *************************

        public function customerUpdate($data,$customerId) //--->> Method-4
        {
            $name     =$this->fm->validation($data['name']);
            $address  =$this->fm->validation($data['address']);
            $city     =$this->fm->validation($data['city']);
            $country  =$this->fm->validation($data['country']);
            $zipcode  =$this->fm->validation($data['zipcode']);
            $phone    =$this->fm->validation($data['phone']);
            $email    =$this->fm->validation($data['email']);

            $name     = mysqli_real_escape_string($this->db->link, $data['name']);
            $address  = mysqli_real_escape_string($this->db->link, $data['address']);
            $city     = mysqli_real_escape_string($this->db->link, $data['city']);
            $country  = mysqli_real_escape_string($this->db->link, $data['country']);
            $zipcode  = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email    = mysqli_real_escape_string($this->db->link, $data['email']);

            if ($name == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" ) 
            {
                $msg= "<span class='error'> Feild must not be empty !</span>";
                return $msg;
            }
            else
            {
                $query="UPDATE tbl_customer 
                        SET
                        name     ='$name',
                        address  ='$address',
                        city     ='$city',
                        country  ='$country',
                        zipcode  ='$zipcode',
                        phone    ='$phone',
                        email    = '$email'
                        WHERE customerId='$customerId' "; 
                        
                $updated_row=$this->db->update($query);
                if ($updated_row) 
                {
                    $msg= "<span class='success'>Customer Data Updated succesfully </span>";
                    return $msg;
                }
                else 
                {
                    $msg= "<span class='error'>Customer Data Updated Failed</span>";
                    return $msg;
                }
            }
        }

    }
?>