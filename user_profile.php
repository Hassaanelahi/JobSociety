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







if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $semester = $_POST['semester'];
    $pass = $_POST['pass'];


    if ($name == "" || $semester == "" || $pass == "") {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Warning!","Please Fill Complete Form","warning");';
        echo '}, 500);</script>';
    } else {
        $query2 = "UPDATE register SET u_username='$name', u_semester='$semester', u_password ='$pass' WHERE u_email = '" . $_SESSION['email'] . "'";
        $data = mysqli_query($con, $query2);
        if ($data) {

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success!","Profile Updated Successfully","success");';
            echo '}, 500);</script>';
            $_SESSION['username'] = $name;
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Profile Not Updated","warning");';
            echo '}, 500);</script>';
        }
    }
}



$query = "SELECT * FROM register WHERE u_email = '" . $_SESSION['email'] . "'";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);

if ($total != 0) {

    $result = mysqli_fetch_assoc($data);
} else {
    echo "No Records Found";
}


?>





<head>
    <title>Profile - JobSociety</title>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="CPISM.php">
                            <i class="icon-badge"></i><span>CPISM</span>
                        </a>
                    </li>
                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="DISM.php">
                            <i class="icon-book-open"></i><span>DISM</span>
                        </a>
                    </li>


                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="HDSE.php">
                            <i class="icon-book-open"></i><span>HDSE</span>
                        </a>
                    </li>

                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="ADSE.php">
                            <i class="icon-graduation"></i><span>ADSE</span>
                        </a>
                    </li>

                    <li class="nav-level"></li>
                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="apply_history.php">
                            <i class="icon-hourglass"></i><span>APPLY HISTORY</span>
                        </a>
                    </li>


                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="main-header">
                        <h4><i class="icon-user text-dark-color"></i> PROFILE</h4>
                    </div>
                </div>

                <div class="row dashboard-header">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">EDIT PROFILE</h5>
                            </div>
                            <div class="card-block">
                                <form method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" name="name" value="<?php echo $result['u_username'];  ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Semester</label>
                                            <select name="semester" class="form-control">
                                                <option selected disabled>Choose...</option>
                                                <option value="CPISM" <?= $result['u_semester'] == 'CPISM' ? ' selected="selected"' : ''; ?>>CPISM</option>
                                                <option value="DISM" <?= $result['u_semester'] == 'DISM' ? ' selected="selected"' : ''; ?>>DISM</option>
                                                <option value="HDSE" <?= $result['u_semester'] == 'HDSE' ? ' selected="selected"' : ''; ?>>HDSE</option>
                                                <option value="ADSE" <?= $result['u_semester'] == 'ADSE' ? ' selected="selected"' : ''; ?>>ADSE</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" name="pass" id="pass" value="<?php echo $result['u_password'];  ?>" class="form-control" style="padding-right: 29px;">
                                            <i class="fa fa-eye" aria-hidden="true" id="eyeIco" onclick="showPass()"></i>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit" value="submit" class="btn btn-primary">UPDATE</button>
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
        function showPass() {
            var x = document.getElementById("pass");
            var y = document.getElementById("eyeIco");
            if (x.type === "password") {
                x.type = "text";
                y.className = "fa fa-eye-slash"
            } else {
                x.type = "password";
                y.className = "fa fa-eye"
            }
        }


        // Stop resubmission form on refresh page
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>