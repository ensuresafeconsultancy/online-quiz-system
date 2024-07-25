<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cee_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['exmne_fullname']);
    $course = $conn->real_escape_string($_POST['exmne_course']);
    $gender = $conn->real_escape_string($_POST['exmne_gender']);
    $birthdate = $conn->real_escape_string($_POST['exmne_birthdate']);
    $year_level = $conn->real_escape_string($_POST['exmne_year_level']);
    $email = $conn->real_escape_string($_POST['exmne_email']);
    $password = $conn->real_escape_string($_POST['exmne_password']);
    $status = 'active';

    // Check if email already exists
    $sql_check = "SELECT exmne_id FROM examinee_tbl WHERE exmne_email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
    } else {
        // Insert new record
        $sql_insert = "INSERT INTO examinee_tbl (exmne_fullname, exmne_course, exmne_gender, exmne_birthdate, exmne_year_level, exmne_email, exmne_password, exmne_status)
                       VALUES ('$fullname', '$course', '$gender', '$birthdate', '$year_level', '$email', '$password', '$status')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<center><h3><script>alert('Congrats.. You have successfully registered !!');</script></h3></center>";
            header('location: home.php?q=1');
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="login-ui/image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./login-ui/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/css/util.css">
    <link rel="stylesheet" type="text/css" href="./login-ui/css/main.css">
    <title>Examinee Registration</title>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(./login-ui/images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Registration Form
                    </span>
                </div>
                <form action="register.php" method="post" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">NAME</span>
                        <input class="input100" type="text" name="exmne_fullname" placeholder="Enter Your Name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Course</span>
                        <input class="input100" type="text" name="exmne_course" placeholder="Enter Course">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Gender</span>
                        <select name="exmne_gender" class="input100" style="border: none;">
                        <option value="">Enter Your Gender</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                            <option value="others">others</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Date Of Birth</span>
                        <input class="input100" type="date" name="exmne_birthdate">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Field</span>
                        <input class="input100" type="text" name="exmne_year_level" placeholder="Enter Field">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="exmne_email" placeholder="Enter email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="exmne_password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn" align="right">
                        <button type="submit" class="login100-form-btn">
                            register
                        </button>
                    </div>
                    <div class="wrap-input mt-5">
						<span>Already have an account! </span> <a href="index.php">Login </a> Here..
					</div>
                </form>
            </div>
        </div>
    </div>
    <script src="./login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="./login-ui/vendor/animsition/js/animsition.min.js"></script>
    <script src="./login-ui/vendor/bootstrap/js/popper.js"></script>
    <script src="./login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./login-ui/vendor/select2/select2.min.js"></script>
    <script src="./login-ui/vendor/daterangepicker/moment.min.js"></script>
    <script src="./login-ui/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="./login-ui/vendor/countdowntime/countdowntime.js"></script>
    <script src="./login-ui/js/main.js"></script>
</body>

</html>