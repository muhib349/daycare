<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/15/17
 * Time: 10:35 AM
 */

session_start();
include '../../dao/GuardianDao.php';
include '../../logical/guardian.php';
include '../../dao/DoctorDao.php';
include '../../dao/SistersDao.php';
$grdian=new GuardianDao();
$doctor=new DoctorDao();
$sis=new SistersDao();
$name='';
$type='';
$rating=0.0;
$li_profile='Admit Baby';
$li_url="baby_reg.php";
if (isset($_SESSION['loggedin']))
    $name=$_SESSION['username'];

if(isset($_GET['doc_id'])){
    $doc_id=$_GET['doc_id'];
    $_SESSION['doc_id']=$doc_id;
    $type='doctor';
    $res=$grdian->showDoctorProfile($doc_id);
    $slot_res=$doctor->slotStatus($doc_id);
    $slot=$slot_res->fetch_assoc();
    $tab_rev=$grdian->getdocReviews($doc_id);
    $rating_tab=$grdian->getRatingDoc($doc_id);
}
if(isset($_GET['sis_id'])){
    $type='sister';
    $sis_id=$_GET['sis_id'];
    $_SESSION['sis_id']=$sis_id;
    $res=$grdian->showSisterProfile($sis_id);
    $booked=$sis ->isBooked($sis_id)->fetch_assoc();
    $tab_rev=$grdian->getsisReviews($sis_id);
    $rating_tab=$grdian->getRatingSis($sis_id);
}
if (isset($_SESSION['baby_id'])){
    $li_profile=$_SESSION['fname'];
    $li_url="#";
}
if ($rating_tab->num_rows >0){
    $rating_row=$rating_tab->fetch_assoc();
    $rating=$rating_row['rating'];
}
if ($res->num_rows>0)
    $row=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daycare</title>
    <?php include '../../template/css-library.php';?>
    <link rel="stylesheet" href="../../css/profile.css">
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">

        <div class="container navigation">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="../../img/logo1/logo.png" alt="" width="200" height="60" />
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <ul class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="#service">Service</a></li>
                    <li><a href="#">Doctors</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $name;?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href=<?php echo $li_url;?>><?php echo $li_profile;?></a></li>
                            <li><a href="#">Profile</a></li>
                            <li><a href="../../index.php?logout=1">Logout</a></li>
                        </ul>
                    </li>
                </ul>
        </div><!-- /.navbar-collapse -->
    </nav>  <!-- /.container -->
</div>
<div class="container">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                <img src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png" alt="stack photo" class="img">
            </div>
            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                <div class="container" style="border-bottom:1px solid black">
                    <h2><?php echo $row['firstname'].' '.$row['lastname']; ?><span class="badge custom-badge red pull-right">Rating:<?php echo $rating; ?></span></h2>
                    <h6><span><?php echo $row['about'];?></span></h6>
                </div>
                <hr>
                <ul class="container details">
                    <li><p><span class="glyphicon glyphicon-earphone one" style="width:50px;"></span><?php echo $row['phone'];?></p></li>
                    <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $row['email'];?></p></li>
                    <li><p><span class="glyphicon glyphicon-map-marker one" style="width:50px;"></span><?php echo $row['address'];?></p></li>
                </ul>

                <?php
                if (isset($_SESSION['baby_id'])){
                    if ($type=='doctor')
                    {

                        echo '<p class="text-info">Assign Your Doctor in a Proper Time.</p>';
                        if(!$slot['slot-1']){
                            echo '<button id="btn1" onclick="updateDoc('.$_SESSION['baby_id'].','.$_SESSION['doc_id'].',1)" type="button" class="btn btn-primary active">slot-1(10am-11am)</button>';
                        }
                        else{

                            echo '<button disabled class="btn btn-primary disabled">Not Available</button>';

                        }
                        if(!$slot['slot-2']){
                            echo '<button id="btn2" onclick="updateDoc('.$_SESSION['baby_id'].','.$_SESSION['doc_id'].',2)" class="btn btn-primary active">slot-2(11am-12pm)</button>';
                        }
                        else{
                            echo '<button disabled class="btn btn-primary disabled">Not Available</button>';
                        }
                        if(!$slot['slot-3']){
                            echo '<button id="btn3" onclick="updateDoc('.$_SESSION['baby_id'].','.$_SESSION['doc_id'].',3)" class="btn btn-primary">slot-3(3pm-4pm)</button>';
                        }
                        else{
                            echo '<button type="button" class="btn btn-primary disabled">Not Available</button>';
                        }
                    }
                    else{
                        if (!$booked['isBooked']){
                            echo '<button onclick="updateSis('.$_SESSION['baby_id'].','.$_SESSION['sis_id'].')" type="button" class="btn btn-primary"><a href="profile.php">Assign</a></button>';
                        }
                        else{
                            echo '<button type="button" class="btn btn-primary disabled">Booked</button>';
                        }
                    }
                }
                else
                    echo '<h4>Admit Your Baby</h4>';
                ?>
                <div>
                    <span id="msg" class="label label-success"></span>
                </div>
            </div>
        </div>
    </div>
    <?php if ($tab_rev->num_rows >0): ?>
        <?php while ($rev=$tab_rev->fetch_assoc()): ?>
            <div id="section1">
                <h4><?php echo $rev['firstname'].' '.$rev['lastname'];?></h4>
                <p><?php echo $rev['descrition'];?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <h3>No Reviews</h3>
    <?php endif; ?>
</div> <!-- /container -->

<?php include '../../template/js-library.php';?>
<script src="../../resources/js/gprofile.js"></script>
</body>
</html>