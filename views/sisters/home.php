<?php
session_start();
include "../../dao/SistersDao.php";
$sister=new SistersDao();
$i=0;
$j=0;
if (isset($_SESSION['loggedin'])){
    $name=$_SESSION['username'];
    $tbl1=$sister->getSister($_SESSION['user_id']);
    if ($tbl1->num_rows>0){
        $row1=$tbl1->fetch_assoc();
        $_SESSION['sis_id']=$row1['sis_id'];
        $_SESSION['fname']=$row1['firstname'];
        $_SESSION['lname']=$row1['lastname'];
        $tbl2=$sister->vistedBabyBySis($_SESSION['sis_id']);
        $tbl3=$sister->currentAssignedBaby($_SESSION['sis_id']);
    }
}
else
    header("Location:../../index.php");

?>

<html>
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
        <div class="col-sm-4">
            <h2><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></h2>

            <?php if($tbl2->num_rows >0) : ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row2=$tbl2->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo ++$j ?></td>
                            <td><a href="#"><?php echo $row2['name'];?></a></td>
                        </tr>
                    <?php endwhile ?>
                    </tbody>
                </table>
            <? else: ?>
                <h6>you haven't visited any baby yet.</h6>
            <?php endif ?>
        </div>
        <div class="col-sm-8">
            <h1><span class="label label-info">Currently Assign Baby:</span></h1>
            <?php if ($tbl3->num_rows>0): ?>
               <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row3=$tbl3->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $row3['name'];?></td>
                            <td><?php echo $row3['gender'];?></td>
                            <td><?php echo $row3['age'];?></td>
                            <td><span class="label label-info"><a href="#">view</a></span></td>
                        </tr>
                    <?php endwhile ?>
                    </tbody>
                </table>
                <?else:?>
                <h5>Your current baby list is empty</h5>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include '../../template/js-library.php';?>
</body>
</html>
