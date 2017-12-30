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
        $sql = "SELECT baby.name,baby.baby_id,baby.gender,baby.about,baby.age FROM `assigned` JOIN baby ON baby.baby_id=assigned.baby_id WHERE assigned.sis_id=$sis_id";
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

    public function numOfAssignedBaby($sis_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT COUNT(sis_id) AS num FROM `assigned` GROUP BY sis_id HAVING sis_id=$sis_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function duplicateAssign($b_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT * FROM `assigned` WHERE baby_id=$b_id";
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

    public function assignBaby($b_id, $s_id)
    {
        $db=$this->getConntection();
        $sql = "INSERT INTO `assigned`(`sis_id`, `baby_id`) VALUES ('".$s_id."','".$b_id."')";
        $db->query($sql);
        $db->close();
    }

    public function removeAssignedBaby($baby_id)
    {
        $db=$this->getConntection();
        $sql = "DELETE FROM `assigned` WHERE baby_id=$baby_id";
        $db->query($sql);
        $db->close();
    }

}