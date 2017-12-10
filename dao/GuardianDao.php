<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 11/23/17
 * Time: 11:44 PM

 */
include 'Connection.php';
include 'Guardian.php';

class GuardianDao extends Connection implements Guardian
{
    function save($uname,$pass,$type,$phone,$fname,$lname,$email,$address,$relation){
        $db=$this->get_connection();
        $sql_1="INSERT INTO users(username,password,created,usertype) VALUES ( '".$uname."','".$pass."',NOW(),'".$type."')";
        $db->query($sql_1);
        $user_id=$db->insert_id;
        $code=generateRandomString();
        $sql_2="INSERT INTO guardians(user_id,firstname,lastname,email,address,relation,code)VALUES ('".$user_id."','".$fname."','".$lname."','".$email."','".$address."','".$relation."','".$code."')";
        $db->query($sql_2);
        $sql_3="INSERT INTO phonebook(user_id,phone)VALUES ('".$user_id."','".$phone."')";
        $db->query($sql_3);
        $db->close();

    }

    public function showSisters()
    {
        $db=$this->get_connection();
        $sql = "SELECT `sis_id`,`firstname`,`lastname` FROM `sisters`";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function showDoctors()
    {
        $db=$this->get_connection();
        $sql = "SELECT `doc_id`,`firstname`,`lastname` FROM `doctors`";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function showDoctorProfile($doc_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT `firstname`, `lastname`, `email`, `address`, `about` FROM `doctors` WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function showSisterProfile($sis_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT `firstname`, `lastname`, `email`, `address`, `about` FROM `sisters` WHERE sis_id=$sis_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function update($uid, $uname, $pass, $type, $phone, $fname, $lname, $email, $address, $relation)
    {
        // TODO: Implement update() method.
    }

    public function activateAccount($active_code)
    {
        $db=$this->get_connection();
        $sql = "SELECT * FROM `guardians` WHERE code=$active_code";
        $res=$db->query($sql);
        $db->close();
        if($res->num_rows>0)
            return true;
        return false;
    }
    public function isValid($user_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT isvalid FROM guardians WHERE user_id=$user_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function updateValidity($user_id)
    {
        $db=$this->get_connection();
        $sql = "UPDATE `guardians` SET `isvalid`=1 WHERE user_id=$user_id";
        $db->query($sql);
        $db->close();
    }
    public function getdocReviews($doc_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT `description` FROM `doc_reviews` WHERE `doc_id`=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function getsisReviews($sis_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT `description` FROM `sis_reviews` WHERE `doc_id`=$sis_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function saveDocReview($doc_id,$rating,$comment)
    {
       $db=$this->get_connection();
       $sql="INSERT INTO `doc_reviews`(`doc_id`, `description`, `rating`) VALUES ('".$doc_id."','".$comment."','".$rating."')";
       $db->query($sql);
       $db->close();
    }

    public function saveSisReview($sis_id,$rating,$comment)
    {
        $db=$this->get_connection();
        $sql="INSERT INTO `sis_reviews`(`sis_id`, `description`, `rating`) VALUES ('".$sis_id."','".$comment."','".$rating."')";
        $db->query($sql);
        $db->close();
    }
}