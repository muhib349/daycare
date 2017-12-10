<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/8/17
 * Time: 7:47 PM
 */

include 'dao/Login.php';
include 'logical/guardian.php';


session_start();

if (isset($_POST['login-submit'])){

}

$login=new Login();
$res=$login->authentication('masum_gazi','246');

if (!$res){
    echo 'Invalid';
}
else if ($res->num_rows>0){
    $row=$res->fetch_assoc();
    $type=$row['usertype'];
    echo $type;
    if($type=='guardian'){

    }
}
else {
    echo 'Yeah i got it';
}
