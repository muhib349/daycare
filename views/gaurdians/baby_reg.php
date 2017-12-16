<?php
/**
 * Created by PhpStorm.
 * User: muhib
 * Date: 12/16/17
 * Time: 2:43 PM
 */
session_start();
$name=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
    <script src="../../resources/js/reg.js"></script>
    <link rel="stylesheet" href="../../resources/css/reg.css">
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
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="#service">Service</a></li>
                    <li><a href="#">Doctors</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $name;?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li><a href="../../index.php?logout=1">Logout</a></li>
                        </ul>
                    </li>
                </ul>
        </div><!-- /.navbar-collapse -->
    </nav>  <!-- /.container -->
</div>


<div class="container">
    <form class="well form-horizontal" action="home.php" method="post"  id="contact_form">
        <fieldset>
            <!-- Form Name -->
            <legend><center><h2><b>Baby Registration Form</b></h2></center></legend><br>
            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">Full Name</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <input  name="first_name" placeholder="Full Name" class="form-control"  type="text">
                    </div>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Gender</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <div class="radio">
                            <label><input type="radio" name="optradio" value="Male" required>Male</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" value="Female" required>Female</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Age</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <input  name="age" placeholder="age in year" class="form-control"  type="text" required>
                    </div>
                </div>
            </div>
            <!-- Text area-->
            <div class="form-group">
                <label class="col-md-4 control-label">About</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <textarea name="about" placeholder="about your baby" class="form-control"  type="text"></textarea>
                    </div>
                </div>
            </div>

            <!-- Select Basic -->

            <!-- Success message -->
            <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                    <button type="submit" class="btn btn-primary" name="breg" >SUBMIT <span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>

        </fieldset>
    </form>
</div><!-- /.container -->
</body>
</html>