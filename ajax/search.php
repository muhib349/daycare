<?php
include '../dao/DoctorDao.php';

$doctor=new DoctorDao();
if (isset($_POST['name'])){
    $res=$doctor->findDoctor($_POST['name']);
    $output='<ul class="list-unstyled">';
    if ($res->num_rows>0){
        while($rows=$res->fetch_assoc()){
            if ($rows['usertype']=='doctor')
                $output.='<li>'.'<a href="views/profile.php?doc_id='.$rows['id'].'">'.$rows['name'].'</a>'.'</li>';
            else
                $output.='<li>'.'<a href="views/profile.php?sis_id='.$rows['id'].'">'.$rows['name'].'</a>'.'</li>';
        }
    }
    else{
        $output.='<li>No one can find</li>';
    }
    $output.='</ul>';
    echo $output;
}
