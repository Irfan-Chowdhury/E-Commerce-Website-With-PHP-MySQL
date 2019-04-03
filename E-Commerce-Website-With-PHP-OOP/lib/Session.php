<?php
/**
*Session Class
**/
class Session
{
    
    public static function init(){
        session_start();
        // if (version_compare(phpversion(), '5.4.0', '<')) {
        //         if (session_id() == '') {
        //             session_start();
        //         }
        //     } else {
        //         if (session_status() == PHP_SESSION_NONE) {
        //             session_start();
        //         }
        //     }
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
        } else {
        return false;
        }
    }

    public static function checkSession(){
        self::init();
        if (self::get("adminlogin")== false) {  //for Adminlogin.php 38 line
        self::destroy();
        header("Location:login.php");
        }
    }

    public static function checkLogin(){
        self::init();
        if (self::get("adminlogin")== true) { //for Adminlogin.php 38 line
        header("Location:dashbord.php");
        }
    }

    public static function destroy(){
        session_destroy();
        header("Location:login.php");
        }

}

?>