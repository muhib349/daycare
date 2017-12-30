<?php
include '../dao/DoctorDao.php';
include "../dao/SistersDao.php";
session_start();
$doctor=new DoctorDao();
$sister=new SistersDao();
if (isset($_POST['var'])){
    $res=$doctor->slotStatus($_SESSION['doc_id']);
    if ($res->num_rows>0){
        $r1=$res->fetch_assoc();
        $data['slot-1']=$r1['slot-1'];
        $data['slot-2']=$r1['slot-2'];
        $data['slot-3']=$r1['slot-3'];
        echo json_encode($data);
    }
}