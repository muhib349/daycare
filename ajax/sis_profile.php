<?php
include '../dao/SistersDao.php';
session_start();
$sister=new SistersDao();
if (isset($_POST['sis'])){
    $data['available']=0;
    $res=$sister->numOfAssignedBaby($_SESSION['sis_id']);
    if ($res->num_rows>0 and $res->num_rows <=3){
        $r=$res->fetch_assoc();
        $data['available']=3-$r['num'];
    }
    else
       $data['available']=3;
    echo json_encode($data);
}
