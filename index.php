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
    if (isset($_POST['u_name']) && isset($_POST['u_pass'])) {
        $u_name = $_REQUEST['u_name'];
        $u_email = $_REQUEST['u_email'];
        $u_semester = $_REQUEST['u_semester'];
        $u_pass = $_REQUEST['u_pass'];


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
            // $dec_pass = md5($u_pass);
            $query = "INSERT into register VALUES (0,'$u_name', '$u_email', '$u_semester', '$u_pass', 555)";
            $result   = mysqli_query($con, $query);
            if ($result) {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Success!","Successfully Registered","success");';
                echo '}, 500);</script>';
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
                        <div class="img" style="background-image: url(assets/images/front4.jpg);">
                        </div>
                        <div class="login-wrap p-md-4">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Register Yourself</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="https://facebook.com/" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-facebook"></span></a>
                                        <a href="https://instagram.com/" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-instagram"></span></a>
                                        <a href="https://twitter.com/" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form method="POST" action="" class="signin-form mt-3" autocomplete="off">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="u_name" id="name" placeholder="Username">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Email" name="u_email" id="email">
                                </div>
                                <div class="form-group mb-3">
                                    <select name="u_semester" id="select" class="form-control">
                                        <option selected style="color: grey;" value="null">Semester</option>
                                        <option value="CPISM">CPISM</option>
                                        <option value="DISM">DISM</option>
                                        <option value="HDSE">HDSE</option>
                                        <option value="ADSE">ADSE</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="u_pass" id="emp_pass">
                                    <i class="fa fa-eye" aria-hidden="true" id="eyeIco" onclick="showPass()"></i>
                                </div>
                                <button type="submit" class="btn mt-5">Register</button>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-center mt-3">
                                        <a href="login.php">Already Have An Account? Sign In</a>
                                    </div>
                                </div>
                            </form>
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
    <script src="assets/js/validate.js"></script>

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

    $(document).ready(function() {
   $('#select').css('color','rgb(204 199 199)');
   $('#select').change(function() {
      var current = $('#select').val();
      if (current != 'null') {
          $('#select').css('color','black');
      } else {
          $('#select').css('color','rgb(204 199 199)');
      }
   }); 
});
</script>