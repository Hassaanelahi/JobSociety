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

    <link rel="stylesheet" href="assets/css/forgotstyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.ico">
</head>

<body>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "vendor/autoload.php";

    include("db.php");

    if (isset($_POST['submitotp'])) {

        $u_email = $_POST['u_email'];

        $sql = "SELECT * FROM register where u_email='$u_email'";

        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'jobsociety2021@gmail.com';
            $mail->Password = 'Job@2021society';
            $mail->Port = 587;

            //email settings
            $mail->isHTML(true);
            $mail->From = "jobsociety2021@gmail.com";
            $mail->FromName = "Job Society";
            $mail->addAddress($u_email);
            $mail->Subject = "OTP Verification";
            $otp = mt_rand(100000, 999999);
            $mail->Body = "<center><span style='font-size: 22px'>Job Society Portal OTP Verification Code Is : </span><br><b style='font-size: 24px'>" . $otp . "</b></center>";
            $mail->AltBody = $otp;

            try {
                $mail->send();
                $query = "UPDATE register SET otp_code='$otp' WHERE u_email='$u_email'";
                $result   = mysqli_query($con, $query);
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Success!","OTP Successfully Sent","success");';
                echo '}, 500);</script>';
            } catch (Exception $e) {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Warning!","OTP Not Sent","warning");';
                echo '}, 500);</script>';
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Email Not Yet Registered","warning");';
            echo '}, 500);</script>';
        }
    }

    if (isset($_POST['verifyotp'])) {

        $u_otp = $_POST['u_otp'];

        $sql = "SELECT u_email, u_password FROM register where otp_code='$u_otp'";

        $res = mysqli_query($con, $sql);

        $total = mysqli_num_rows($res);
        if ($total == 1) {
            $row = $res->fetch_assoc();
            $u_email = $row['u_email'];
            $u_pass = $row['u_password'];

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'jobsociety2021@gmail.com';
            $mail->Password = 'Job@2021society';
            $mail->Port = 587;

            //email settings
            $mail->isHTML(true);
            $mail->From = "jobsociety2021@gmail.com";
            $mail->FromName = "Job Society";
            $mail->addAddress($u_email);
            $mail->Subject = "Job Society Password";
            $mail->Body = "<center><span style='font-size: 22px'>Your Job Society Portal Password Is : </span><br><b style='font-size: 24px'>" . $u_pass . "</b></center>";
            $mail->AltBody = $u_pass;

            try {
                $mail->send();
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Success!","Password Successfully Sent","success");';
                echo '}, 500);</script>';
            } catch (Exception $e) {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Warning!","Password Not Sent","warning");';
                echo '}, 500);</script>';
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Warning!","Invalid OTP","warning");';
            echo '}, 500);</script>';
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
                                    <h3 class="mb-4">Reset Password</h3>
                                </div>
                            </div>
                            <form method="POST" action="" class="signin-form mt-4" autocomplete="off">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Email" name="u_email" id="email">
                                </div>
                                <button type="submit" name="submitotp" class="btn mt-2">Send OTP</button>
                                <div class="form-group mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="OTP" name="u_otp" id="emp_otp">
                                </div>
                                <button type="submit" name="verifyotp" class="btn mt-2">Verify OTP</button>
                                <div class="form-group d-md-flex mt-5">
                                    <div class="w-50 text-center">
                                        <a href="login.php">Back To Login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-12 text-center">
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
        var x = document.getElementById("u_pass");
        var y = document.getElementById("eyeIco");
        if (x.type === "password") {
            x.type = "text";
            y.className = "fa fa-eye-slash"
        } else {
            x.type = "password";
            y.className = "fa fa-eye"
        }
    }

    function showPas() {
        var x = document.getElementById("u_cpass");
        var y = document.getElementById("eyeIcoo");
        if (x.type === "password") {
            x.type = "text";
            y.className = "fa fa-eye-slash"
        } else {
            x.type = "password";
            y.className = "fa fa-eye"
        }
    }
</script>