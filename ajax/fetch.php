<?php
session_start();
include '../dao/DoctorDao.php';
$doctor=new DoctorDao();
if (isset($_SESSION['baby_id'])){
    $res=$doctor->assignOneSlot($_SESSION['doc_id'],$_SESSION['baby_id']);
    if ($res->num_rows>0){
        echo 'You have already assigned this doctor';
    }
    else{
        if (isset($_POST['updateDoc1'])){
           $doctor->updateSlot_1($_SESSION['doc_id'],$_SESSION['baby_id']);
           echo 1;
        }
        if (isset($_POST['updateDoc2'])){
            $doctor->updateSlot_2($_SESSION['doc_id'],$_SESSION['baby_id']);
            echo 1;
        }
        if (isset($_POST['updateDoc3'])){
            $doctor->updateSlot_3($_SESSION['doc_id'],$_SESSION['baby_id']);
            echo 1;
        }
    }
}
else{
    echo 'Admit Your Baby First';
}
?>