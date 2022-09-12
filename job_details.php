<!DOCTYPE html>
<html lang="en">

<?php
include("db.php");
error_reporting(0);

// SESSION CHECK
session_start();
if ($_SESSION == true && $_SESSION['username'] != 'Admin') {
} else {
    header('location:login.php');
}


$id = $_GET['id'];
$j_t = urldecode($_GET['j_t']);
$c_n = urldecode($_GET['c_n']);
$se = urldecode($_GET['se']);
$ce = urldecode($_GET['ce']);
$qa = urldecode($_GET['qa']);
$ex = urldecode($_GET['ex']);
$sa = urldecode($_GET['sa']);
$sh = urldecode($_GET['sh']);
$loc = urldecode($_GET['loc']);
$be = urldecode($_GET['be']);
$req = urldecode($_GET['req']);
$cpismactive = $_GET['cpismactive'];
$dismactive = $_GET['dismactive'];
$hdseactive = $_GET['hdseactive'];
$adseactive = $_GET['adseactive'];

if (isset($_POST['submit'])) {

    $name = $_REQUEST['name'];
    date_default_timezone_set("Asia/karachi");

    $date = date("Y/m/d");
    $time = date("h:i:s");



    if ($name == "") {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Warning!","Please Enter Your Name","warning");';
        echo '}, 500);</script>';
    } else {
        $query = "INSERT into apply_jobs VALUES (0,'$name','$_SESSION[email]','$j_t', '$c_n', '$se','$date', '$time')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success!","Applied Successfully","success");';
            echo '}, 500);</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Not Applied","warning");';
            echo '}, 500);</script>';
        }
    }
}


?>

<head>
    <title>Job Details - JobSociety</title>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">


    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

    <!-- themify -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">

    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">

    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/simple-line-icons/css/simple-line-icons.css">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <!-- Responsive.css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

</head>

<body class="sidebar-mini fixed">
    <div class="loader-bg">
        <div class="loader-bar">
        </div>
    </div>
    <div class="wrapper">
        <!-- Navbar-->
        <header class="main-header-top hidden-print">
            <a href="CPISM.php" class="logo">
                <img class="img-fluid able-logo" src="assets/images/JSlogo-01.jpg" alt="Theme-logo">
            </a>
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>

                <!-- Navbar Right Menu-->


                <ul class="top-nav">

                    <!-- User Menu-->
                    <li class="dropdown">
                        <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">

                        <span><?php echo $_SESSION['username']; ?> <i class=" icofont icofont-simple-down"></i></span>

                        </a>
                        <ul class="dropdown-menu settings-menu">

                            <li><a href="user_profile.php"><i class="icon-user"></i>Profile</a></li>
                            <li>
                                <form method="POST">
                                    <button type="submit" name="logout" value="logout"><i class="icon-logout"></i>Logout</button>
                                    <?php
                                    if (isset($_POST['logout'])) {
                                        session_unset();
                                        header('location:login.php');
                                    }
                                    ?>
                                </form>
                            </li>

                        </ul>
                    </li>
                </ul>


            </nav>
        </header>

        <!-- Side-Nav-->
        <aside class="main-sidebar hidden-print ">
            <section class="sidebar" id="sidebar-scroll">
                <!-- Sidebar Menu-->
                <ul class="sidebar-menu">

                    <li class="nav-level"></li>

                    <li class="<?php echo $cpismactive; ?> treeview">
                        <a class="waves-effect waves-dark" href="CPISM.php">
                            <i class="icon-badge"></i><span>CPISM</span>
                        </a>
                    </li>
                    <li class="nav-level"></li>

                    <li class="<?php echo $dismactive; ?> treeview">
                        <a class="waves-effect waves-dark" href="DISM.php">
                            <i class="icon-book-open"></i><span>DISM</span>
                        </a>
                    </li>


                    <li class="nav-level"></li>

                    <li class="<?php echo $hdseactive; ?> treeview">
                        <a class="waves-effect waves-dark" href="HDSE.php">
                            <i class="icon-book-open"></i><span>HDSE</span>
                        </a>
                    </li>

                    <li class="nav-level"></li>

                    <li class="<?php echo $adseactive; ?> treeview">
                        <a class="waves-effect waves-dark" href="ADSE.php">
                            <i class="icon-graduation"></i><span>ADSE</span>
                        </a>
                    </li>
                    <li class="nav-level"></li>
                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="apply_history.php">
                            <i class="icon-hourglass"></i><span>APPLIED HISTORY</span>
                        </a>
                    </li>


                </ul>
            </section>
        </aside>

        <div class="content-wrapper">



            <div class="container-fluid">
                <div class="row">
                    <div class="main-header">
                        <h4><i class="icon-badge  text-dark"></i> JOB DETAILS</h4>
                    </div>

                </div>

                <div class="row dashboard-header">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="jobdetails-card-header">
                                <h3 class="jobdetails-card-header-text"><?php echo $j_t; ?></h3>
                            </div>
                            <div class="card-block">

                                <div class="col-lg-4 col-md-6">
                                    <p class="sub-title"><b>Company Name: </b><br><?php echo $c_n; ?></p>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <p class="sub-title"><b>Semester: </b><br><?php echo $se; ?></p>
                                </div>
                                <?php
                                if ($qa != "None") {
                                    echo "<div class='col-lg-4 col-md-6'><p class='sub-title'><b>Qualification: </b><br>" . $qa . "</p></div> ";
                                }
                                ?>
                                <div class="col-lg-4 col-md-6">
                                    <p class="sub-title"><b>Experience: </b><br><?php echo $ex; ?></p>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <p class="sub-title"><b>Salary: </b><br><?php echo $sa; ?></p>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <p class="sub-title"><b>Shift: </b><br><?php echo $sh; ?></p>
                                </div>
                                <div class="col-lg-4 col-md-6 ">
                                    <p class="sub-title"><b>Location: </b><br><?php echo $loc; ?></p>
                                </div>
                                <?php
                                if ($be != "None") {
                                    echo "<div class='col-lg-4 col-md-6'><p class='sub-title'><b>Benefits: </b><br>" . $be . "</p></div>";
                                }
                                ?>
                                <div class="col-lg-12 col-md-12">
                                    <p class="sub-title"><b>Requirements: </b><br><?php echo $req; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <div class="row dashboard-header">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">APPLY NOW</h5>
                            </div>

                            <div class="card-block">
                                <form method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Attach CV</label>
                                            <input type="file" id="file" name="file">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit" value="submit" class="btn btn-primary">APPLY</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Required Jqurey -->
    <script src="assets/plugins/Jquery/dist/jquery.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/plugins/tether/dist/js/tether.min.js"></script>

    <!-- Required Fremwork -->
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Scrollbar JS-->
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <!-- custom js -->
    <script type="text/javascript" src="assets/js/main.min.js"></script>
    <script src="assets/js/menu.min.js"></script>


    <script>
        // Stop resubmission form on refresh page
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>