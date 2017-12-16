<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/10/17
 * Time: 11:01 AM
 */


class Login
{
    private function getConntection(){
        return new mysqli('localhost','root','__muhib','daycare');
    }

    public function authentication($username,$password){
        $db=$this->getConntection();
        $sql = "SELECT `user_id`,`username`,`usertype` FROM `users` WHERE `username`='$username' AND `password`='$password'";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
}