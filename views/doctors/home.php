<?php
session_start();
include '../../dao/DoctorDao.php';
$doctor=new DoctorDao();
$name='';
$i=0;
if (isset($_SESSION['loggedin']))
{
    $name=$_SESSION['username'];
    $tble1=$doctor->getDoctor($_SESSION['user_id']);
    if ($tble1->num_rows>0){
        $row1=$tble1->fetch_assoc();
        $_SESSION['doc_id']=$row1['doc_id'];
        $_SESSION['fname']=$row1['firstname'];
        $_SESSION['lname']=$row1['lastname'];

    }
}
else
    header('location:../../index.php');

if (isset($_SESSION['doc_id'])){
    $doc_id=$_SESSION['doc_id'];
    $tble2=$doctor->slotStatus1($doc_id);
    $tble3=$doctor->slotStatus2($doc_id);
    $tble4=$doctor->slotStatus3($doc_id);
    $tble5=$doctor->visitedBabyByDoc($_SESSION['doc_id']);
}
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
                    <li><a href="#service">Service</a></li>
                    <li><a href="#facilities">Facilities</a></li>
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
<div class="container">
    <div class="row">
        </br>
        <div class="col-sm-3">
            <h2><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></h2>

            <?php if($tble5->num_rows >0) : ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                    <?php while ($row5=$tble5->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo ++$i;?></td>
                            <td><?php echo $row5['name'];?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
                <? else: ?>
                    <h6>you haven't visited any baby yet.</h6>
                <?php endif ?>
        </div>
        <div class="col-sm-9">
            <div class="row" style="height: 400px">
                <div class="col-sm-3" >
                    <h2><span class="label label-info">Slot-1</span></h2>
                    <?php if ($tble2->num_rows>0):?>
                        <?php $row2=$tble2->fetch_assoc(); ?>
                        <h4><?php echo $row2['name'];?></h4>
                        <a href="#"><input class="btn  btn-primary" type="button" value="details"></a>
                        <? else: ?>
                        <h4>Empty</h4>
                    <?php endif; ?>
                </div>
                <div class="col-sm-3">
                    <h2><span class="label label-info">Slot-2</span></h2>
                    <?php if ($tble3->num_rows>0):?>
                        <?php $row3=$tble3->fetch_assoc(); ?>
                        <h4><?php echo $row3['name'];?></h4>
                        <a href="#"><input class="btn  btn-primary" type="button" value="details"></a>
                    <? else: ?>
                        <h4>Empty</h4>
                    <?php endif; ?>
                </div>
                <div class="col-sm-3">
                    <h2><span class="label label-info">Slot-3</span>
                    <?php if ($tble4->num_rows>0):?>
                        <?php $row4=$tble4->fetch_assoc(); ?>
                        <h4><?php echo $row4['name'];?></h4>
                        <a href="#"><input class="btn  btn-primary" type="button" value="details"></a>
                    <? else: ?>
                        <h4>Empty</h4>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../../template/js-library.php';?>
</body>
</html>



