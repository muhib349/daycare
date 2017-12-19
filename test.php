<?php
include 'dao/DoctorDao.php';

$doctor=new DoctorDao();
$res=$doctor->setSlot_3(2);
echo "Gazi Muhib";
