<!DOCTYPE html>
<html lang="en">

<?php
include("db.php");
error_reporting(0);

session_start();
if ($_SESSION == true && $SESSION['supname'] != 'superadmin') {
} else {
    header('location:login.php');
}


if (isset($_POST['submit'])) {
    $job_title = mysqli_real_escape_string($con, $_REQUEST['jobtitle']);
    $company_name = mysqli_real_escape_string($con, $_REQUEST['companyName']);
    $semester = mysqli_real_escape_string($con, $_REQUEST['semester']);
    $companyemail = mysqli_real_escape_string($con, $_REQUEST['companyemail']);
    $qualification = mysqli_real_escape_string($con, $_REQUEST['qualification']);
    $experience = mysqli_real_escape_string($con, $_REQUEST['experience']);
    $salary = mysqli_real_escape_string($con, $_REQUEST['salary']);
    $shift = mysqli_real_escape_string($con, $_REQUEST['shift']);
    $location = mysqli_real_escape_string($con, $_REQUEST['location']);
    $benefits = mysqli_real_escape_string($con, $_REQUEST['benefits']);
    $requirements = mysqli_real_escape_string($con, $_REQUEST['requirements']);



    if ($qualification == "") {
        $qualification = "None";
    }
    if ($benefits == "") {
        $benefits = "None";
    }

    if ($job_title == "" || $company_name == "" || $semester == "" || $companyemail == "" ||  $experience == "" || $salary == "" || $shift == "" || $location == "" || $requirements == "") {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Warning!","Please Fill Complete Form","warning");';
        echo '}, 500);</script>';
    } else {
        $query1 = "INSERT into jobs VALUES (0,'$job_title', '$company_name', '$semester', '$companyemail' , '$qualification','$experience', '$salary', '$shift', '$location', '$benefits', '$requirements' )";
        $result   = mysqli_query($con, $query1);
        if ($result) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success!","Job Add Successfully","success");';
            echo '}, 500);</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Job Not Add","warning");';
            echo '}, 500);</script>';
        }
    }
}


if (isset($_POST['Delete'])) {

    $d_id = $_REQUEST['Delete'];

    $query3 = "DELETE FROM jobs WHERE id='$d_id'";
    $data = mysqli_query($con, $query3);
    if ($data) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Success!","Job Successfully Deleted","success");';
        echo '}, 500);</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Warning!","Job Not Deleted","warning");';
        echo '}, 500);</script>';
    }
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

                            <span>Super Admin <i class=" icofont icofont-simple-down"></i></span>

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
                        <a class="waves-effect waves-dark" href="Super Admin.php">
                            <i class="icon-speedometer"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="admins.php">
                            <i class="icon-people"></i><span>ALL ADMINS</span>
                        </a>
                    </li>
                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="allusers.php">
                            <i class="icon-people"></i><span>ALL USERS</span>
                        </a>
                    </li>
                    <li class="nav-level"></li>

                    <li class="active dtreeview">
                        <a class="waves-effect waves-dark" href="alljobs.php">
                            <i class="icon-briefcase"></i><span>JOBS</span>
                        </a>
                    </li>


                    <li class="nav-level"></li>

                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="allapplied_jobs.php">
                            <i class="icon-trophy"></i><span>APPLIED JOBS</span>
                        </a>
                    </li>

                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="main-header">
                        <h4><i class="icon-briefcase"></i> Jobs</h4>
                    </div>
                </div>

                <div class="row dashboard-header">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">ADD NEW JOB</h5>
                            </div>
                            <div class="card-block">
                                <form method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Job Title</label>
                                            <input type="text" name="jobtitle" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Company Name</label>
                                            <input type="text" name="companyName" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Semester</label>
                                            <select name="semester" class="form-control">
                                                <option selected disabled>Choose...</option>
                                                <option value="CPISM">CPISM</option>
                                                <option value="DISM">DISM</option>
                                                <option value="HDSE">HDSE</option>
                                                <option value="ADSE">ADSE</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Company Email</label>
                                            <input type="text" name="companyemail" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Qualification (Optional)</label>
                                            <input type="text" name="qualification" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Experience</label>
                                            <input type="text" name="experience" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Salary</label>
                                            <input type="text" name="salary" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Shift</label>
                                            <input type="text" name="shift" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Location</label>
                                            <input type="text" name="location" class="form-control">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Benefits (Optional)</label>
                                            <input type="text" name="benefits" class="form-control">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Requirements</label>
                                            <textarea name="requirements" class="form-control" style="height: 110px;"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit" value="submit" class="btn btn-primary">ADD</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-header-text" style="margin-top: 10px;">ALL JOBS</h5>

                                <div class="filter-box">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for job title.." title="Search a job">
                                    </div>
                                </div>

                            </div>
                            <div class="card-block">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table m-b-0 photo-table" id="myTable" style="width: 200%; max-width: 200%;">
                                            <thead>
                                                <tr class="text-uppercase">
                                                    <th>Job Title</th>
                                                    <th>Company Name</th>
                                                    <th>Semester</th>
                                                    <th>Company Email</th>
                                                    <th>Qualification</th>
                                                    <th>Experience</th>
                                                    <th>Salary</th>
                                                    <th>Shift</th>
                                                    <th>Location</th>
                                                    <th>Benefits </th>
                                                    <th>Requirements</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query2 = "SELECT * FROM jobs ORDER BY id DESC";
                                                $data = mysqli_query($con, $query2);
                                                $total = mysqli_num_rows($data);

                                                if ($total != 0) {

                                                    while ($result = mysqli_fetch_assoc($data)) {
                                                        echo "
                                                            <tr>
                                                                <td class='jobtitle'>" . $result['job_title'] . "</td>
                                                                <td>" . $result['company_name'] . "</td>
                                                                <td>" . $result['semester'] . "</td>
                                                                <td>" . $result['company_email'] . "</td>
                                                                <td>" . $result['qualification'] . "</td>
                                                                <td>" . $result['experience'] . "</td>
                                                                <td>" . $result['salary'] . "</td>
                                                                <td>" . $result['shift'] . "</td>
                                                                <td>" . mb_strimwidth(" $result[location]", 0, 20, "...") . "</td>
                                                                <td>" . $result['benefits'] . "</td>
                                                                <td>" . mb_strimwidth(" $result[requirements] ", 0, 50, "...") . "</td>
                                                                <td> 
                                                                <a class='edit_user' href='allupdate_job.php?id=$result[id]&j_t=" . urlencode($result['job_title']) . "&c_n=" . urlencode($result['company_name']) . "&se=" . urlencode($result['semester']) . "&ce=" . urlencode($result['company_email']) . "&
                                                                qa=" . urlencode($result['qualification']) . "&ex=" . urlencode($result['experience']) . "&sa=" . urlencode($result['salary']) . "&sh=" . urlencode($result['shift']) . "&loc=" . urlencode($result['location']) . "&
                                                                be=" . urlencode($result['benefits']) . "&req=" . urlencode($result['requirements']) . "'>Update</a>
                                                                </td>
                                                                <td> 
                                                                    <form method='POST'>
                                                                        <button type='submit' name='Delete' value='" . $result['id'] . "' class='edit_user'>Delete</button>
                                                                    </form>
                                                                </td>
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

        // job search
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            tbody = document.getElementById("notfound");

            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();

            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];

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