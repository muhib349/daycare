<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/8/17
 * Time: 8:38 PM
 */

include 'Sisters.php';



class SistersDao  implements Sisters
{
    private function getConntection(){
        return new mysqli('localhost','root','__muhib','daycare');
    }
    public function currentAssignedBaby($sis_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT baby.name AS name,baby.gender AS gender,baby.age AS age,baby.about AS about FROM baby WHERE baby.baby_id=(SELECT isBooked FROM sisters WHERE sis_id=$sis_id)";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function vistedBabyBySis($sis_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT baby.name AS name,baby.gender AS gender,baby.age AS age FROM  visited JOIN baby ON visited.baby_id=baby.baby_id WHERE visited.sis_id=$sis_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function saveVisitedBabySis($sis_id,$baby_id)
    {
        $db=$this->getConntection();
        $sql="INSERT INTO `visited`(`baby_id`,`sis_id`) VALUES ('".$baby_id."','".$sis_id."')";
        $db->query($sql);
        $db->close();
    }

    public function isBooked($sis_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT baby.name,baby.about,baby.gender FROM baby WHERE baby.baby_id=(SELECT sisters.isBooked FROM sisters WHERE sisters.sis_id=$sis_id)";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function getSister($user_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT sis_id,`firstname`,`lastname` FROM `sisters` WHERE `user_id`=$user_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
}