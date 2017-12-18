<?php

session_start();
include ("../../dao/GuardianDao.php");
$name='';
$assign_baby='admit baby';
$assign_url="baby_reg.php";
$baby='';
$guardian=new GuardianDao();
if (isset($_SESSION['loggedin'])){
    $name=$_SESSION['username'];
    $rw=$guardian->getGuardian($_SESSION['user_id'])->fetch_assoc();
    $_SESSION['g_id']=$rw['g_id'];
    $_SESSION['gfname']=$rw['firstname'];
    $_SESSION['glname']=$rw['lastname'];
}
if (isset($_POST['breg'])){
   $fname=$_POST['first_name'];
   $optradio=$_POST['optradio'];
   $age=$_POST['age'];
   $about=$_POST['about'];
   if ($optradio=='Male'){
       $gender='Male';
   }
   else
       $gender='Female';

   $b_id=$guardian->saveBaby($_SESSION['g_id'],$fname,$gender,$age,$about);
   $_SESSION['baby_id']=$b_id;
   $_SESSION['fname']=$fname;
}
if (isset($_SESSION['baby_id']))
{
    $assign_baby=$_SESSION['fname'];
    $assign_url="#";
}
else
{
    $rs=$guardian->getBaby($_SESSION['g_id']);
    if ($rs->num_rows>0){
        $rw=$rs->fetch_assoc();
        $_SESSION['baby_id']=$rw['baby_id'];
        $_SESSION['fname']=$rw['name'];
        $assign_baby=$_SESSION['fname'];
        $assign_url="#";
    }
}

$res=$guardian->showDoctors();
$res1=$guardian->showSisters();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daycare</title>
    <?php include '../../template/css-library.php';?>
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
                    <li class="active"><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
                    <li><a href="#service">Service</a></li>
                    <li><a href="#">Doctors</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $name;?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href=<?php echo $assign_url;?>><?php echo $assign_baby;?></a></li>
                            <li><a href="#">Profile</a></li>
                            <li><a href="../../index.php?logout=1">Logout</a></li>
                        </ul>
                    </li>
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
                        <h4 class="h-light">Caring For Your Children As If They Were Our Own</h4>
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
                    <li class="list-group-item"><a href="profile.php?doc_id=<?php echo $rows['doc_id'];?>"><?php echo $rows['firstname'].' '.$rows['lastname'];?></a></li>
                </ul>
            <?php endwhile ?>
        <?php endif ?>
    </div>
    <div class="col-sm-6 scrollable">
        <?php if($res1->num_rows >0) : ?>
            <?php while ($rows=$res1->fetch_assoc()): ?>
                <ul class="list-group">
                    <li class="list-group-item"><a href="profile.php?sis_id=<?php echo $rows['sis_id']; ?>"><?php echo $rows['firstname'].' '.$rows['lastname'];?></a></li>
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
                    <img src="../../img/dummy/dayback1.jpg" class="img-responsive" alt="" />
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
<footer>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>About Day Care</h5>
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
                            <li><a href="#">Laboratory</a></li>
                            <li><a href="#">Medical treatment</a></li>
                            <li><a href="#">Terms & conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Medicio center</h5>
                        <p>
                            Nam leo lorem, tincidunt id risus ut, ornare tincidunt naqunc sit amet.
                        </p>
                        <ul>
                            <li>
                    <span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
								</span> Monday - Saturday, 8am to 10pm
                            </li>
                            <li>
                    <span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
								</span> +62 0888 904 711
                            </li>
                            <li>
                    <span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
								</span> hello@medicio.com
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Our location</h5>
                        <p>The Suithouse V303, Kuningan City, Jakarta Indonesia 12940</p>

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
                            <p>&copy;Copyright - Daycare. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>




<?php include '../../template/js-library.php';?>
</body>
</html>
