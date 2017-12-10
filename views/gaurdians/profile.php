<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/9/17
 * Time: 1:57 AM
 *
 */


include '../../dao/GuardianDao.php';
include '../../logical/guardian.php';
if(isset($_GET['doc_id'])){
    $grdian=new GuardianDao();
    $res=$grdian->showDoctorProfile($_GET['doc_id']);
    print_table($res);

}
if(isset($_GET['sis_id'])){
    $grdian=new GuardianDao();
    $res=$grdian->showSisterProfile($_GET['sis_id']);
    print_table($res);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="../../css/profile.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="fb-profile">
        <div class="fb-profile-text">
        </div>
    </div>
</div> <!-- /container -->

</body>

</html>