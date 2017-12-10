<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/8/17
 * Time: 7:28 PM
 */
include 'Connection.php';
include 'Doctor.php';
class DoctorDao extends Connection implements Doctor
{

    public function slotStatus($doc_id)
    {
        $db=$this->get_connection();
        $sql = "SELECT `slot-1`, `slot-2`, `slot-3` FROM `doctors` WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function unsetSlot_1($doc_id)
    {
        $db=$this->get_connection();
        $sql = "UPDATE `doctors` SET `slot-1`=-1 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function unsetSlot_2($doc_id)
    {
        $db=$this->get_connection();
        $sql = "UPDATE `doctors` SET `slot-2`=-1 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function unsetSlot_3($doc_id)
    {
        $db=$this->get_connection();
        $sql = "UPDATE `doctors` SET `slot-3`=-1 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function setSlot_1($doc_id)
    {
        $db=$this->get_connection();
        $sql = "UPDATE `doctors` SET `slot-1`=0 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function setSlot_2($doc_id)
    {
        $db=$this->get_connection();
        $sql = "UPDATE `doctors` SET `slot-2`=0 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function setSlot_3($doc_id)
    {
        $db=$this->get_connection();
        $sql = "UPDATE `doctors` SET `slot-3`=0 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function visitedBabyByDoc($doc_id)
    {
        $db = $this->get_connection();
        $sql = "SELECT baby.name AS name,baby.gender AS gender,baby.age AS age FROM  visited JOIN baby ON visited.baby_id=baby.baby_id WHERE visited.doc_id=$doc_id";
        $res = $db->query($sql);
        $db->close();
        return $res;
    }
    public function saveVisitedBabyDoc($doc_id,$baby_id)
    {
        $db=$this->get_connection();
        $sql="INSERT INTO `visited`(`baby_id`,`doc_id`) VALUES ('".$baby_id."','".$doc_id."')";
        $db->query($sql);
        $db->close();
    }
}