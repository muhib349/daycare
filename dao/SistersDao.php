<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/8/17
 * Time: 8:38 PM
 */

include 'Connection.php';
include 'Sisters.php';



class SistersDao extends Connection implements Sisters
{

    public function currentAssignedBaby($sis_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT baby.name AS name,baby.gender AS gender,baby.age AS age,baby.about AS about FROM baby WHERE baby.baby_id=(SELECT isBooked FROM sisters WHERE sis_id=$sis_id)";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function vistedBabyBySis($sis_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT baby.name AS name,baby.gender AS gender,baby.age AS age FROM  visited JOIN baby ON visited.baby_id=baby.baby_id WHERE visited.sis_id=$sis_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function saveVisitedBabySis($sis_id,$baby_id)
    {
        $db=$this->get_connection();
        $sql="INSERT INTO `visited`(`baby_id`,`sis_id`) VALUES ('".$baby_id."','".$sis_id."')";
        $db->query($sql);
        $db->close();
    }
}