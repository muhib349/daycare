<?php
include 'dao/DoctorDao.php';

$doctor=new DoctorDao();
$res=$doctor->setSlot_1(1);
if ($res)
    echo 'success';
else
    echo 'failed';
?>