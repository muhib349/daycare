<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/15/17
 * Time: 12:39 PM
 */
include '../dao/GuardianDao.php';
include '../logical/guardian.php';
$name='';
if(isset($_GET['doc_id'])){
    $grdian=new GuardianDao();
    $res=$grdian->showDoctorProfile($_GET['doc_id']);
}
if(isset($_GET['sis_id'])){
    $grdian=new GuardianDao();
    $res=$grdian->showSisterProfile($_GET['sis_id']);
}

if ($res->num_rows>0)
    $row=$res->fetch_assoc();
else
{
    header("Location:gaurdians/home.php");
}
echo '</br>';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daycare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="../stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css">
    <link href="../css/nivo-lightbox.css" rel="stylesheet" />
    <link href="../css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
    <link href="../css/animate.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet">
    <link rel="../stylesheet" href="css/index.css">
    <link href="../css/login.css" rel="stylesheet" type="text/css">
    <link href="http://cdn.phpoll.com/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<div id="wrapper">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">

        <div class="container navigation">

            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="../img/logo1/logo.png" alt="" width="200" height="60" />
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <ul class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../index.php">Home</a></li>
                    <li><a href="#service">Service</a></li>
                    <li><a href="#">Doctors</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li><a href="gaurdians/reg.html">Sign Up</a></li>

                    <!--login form -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                            <div class="col-lg-12">
                                <div class="text-center"><h3><b>Login</b></h3></div>
                                <form  action="../index.php" method="post" role="form" autocomplete="off">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" autocomplete="off" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <input type="checkbox" tabindex="3" name="remember" id="remember">
                                                <label for="remember"> Remember Me</label>
                                            </div>
                                            <div class="col-xs-5 pull-right">
                                                <input type="submit" name="login-form" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Login">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="hide" name="token" id="token" value="a465a2791ae0bae853cf4bf485dbe1b6">
                                </form>
                            </div>
                        </ul>
                    </li>
                    <!--ending login form -->
                </ul>
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
                    <h2><?php echo $row['firstname'].' '.$row['lastname']; ?></h2>
                    <h6><span><?php echo $row['about'];?></span></h6>
                </div>
                <hr>
                <ul class="container details">
                    <li><p><span class="glyphicon glyphicon-earphone one" style="width:50px;"></span><?php echo $row['phone'];?></p></li>
                    <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $row['email'];?></p></li>
                    <li><p><span class="glyphicon glyphicon-map-marker one" style="width:50px;"></span><?php echo $row['address'];?></p></li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- Core JavaScript Files -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery.scrollTo.js"></script>
<script src="../js/jquery.appear.js"></script>
<script src="../js/stellar.js"></script>
<script src="../plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/nivo-lightbox.min.js"></script>
<script src="../js/custom.js"></script>

</body>
</html>
