<!DOCTYPE html>
<html lang="en">

<?php
include("db.php");
error_reporting(0);

// SESSION CHECK
session_start();
if ($_SESSION == true && $SESSION['supname'] != 'superadmin') {
} else {
   header('location:login.php');
}

// ADD USER
if (isset($_POST['submit'])) {
   $u_name = $_REQUEST['name'];
   $u_email = $_REQUEST['email'];
   $radio = $_REQUEST['radio'];
   $u_semester = $_REQUEST['semester'];
   $u_pass = $_REQUEST['pass'];


   if ($radio == "sem") {

      $sql = "SELECT * FROM register where u_email='$u_email'";
      $res = mysqli_query($con, $sql);

      if (mysqli_num_rows($res) > 0) {
         echo '<script type="text/javascript">';
         echo 'setTimeout(function () { swal("Warning!","Email Already Exists","warning");';
         echo '}, 500);</script>';
      } else if ($u_name == "" || $u_email == "" || $u_semester == "" || $u_pass == "") {
         echo '<script type="text/javascript">';
         echo 'setTimeout(function () { swal("Warning!","Please Fill Complete Form","warning");';
         echo '}, 500);</script>';
      } else if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
         echo '<script type="text/javascript">';
         echo 'setTimeout(function () { swal("Warning!","Please Enter Valid Email","warning");';
         echo '}, 500);</script>';
      } else {
         $query = "INSERT into register VALUES (0,'$u_name', '$u_email', '$u_semester', '$u_pass', 555)";
         $result   = mysqli_query($con, $query);
         if ($result) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success!","Successfully Registered","success");';
            echo '}, 500);</script>';
         }
      }
   } else {
      $sql2 = "SELECT * FROM admin where email='$u_email'";
      $res2 = mysqli_query($con, $sql2);

      if (mysqli_num_rows($res2) > 0) {
         echo '<script type="text/javascript">';
         echo 'setTimeout(function () { swal("Warning!","Email Already Exists","warning");';
         echo '}, 500);</script>';
      } else if ($u_name == "" || $u_email == "" || $u_pass == "") {
         echo '<script type="text/javascript">';
         echo 'setTimeout(function () { swal("Warning!","Please Fill Complete Form","warning");';
         echo '}, 500);</script>';
      } else if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
         echo '<script type="text/javascript">';
         echo 'setTimeout(function () { swal("Warning!","Please Enter Valid Email","warning");';
         echo '}, 500);</script>';
      } else {
         $u_name .= "_admin";
         $query2 = "INSERT into admin VALUES ('$u_name', '$u_email', '$u_pass')";
         $result2   = mysqli_query($con, $query2);
         if ($result2) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Success!","Admin Successfully Registered","success");';
            echo '}, 500);</script>';
         }
      }
   }
}

// CHECK NO OF ROWS
$sql_1 = "SELECT * FROM register";
if ($result_1 = mysqli_query($con, $sql_1)) {
   $rowcount_1 = mysqli_num_rows($result_1);
}

$sql_2 = "SELECT * FROM jobs";
if ($result_2 = mysqli_query($con, $sql_2)) {
   $rowcount_2 = mysqli_num_rows($result_2);
}

$sql_3 = "SELECT * FROM apply_jobs";
if ($result_3 = mysqli_query($con, $sql_3)) {
   $rowcount_3 = mysqli_num_rows($result_3);
}

$sql_4 = "SELECT * FROM admin";
if ($result_4 = mysqli_query($con, $sql_4)) {
   $rowcount_4 = mysqli_num_rows($result_4);
}

?>

