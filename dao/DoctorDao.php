<?php

include 'Doctor.php';
class DoctorDao implements Doctor
{
    private function getConntection(){
        return new mysqli('localhost','root','__muhib','daycare');
    }

    public function assignOneSlot($doc_id, $baby_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT * FROM `doctors` WHERE (`slot-1`=$baby_id OR `slot-2`=$baby_id OR `slot-3`=$baby_id) AND doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function slotStatus($doc_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT `slot-1`,`slot-2`,`slot-3` FROM `doctors` WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function updateSlot_1($doc_id, $baby_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-1`=$baby_id WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function updateSlot_2($doc_id, $baby_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-2`=$baby_id WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function updateSlot_3($doc_id, $baby_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-3`=$baby_id WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function slotStatus1($doc_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT baby.baby_id,baby.name,baby.about FROM baby WHERE baby.baby_id=(SELECT doctors.`slot-1` FROM doctors WHERE doctors.doc_id=$doc_id)";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function slotStatus2($doc_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT baby.baby_id,baby.name,baby.about FROM baby WHERE baby.baby_id=(SELECT doctors.`slot-2` FROM doctors WHERE doctors.doc_id=$doc_id)";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function slotStatus3($doc_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT baby.baby_id,baby.name,baby.about FROM baby WHERE baby.baby_id=(SELECT doctors.`slot-3` FROM doctors WHERE doctors.doc_id=$doc_id)";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function getDoctor($user_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT doctors.doc_id,doctors.firstname,doctors.lastname FROM doctors WHERE doctors.user_id=$user_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }

    public function unsetSlot_1($doc_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-1`=-1 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function unsetSlot_2($doc_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-2`=-1 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function unsetSlot_3($doc_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-3`=-1 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function setSlot_1($doc_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-1`=0 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function setSlot_2($doc_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-2`=0 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function setSlot_3($doc_id)
    {
        $db=$this->getConntection();
        $sql = "UPDATE `doctors` SET `slot-3`=0 WHERE doc_id=$doc_id";
        $res=$db->query($sql);
        $db->close();
    }

    public function visitedBabyByDoc($doc_id)
    {
        $db = $this->getConntection();
        $sql = "SELECT DISTINCT  baby.baby_id AS baby_id,baby.name AS name,baby.gender AS gender,baby.age AS age FROM  visited JOIN baby ON visited.baby_id=baby.baby_id WHERE visited.doc_id=$doc_id";
        $res = $db->query($sql);
        $db->close();
        return $res;
    }
    public function saveVisitedBabyDoc($doc_id,$baby_id)
    {
        $db=$this->getConntection();
        $sql="INSERT INTO `visited`(`baby_id`,`doc_id`) VALUES ('".$baby_id."','".$doc_id."')";
        $db->query($sql);
        $db->close();
    }
}