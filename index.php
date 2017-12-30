
<?php

session_start();
include ("dao/GuardianDao.php");
include "dao/Login.php";
$guardian=new GuardianDao();
$login=new Login();
$message='';
if (isset($_POST['login-form'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $res=$login->authentication($username,$password);

   if ($res->num_rows>0){
        $row=$res->fetch_assoc();
        $type=$row['usertype'];
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$row['username'];
        $_SESSION['user_id']=$row['user_id'];
        if($type=='guardian')
        {
            /*header("Location:views/gaurdians/home.php");*/
            echo '<script type="text/javascript"> window.location = "views/gaurdians/home.php"; </script>';
        }
        else if ($type=='doctor') {
            /*header("Location:views/doctors/home.php");*/
            echo '<script type="text/javascript"> window.location = "views/doctors/home.php"; </script>';
        }
        else if ($type=='sister'){
            /*header("Location:views/sisters/home.php");*/
            echo '<script type="text/javascript"> window.location = "views/sisters/home.php"; </script>';
        }
        else
            /*header("Location:views/admin/home.php");*/
            echo '<script type="text/javascript"> window.location = "views/admin/home.php"; </script>';
    }
    else {
        $message="Invalid username or password";
    }
}

if(isset($_POST['signup'])) {
    $fname=$_POST['first_name'];
    $lname=$_POST['last_name'];
    $uname=$_POST['user_name'];
    $pass=$_POST['user_password'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $contact=$_POST['contact_no'];
    $relation=$_POST['relation'];
    $guardian->save($uname,$pass,'guardian',$contact,$fname,$lname,$email,$address,$relation);
}

if (isset($_GET['logout'])==1)
{
    session_destroy();
}
$res=$guardian->showDoctors();
$res1=$guardian->showSisters();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Day Care</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css">
    <link href="css/nivo-lightbox.css" rel="stylesheet" />
    <link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
    <link href="css/owl.carousel.css" rel="stylesheet" media="screen" />
    <link href="css/owl.theme.css" rel="stylesheet" media="screen" />
    <link href="css/animate.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <link href="http://cdn.phpoll.com/css/animate.css" rel="stylesheet">
    <link href="css/search.css" rel="stylesheet" type="text/css">
    <!-- boxed bg -->
    <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />

    <!-- template skin -->
    <link id="t-colors" href="color/default.css" rel="stylesheet">
    <link rel="icon" href="http://example.com/favicon.png">

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<div id="wrapper">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <!-- search input field -->
        <div id="custom-search-input">
            <div class="input-group col-md-4">
                <input type="text" class=" search-query form-control" name="search" id="search" placeholder="Search doctor or sister" autocomplete="off" />
                <div id="namelist">
                </div>
            </div>
        </div>

        <div class="container navigation">
            <!-- logo code here -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <ul class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#intro">Home</a></li>
                    <li><a href="#service">Service</a></li>
                    <li><a href="#">Doctors</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li><a href="views/gaurdians/reg.html">Sign Up</a></li>
                    <!--login form -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                            <div class="col-lg-12">
                                <div class="text-center"><h3><b>Login</b></h3></div>
                                <form  action="<?php echo $_SERVER['PHP_SELF']?>" method="post" role="form" autocomplete="off">
                                    <?php echo  $message;?>
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

<!-- Section: intro -->
<section id="intro" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                        <h2 class="h-ultra">Day Care</h2>
                    </div>
                    <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
                        <h4 class="h-light">we are promising to give our best to your children</h4>
                    </div>
                    <div class="well well-trans">
                        <div class="wow fadeInRight" data-wow-delay="0.1s">

                            <ul class="lead-list">
                                <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Affordable monthly premium packages</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</span></li>
                                <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Choose your favourite doctor</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</span></li>
                                <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Only use friendly environment</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</span></li>
                            </ul>
                            <p class="text-right wow bounceIn" data-wow-delay="0.4s">
                                <a href="#" class="btn btn-skin btn-lg">Learn more <i class="fa fa-angle-right"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-sm-6">
        <h2 align="center"><span class="label label-primary">Doctors</span></h2>
    </div>
    <div class="col-sm-6">
        <h2 align="center"><span class="label label-primary">Sisters</span></h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 scrollable">
        <?php if($res->num_rows >0) : ?>
            <?php while ($rows=$res->fetch_assoc()): ?>
                <ul class="list-group">
                    <li class="list-group-item"><a href="views/profile.php?doc_id=<?php echo $rows['doc_id'];?>"><?php echo $rows['firstname'].' '.$rows['lastname'];?></a></li>
                </ul>
            <?php endwhile ?>
        <?php endif ?>
    </div>
    <div class="col-sm-6 scrollable">
        <?php if($res1->num_rows >0) : ?>
            <?php while ($rows=$res1->fetch_assoc()): ?>
                <ul class="list-group">
                    <li class="list-group-item"><a href="views/profile.php?sis_id=<?php echo $rows['sis_id']; ?>"><?php echo $rows['firstname'].' '.$rows['lastname'];?></a></li>
                </ul>
            <?php endwhile ?>
        <?php endif ?>
    </div>
</div>

<!-- Section: services -->
<section id="service" class="home-section nopadding paddingtop-60">

    <div class="container">

        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <img src="img/dummy/dayback1.jpg" class="img-responsive" alt="" />
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-stethoscope fa-3x"></span>
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Ensuring Security</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-stethoscope fa-3x"></span>
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Medical checkup</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>

                <div class="wow fadeInRight" data-wow-delay="0.2s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-wheelchair fa-3x"></span>
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Nursing Services</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">

                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-h-square fa-3x"></span>
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Play Ground</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>

                <div class="wow fadeInRight" data-wow-delay="0.2s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-filter fa-3x"></span>
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Curricular Activities</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.3s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-user-md fa-3x"></span>
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Sleep Center</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Section: services -->


<!-- Section: works -->
<section id="facilities" class="home-section paddingbot-60">
    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="section-heading text-center">
                        <h2 class="h-bold">Our facilities</h2>
                        <p>Ea melius ceteros oportere quo, pri habeo viderer facilisi ei</p>
                    </div>
                </div>
                <div class="divider-short"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="wow bounceInUp" data-wow-delay="0.2s">
                    <div id="owl-works" class="owl-carousel">
                        <div class="item"><a href="img/photo/7.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/7@2x.jpg"><img src="img/photo/7.jpg" class="img-responsive" alt="img"></a></div>
                        <div class="item"><a href="img/photo/2.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/2@2x.jpg"><img src="img/photo/2.jpg" class="img-responsive " alt="img"></a></div>
                        <div class="item"><a href="img/photo/3.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/3@2x.jpg"><img src="img/photo/3.JPG" class="img-responsive " alt="img"></a></div>
                        <div class="item"><a href="img/photo/4.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/4@2x.jpg"><img src="img/photo/4.jpg" class="img-responsive " alt="img"></a></div>
                        <div class="item"><a href="img/photo/5.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/5@2x.jpg"><img src="img/photo/5.JPG" class="img-responsive " alt="img"></a></div>
                        <div class="item"><a href="img/photo/6.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/6@2x.jpg"><img src="img/photo/6.jpeg" class="img-responsive " alt="img"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Section: works -->

<footer>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>About Daycare</h5>
                        <p>
                            Lorem ipsum dolor sit amet, ne nam purto nihil impetus, an facilisi accommodare sea
                        </p>
                    </div>
                </div>
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Playground</a></li>
                            <li><a href="#">Medical treatment</a></li>
                            <li><a href="#">Terms & conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Daycare center</h5>
                        <p>
                            Nam leo lorem, tincidunt id risus ut, ornare tincidunt naqunc sit amet.
                        </p>
                        <ul>
                            <li>
                    <span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
								</span> Sunday - Thursday, 8am to 10pm
                            </li>
                            <li>
                    <span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
								</span> +88017xxxxxxxx
                            </li>
                            <li>
                    <span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
								</span> hello@daycare.com
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Our location</h5>
                        <p>xxxxxxxx</p>

                    </div>
                </div>
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Follow us</h5>
                        <ul class="company-social">
                            <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                            <li class="social-dribble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="text-left">
                            <p>&copy;Copyright - Medicio Theme. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>


<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- Core JavaScript Files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/stellar.js"></script>
<script src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/custom.js"></script>
<script src="resources/js/search.js"></script>
</body>

</html>


