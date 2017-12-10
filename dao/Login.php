<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/10/17
 * Time: 11:01 AM
 */

include "Connection.php";
class Login
{
    public function authentication($username,$password){
        $conn=new Connection();
        $db=$conn->get_connection();
        $sql = "SELECT `usertype` FROM `users` WHERE `username`='$username' AND `password`='$password'";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
}