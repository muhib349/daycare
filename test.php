<?php
include 'dao/DoctorDao.php';
include 'logical/guardian.php';

$doc=new DoctorDao();
/*$doc->setSlot_1(5);
$doc->setSlot_2(5);
$doc->setSlot_3(5);

$doc->setSlot_1(1);
$doc->setSlot_2(1);
$doc->setSlot_3(1);

$doc->setSlot_1(2);
$doc->setSlot_2(2);
$doc->setSlot_3(2);

$doc->setSlot_1(3);
$doc->setSlot_2(3);
$doc->setSlot_3(3);

$doc->setSlot_1(4);
$doc->setSlot_2(4);
$doc->setSlot_3(4);*/

$res=$doc->findDoctor('s');
if ($res->num_rows>0)
    print_table($res);