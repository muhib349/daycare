<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 11/26/17
 * Time: 11:28 PM
 */

interface Guardian
{
    public function save($uname,$pass,$type,$phone,$fname,$lname,$email,$address,$relation);
    public function update($uid,$uname,$pass,$type,$phone,$fname,$lname,$email,$address,$relation);
    public function showSisters(); //return list of sisters
    public function showDoctors(); //return list of doctors
    public function showDoctorProfile($doc_id);
    public function showSisterProfile($sis_id);
    public function activateAccount($active_code);
    public function isValid($user_id);
    public function updateValidity($user_id);
    public function getdocReviews($doc_id);
    public function getsisReviews($sis_id);
    public function saveDocReview($doc_id,$rating,$comment);
    public function saveSisReview($sis_id,$rating,$comment);
    public function getGuardian($user_id);
    public function getRatingDoc($doc_id);
    public function getRatingSis($sis_id);
    public function saveBaby($g_id,$name,$gender,$age,$about);
    public function getBaby($g_id);
}