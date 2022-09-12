<html lang="en">

<head>
    <title>JobSociety</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.ico">
</head>

<body>
    <?php
    include("db.php");
    session_start();
    if (isset($_POST['submit'])) {
        $u_email = $_REQUEST['u_email'];
        $u_pass = $_REQUEST['u_pass'];

        //$dec_pass = md5($u_pass);

        $sql = "SELECT * FROM register WHERE u_email='$u_email' && u_password='$u_pass'";

        $res = mysqli_query($con, $sql);

        $total = mysqli_num_rows($res);
        if ($total == 1) {
            $row = $res->fetch_assoc();
            $_SESSION['username'] = $row['u_username'];
            $_SESSION['email'] = $row['u_email'];
            header('location:CPISM.php');
        } else if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Please Enter Valid Email","warning");';
            echo '}, 500);</script>';
        } else if ($u_email == "" || $u_pass == "") {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Please Fill Complete Form","warning");';
            echo '}, 500);</script>';
        } else {
            $sql2 = "SELECT * FROM admin WHERE email='$u_email' && password='$u_pass'";
            $res2 = mysqli_query($con, $sql2);
            $total2 = mysqli_num_rows($res2);

            if ($total2 == 1) {
                $row2 = $res2->fetch_assoc();
                $_SESSION['uname'] = $row2['name'];
                $_SESSION['adminemail'] = $row2['email'];
                header('location:dashboard.php');
            } else {
                $sql3 = "SELECT * FROM superadmin WHERE email='$u_email' && password='$u_pass'";
                $res3 = mysqli_query($con, $sql3);
                $total3 = mysqli_num_rows($res3);

            if ($total3 == 1) {
                $row3 = $res3->fetch_assoc();
                $_SESSION['supname'] = $row3['name'];
                header('location:SuperAdmin.php');
            } else {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Warning!","Invalid Credentials","warning");';
                echo '}, 500);</script>';
            }
        }
    }
}

    ?>

    <section class="food-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-2">
                    <img id="logoImg" src="assets/images/JSlogo-01.png" alt="Logo">
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="login-wrap p-md-4">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Login Here</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="https://facebook.com/" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-facebook"></span></a>
                                        <a href="https://instagram.com/" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-instagram"></span></a>
                                        <a href="https://twitter.com/" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            
                            <form method="POST" action="" class="signin-form mt-5" autocomplete="off">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Email" name="u_email" id="email">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="u_pass" id="emp_pass">
                                    <i class="fa fa-eye" aria-hidden="true" id="eyeIco" onclick="showPass()"></i>
                                </div>
                                <button type="submit" name="submit" class="btn mt-5">Sign In</button>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-center mt-4">
                                        <a href="forgotpass.php">Forgot Password</a>
                                    </div>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-center">
                                        <a href="index.php">Don't Have An Account? Sign up</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="img" style="background-image: url(assets/images/front5.jpg);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6 text-center">
                    <h6 class="crgt">Copyright &#169; 2021 JobSociety</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

</body>

</html>

<script>
    function showPass() {
        var x = document.getElementById("emp_pass");
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