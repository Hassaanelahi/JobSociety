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


?>

<head>
    <title>Apply History - JobSociety</title>


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
                    <li class="active treeview">
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
                        <h4><i class="icon-hourglass"></i> APPLIED HISTORY</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text" style="margin-top: 10px;">ALL APPLIED JOBS</h5>
                                <div class="filter-box">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for job title.." title="Search apply job">
                                    </div>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table m-b-0 photo-table" id="myTable">
                                            <thead>
                                                <tr class="text-uppercase">
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Job Title</th>
                                                    <th>Company Name</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM apply_jobs WHERE email = '" . $_SESSION['email'] . "' ORDER BY id DESC";
                                                $data = mysqli_query($con, $query);
                                                $total = mysqli_num_rows($data);

                                                if ($total != 0) {
                                                    while ($result = mysqli_fetch_assoc($data)) {
                                                        echo "
                                                            <tr>
                                                                <td>" . $result['name'] . "</td>
                                                                <td>" . $result['email'] . "</td>
                                                                <td>" . $result['job_title'] . "</td>
                                                                <td>" . $result['company_name'] . "</td>
                                                                <td>" . date('d-m-Y', strtotime($result['date']))   . "</td>
                                                            </tr>";
                                                    }
                                                } else {
                                                    $notfound = "No Records Found";
                                                }
                                                ?>

                                            </tbody>

                                        </table>
                                        <p id="notfound"><?php echo $notfound ?></p>
                                    </div>
                                </div>
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
    // job search
    function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            tbody = document.getElementById("notfound");

            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();

            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];

                if (td) {

                    txtValue = td.textContent || td.innerText;

                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        tbody.innerText = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                } else {

                    tbody.innerText = "No Result Found";

                }
            }
        }
</script>

</body>

</html>