<head>
   <title>SuperAdmin - JobSociety</title>


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
         <a href="Dashboard.php" class="logo">
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
               <li class="active treeview">
                  <a class="waves-effect waves-dark" href="SuperAdmin.php">
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

               <li class="treeview">
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
                  <h4><i class="icon-speedometer"></i> Dashboard</h4>
               </div>
            </div>

            <div class="row dashboard-header">
            <div class="col-lg-3  col-md-6">
                  <div class="card dashboard-product">
                     <span>Admins</span>
                     <h2 class="dashboard-total-products">
                        <span class="text-primary-color">
                           <?php
                           echo $rowcount_4;
                           ?>

                        </span>
                     </h2>
                     <div class="side-box">
                        <i class="icon-people text-dark"></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3  col-md-6">
                  <div class="card dashboard-product">
                     <span>Users</span>
                     <h2 class="dashboard-total-products">
                        <span class="text-primary-color">
                           <?php
                           echo $rowcount_1;
                           ?>

                        </span>
                     </h2>
                     <div class="side-box">
                        <i class="icon-people text-dark"></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6">
                  <div class="card dashboard-product">
                     <span>Jobs</span>
                     <h2 class="dashboard-total-products"><span class="text-primary-color">
                           <?php
                           echo $rowcount_2;
                           ?>

                        </span>
                     </h2>
                     <div class="side-box">
                        <i class="icon-briefcase text-dark"></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6">
                  <div class="card dashboard-product">
                     <span>Applied Jobs</span>
                     <h2 class="dashboard-total-products"><span class="text-primary-color">
                           <?php
                           echo $rowcount_3;
                           ?>
                        </span>
                     </h2>
                     <div class="side-box">
                        <i class="icon-trophy text-dark"></i>
                     </div>
                  </div>
               </div>
            </div>



            <div class="row">
               <div class="col-lg-4">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">ADD USER / ADMIN</h5>
                     </div>
                     <div class="card-block">
                        <form method="POST">
                           <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" class="form-control">
                           </div>
                           <div class="form-group">
                              <label>Email</label>
                              <input type="text" name="email" class="form-control">
                           </div>
                           <div class="form-group">
                              <label><input type="radio" name="radio" value="sem" id="sem" checked> User</label>

                              <label style="padding: 0 6px;"> / </label>

                              <label><input type="radio" name="radio" value="adm" id="adm"> Admin</label>

                              <select name="semester" class="form-control" id="semester">
                                 <option selected disabled>Choose...</option>
                                 <option value="CPISM">CPISM</option>
                                 <option value="DISM">DISM</option>
                                 <option value="HDSE">HDSE</option>
                                 <option value="ADSE">ADSE</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" name="pass" id="emp_pass">
                              <label><input type="checkbox" onclick="showPass()" style="margin-top: 10px">&nbsp;&nbsp;Show Password</label>
                           </div>
                           <button type="submit" name="submit" value="submit" class="btn btn-primary">ADD</button>
                        </form>




                     </div>
                  </div>
               </div>
               <div class="col-lg-8">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Newly Registered Users</h5>
                     </div>
                     <div class="card-block">
                        <div class="card">
                           <div class="table-responsive">
                              <table class="table m-b-0 photo-table">
                                 <thead>
                                    <tr class="text-uppercase">
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Semester</th>
                                       <th>Password</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $query = "SELECT * FROM register ORDER BY u_id DESC LIMIT 6";
                                    $data = mysqli_query($con, $query);
                                    $total = mysqli_num_rows($data);

                                    if ($total != 0) {

                                       while ($result = mysqli_fetch_assoc($data)) {
                                          echo "
                                          <tr>
                                             <td>" . $result['u_username'] . "</td>
                                             <td>" . $result['u_email'] . "</td>
                                             <td>" . $result['u_semester'] . "</td>
                                             <td>" . mb_strimwidth(md5($result['u_password']), 0, 12, "...") . "</td>
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
      // Stop resubmission form on refresh page
      if (window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href);
      }

      $("#sem").click(function() {
         $("#semester").removeAttr("disabled");

      });

      $("#adm").click(function() {
         $("#semester").attr("disabled", "disabled");

      });
   </script>

</body>

</html>

<script>
   function showPass() {
      var x = document.getElementById("emp_pass");
      if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
   }
</script>