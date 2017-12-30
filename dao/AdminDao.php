<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/23/17
 * Time: 3:16 PM
 */
include 'Admin.php';



class AdminDao implements Admin
{
    private function getConntection(){
        return new mysqli('localhost','root','__muhib','daycare');
    }
    public function saveDoctors($fname, $lname, $email, $about, $address)
    {
        // TODO: Implement saveDoctors() method.
    }

    public function saveSisters($fname, $lname, $email, $about, $address)
    {
        // TODO: Implement saveSisters() method.
    }
    public function getBabyAndGuardian()
    {
        $db=$this->getConntection();
        $sql = "SELECT baby.baby_id,baby.name,guardians.g_id,guardians.firstname,guardians.lastname FROM guardians JOIN baby ON baby.g_id=guardians.g_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function findDoctorByBabyId($baby_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT users.user_id,users.username,doctors.firstname,doctors.lastname,doctors.doc_id,doctors.`slot-1`,doctors.`slot-2`,doctors.`slot-3` 
                    FROM doctors JOIN users ON doctors.user_id=users.user_id WHERE `slot-1`=$baby_id OR `slot-2`=$baby_id OR `slot-3`=$baby_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
    public function findSisterByBabyId($baby_id)
    {
        $db=$this->getConntection();
        $sql = "SELECT users.user_id,sisters.sis_id,sisters.firstname,sisters.lastname,users.username FROM users JOIN sisters ON users.user_id=sisters.user_id JOIN assigned ON sisters.sis_id=assigned.sis_id WHERE assigned.baby_id=$baby_id";
        $res=$db->query($sql);
        $db->close();
        return $res;
    }
}