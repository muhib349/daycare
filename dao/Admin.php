<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 11/28/17
 * Time: 10:29 PM
 */

interface Admin
{
    public function saveDoctors($fname,$lname,$email,$about,$address);
    public function saveSisters($fname,$lname,$email,$about,$address);
    public function getBabyAndGuardian();
    public function findDoctorByBabyId($baby_id);
    public function findSisterByBabyId($baby_id);

}