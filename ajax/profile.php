<?php
include '../dao/DoctorDao.php';
session_start();
$doctor=new DoctorDao();
if (isset($_POST['var'])){
    $res=$doctor->slotStatus($_SESSION['doc_id']);
    if ($res->num_rows>0){
        $r1=$res->fetch_assoc();
        $slot_1=$r1['slot-1'];
        $slot_2=$r1['slot-2'];
        $slot_3=$r1['slot-3'];
        echo $slot_1.','.$slot_2.','.$slot_3;
    }
}