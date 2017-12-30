<?php
session_start();
include '../../dao/AdminDao.php';
include '../../dao/DoctorDao.php';
include '../../dao/SistersDao.php';

$name='';
$i=0;
$msg='';
$admin=new AdminDao();
$doctor=new DoctorDao();
$sister=new SistersDao();
if (isset($_SESSION['loggedin'])){
    $name=$_SESSION['username'];
    $res=$admin->getBabyAndGuardian();
}
else{
    header('location:../../index.php');
}
if (isset($_GET['doctor_id'])){
    $doc_id=$_GET['doctor_id'];
    $slot=$_GET['slot'];
    $b_id=$_GET['baby_id'];
    $doctor->saveVisitedBabyDoc($doc_id,$b_id);
    if ($slot==1){
        $doctor->setSlot_1($doc_id);
    }
    else if ($slot==2) {
        $doctor->setSlot_2($doc_id);
    }
    else{
        $doctor->setSlot_3($doc_id);
    }
    $msg='Doctor Seen baby Successfully';
}
if (isset($_GET['sister_id'])){
    $s_id=$_GET['sister_id'];
    $b_id=$_GET['baby_id'];
    $sister->removeAssignedBaby($b_id);
    $sister->saveVisitedBabySis($s_id,$b_id);
    $msg='Sister Seen baby Successfully';
}
unset($_GET['sister_id']);
?>

<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Home</title>
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
                    <li><a href="#service">Admin</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin_reg.php">Doctor/Sister</a></li>
                            <li><a href="#">Admin</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $name;?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li><a href="../../index.php?logout=1">Logout</a></li>
                        </ul>
                    </li>
                </ul>
        </div>
    </nav>
</div>
</br>
<div class="container-fluid">
    <div class="col-sm-5">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Baby</th>
                <th>Guardian</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($res->num_rows >0): ?>
                <?php while($rows=$res->fetch_assoc()): ?>
            <tr>
                <td><?php echo ++$i ?></td>
                <td><a href="#"><?php echo $rows['name']; ?></a></td>
                <td><a href="#"><?php echo $rows['firstname'].' '.$rows['lastname']; ?></a></td>
                <td align="center"><a><input onclick="getStatus('<?php echo $rows['baby_id']; ?>','<?php echo $rows['name']; ?>')" class="btn btn-info" type="button" value="details"></a></td>
            </tr>
                <?php endwhile ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-7">
        <div>
            <h3 id="msg"></h3>
            <h3 id="msg2"><?php echo $msg; ?></h3>
        </div>
        <table class="table table-bordered" id="table">
            <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr id="">
                <td id="username"></td>
                <td id="name"></td>
                <td>Doctor</td>
                <td id=""><a id="link1"><input id="seen1" class="btn btn-info" type="button" value="Approve"></a></td>

            </tr>
            <tr id="">
                <td id="sis_uname"></td>
                <td id="sis_name"></td>
                <td>Sister</td>
                <td id=""><a id="link2"><input id="seen2" class="btn btn-info" type="button" value="Approve"></a></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>

<?php include '../../template/js-library.php';?>
<script src="../../resources/js/admin.js"></script>
</body>
</html>
