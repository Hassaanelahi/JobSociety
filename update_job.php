<!DOCTYPE html>
<html lang="en">

<?php
include("db.php");
error_reporting(0);

session_start();
if ($_SESSION == true && $_SESSION['end'] == 'admin') {
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



if (isset($_POST['submit'])) {

    $job_title = $_POST['jobtitle'];
    $company_name = $_POST['companyName'];
    $semester = $_POST['semester'];
    $companyemail = $_POST['companyemail'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $salary = $_POST['salary'];
    $shift = $_POST['shift'];
    $location = $_POST['location'];
    $benefits = $_POST['benefits'];
    $requirements = $_POST['requirements'];

    if ($qualification == "") {
        $qualification = "None";
    }
    if ($benefits == "") {
        $benefits = "None";
    }

    if ($job_title == "" || $company_name == "" || $semester == "" || $companyemail == "" || $experience == "" || $salary == "" || $shift == "" || $location == "" || $requirements == "") {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Warning!","Please Fill Complete Form","warning");';
        echo '}, 500);</script>';
    } else {
        $query = "UPDATE jobs SET job_title='$job_title', company_name ='$company_name', semester='$semester', company_email='$companyemail', qualification ='$qualification', experience='$experience', salary ='$salary', shift='$shift', location='$location', benefits='$benefits', requirements ='$requirements' WHERE id='$id'";
        $data = mysqli_query($con, $query);
        if ($data) {

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success!","Job Updated Successfully","success");';
            echo '}, 500);</script>';
            $j_t = "";
            $c_n = "";
            $se = "";
            $ce = "";
            $qa = "";
            $ex = "";
            $sa = "";
            $sh = "";
            $loc = "";
            $be = "";
            $req = "";
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { history.pushState(null, "", "/jobsociety/update_job.php");    ';
            echo '}, 500);</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Job Not Updated","warning");';
            echo '}, 500);</script>';
            $j_t = "";
            $c_n = "";
            $se = "";
            $ce = "";
            $qa = "";
            $ex = "";
            $sa = "";
            $sh = "";
            $loc = "";
            $be = "";
            $req = "";
        }
    }
}

if (isset($_POST['cancel'])) {

    header("location:jobs.php");
}

?>


<head>
    <title>Jobs - JobSociety</title>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">


    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css"> -->
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">

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
            <a href="dashboard.php" class="logo">
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

                        <span><?php echo $_SESSION['start']; ?> <i class=" icofont icofont-simple-down"></i></span>

                        </a>
                        <ul class="dropdown-menu settings-menu">

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

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="dashboard.php">
                            <i class="icon-speedometer"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="users.php">
                            <i class="icon-people"></i><span>ALL USERS</span>
                        </a>
                    </li>
                    <li class="nav-level"></li>

                    <li class="active dtreeview">
                        <a class="waves-effect waves-dark" href="jobs.php">
                            <i class="icon-briefcase"></i><span>JOBS</span>
                        </a>
                    </li>


                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="applied_jobs.php">
                            <i class="icon-trophy"></i><span>APPLIED JOBS</span>
                        </a>
                    </li>

                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <!-- Container-fluid starts -->
            <!-- Main content starts -->
            <div class="container-fluid">
                <div class="row">
                    <div class="main-header">
                        <h4><i class="icon-briefcase text-primary-color"></i> Jobs</h4>
                    </div>
                </div>
                <!-- 4-blocks row start -->
                <div class="row dashboard-header">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">UPDATE JOB</h5>
                            </div>
                            <div class="card-block">
                                <form id="updateform" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Job Title</label>
                                            <input type="text" name="jobtitle" value="<?php echo $j_t; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Company Name</label>
                                            <input type="text" name="companyName" value="<?php echo $c_n; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Semester</label>
                                            <select name="semester" class="form-control">
                                                <option selected disabled>Choose...</option>
                                                <option value="CPISM" <?= $se == 'CPISM' ? ' selected="selected"' : ''; ?>>CPISM</option>
                                                <option value="DISM" <?= $se == 'DISM' ? ' selected="selected"' : ''; ?>>DISM</option>
                                                <option value="HDSE" <?= $se == 'HDSE' ? ' selected="selected"' : ''; ?>>HDSE</option>
                                                <option value="ADSE" <?= $se == 'ADSE' ? ' selected="selected"' : ''; ?>>ADSE</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Company Email</label>
                                            <input type="text" name="companyemail" value="<?php echo $ce; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Qualification (Optional)</label>
                                            <input type="text" name="qualification" value="<?php echo $qa; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Experience</label>
                                            <input type="text" name="experience" value="<?php echo $ex; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Salary</label>
                                            <input type="text" name="salary" value="<?php echo $sa; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Shift</label>
                                            <input type="text" name="shift" value="<?php echo $sh; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Location</label>
                                            <input type="text" name="location" value="<?php echo $loc; ?>" class="form-control">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Benefits (Optional)</label>
                                            <input type="text" name="benefits" value="<?php echo $be; ?>" class="form-control">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Requirements</label>
                                            <textarea name="requirements" class="form-control" style="height: 110px;"><?php echo $req; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit" value="submit" id="update" class="btn btn-primary">UPDATE</button>
                                            <button type="submit" name="cancel" value="submit" class="btn btn-inverse-default waves-effect">CANCEL</button>
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script> -->
    <script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>
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