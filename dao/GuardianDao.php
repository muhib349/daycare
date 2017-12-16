<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 11/23/17
 * Time: 11:44 PM

 */
include 'Guardian.php';

class GuardianDao implements Guardian
{
    private function getConntection(){
        return new mysqli('localhost','root','__muhib','daycare');
    }

    function save($uname,$pass,$type,$phone,$fname,$lname,$email,$address,$relation){
        include 'logical/guardian.php';
        $db=$this->getConntection();
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
        $db=$this->getConntection();
        $sql = "SELECT `sis_id`,`firstname`,`lastname` FROM `sisters`";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function showDoctors()
    {
        $db=$this->getConntection();
        $sql = "SELECT `doc_id`,`firstname`,`lastname` FROM `doctors`";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function showDoctorProfile($doc_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT DISTINCT d.firstname,d.lastname,d.email,d.address,d.about,p.phone FROM doctors AS d JOIN phonebook AS p ON d.user_id=p.user_id WHERE d.doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function showSisterProfile($sis_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT s.firstname,s.lastname,s.email,s.address,s.about,p.phone FROM sisters AS s JOIN phonebook AS p ON s.user_id=p.user_id WHERE s.sis_id=$sis_id";
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
        $db=$this->getConntection();
        $sql = "SELECT * FROM `guardians` WHERE code=$active_code";
        $res=$db->query($sql);
        $db->close();
        if($res->num_rows>0)
            return true;
        return false;
    }
    public function isValid($user_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT isvalid FROM guardians WHERE user_id=$user_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function updateValidity($user_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `guardians` SET `isvalid`=1 WHERE user_id=$user_id";
        $db->query($sql);
        $db->close();
    }
    public function getdocReviews($doc_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT guardians.firstname,guardians.lastname,doc_reviews.descrition FROM guardians JOIN doc_reviews ON guardians.g_id=doc_reviews.g_id WHERE doc_reviews.doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function getsisReviews($sis_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT guardians.firstname,guardians.lastname,sis_reviews.description FROM guardians JOIN sis_reviews ON guardians.g_id=sis_reviews.g_id WHERE sis_reviews.sis_id=$sis_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function saveDocReview($doc_id,$rating,$comment)
    {
       $db=$this->getConntection();
       $sql="INSERT INTO `doc_reviews`(`doc_id`, `description`, `rating`) VALUES ('".$doc_id."','".$comment."','".$rating."')";
       $db->query($sql);
       $db->close();
    }

    public function saveSisReview($sis_id,$rating,$comment)
    {
        $db=$this->getConntection();
        $sql="INSERT INTO `sis_reviews`(`sis_id`, `description`, `rating`) VALUES ('".$sis_id."','".$comment."','".$rating."')";
        $db->query($sql);
        $db->close();
    }

    public function getGuardian($user_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT `g_id`,`firstname`,`lastname` FROM `guardians` WHERE user_id=$user_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function getRatingDoc($doc_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT AVG(rating) AS rating FROM doc_reviews WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function saveBaby($g_id, $name, $gender, $age, $about)
    {
        $db=$this->getConntection();
        $sql="INSERT INTO `baby`(`g_id`, `name`, `gender`, `age`, `about`) VALUES ('".$g_id."','".$name."','".$gender."','".$age."','".$about."')";
        $db->query($sql);
        $b_id=$db->insert_id;
        $db->close();
        return $b_id;
    }

    public function getBaby($g_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT `baby_id`,`name` FROM `baby` WHERE g_id=$g_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function getRatingSis($sis_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT AVG(rating) AS rating FROM sis_reviews WHERE sis_id=$sis_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
}