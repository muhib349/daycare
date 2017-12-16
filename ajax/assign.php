<?php
include '../dao/DoctorDao.php';
$doctor=new DoctorDao();
if (isset($_POST['doc_id'])){
    $res=$doctor->assignOneSlot($_POST['doc_id'],$_POST['baby_id']);
    if ($res->num_rows>0){
        echo 'You have already assigned a doctor';
    }
    else if ($_POST['slot_no']==1){
       $res=$doctor->updateSlot_1($_POST['doc_id'],$_POST['baby_id']);
       if ($res)
           echo 1;
       else
           echo 'failed';
    }
    else if ($_POST['slot_no']==2)
    {
        $res=$doctor->updateSlot_2($_POST['doc_id'],$_POST['baby_id']);
        if ($res)
            echo 2;
        else
            echo 'failed';
    }
    else{
        $res=$doctor->updateSlot_3($_POST['doc_id'],$_POST['baby_id']);
        if ($res)
            echo 3;
        else
            echo 'failed';
    }
}
?>