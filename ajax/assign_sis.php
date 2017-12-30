<?php
session_start();
include '../dao/SistersDao.php';

$sister=new SistersDao();

if (isset($_SESSION['baby_id'])){
    if (isset($_POST['updatesis'])){
        $res=$sister->duplicateAssign($_SESSION['baby_id']);
        if ($res->num_rows>0){
            $data['msg']='You have already assigned a sister';
        }
        else{
            $sister->assignBaby($_SESSION['baby_id'],$_SESSION['sis_id']);
            $data['success']=1;
        }
    }
}
else{
    $data['msg']='Admit Your Baby First';
}

echo json_encode($data);