<?php
session_start();
include("dataconection.php");
$error = "";

if (isset($_GET["submitbtn"])) {
    $cust_email = $_GET["email"];
    $cust_email = mysqli_real_escape_string($connect, $cust_email);
    $result = mysqli_query($connect, "SELECT * FROM user WHERE email='$cust_email'");
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $link = 'http://localhost/Homestay_Reservation_System/User/resetpassword_page.php';

    if ($count == 1) {
        //To Email
        $_SESSION['id'] = $cust_email;

        $to = $cust_email;
        $subject = 'Reset Your Password';
        $content = 'Hi ' . $row["NAME"] . ', welcome back to our website. Please click the link below to reset your password.';
        $content .= '<br><a href="' . $link . '">Click Here</a>';
        $headers = "From: mmutse2231@gmail.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($to, $subject, $content, $headers)) {
            ?>
            <script>
                alert("Email Sent! Please Check Your Email");
            </script>
            <?php
            header("refresh:0.5; url=login_page.php");
        } else {
            ?>
            <script>
                alert("Failed! Please Try Again.");
            </script>
            <?php
            header("refresh:0.5; url=forgetpassword_page.php");
        }
    } else {
        ?>
        <script>
            alert("Please Enter Registered Email!");
        </script>
        <?php
    }
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Forget Password</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        }

        h1 {
            text-align: center;
            margin: 0 0 20px 0;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="email"] {
            width: 99%;
			height: 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"],
        input[type="button"] {
			margin-top:10px;
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #FFA500;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #FF8C00;
        }

        .back-link {
            text-align: center;
        }
    </style>

    <script>
        function check() {
            var email;
            email = document.login.email.value;
            if (email == "") {
                alert("Please Enter Your Email");
                return false;
            }
        }
    </script>

</head>

<body>
    <div class="container">
        <h1>Forget Password</h1>
        <form name="login" method="GET" onsubmit="return check()">
            <label>Enter Your Email:</label>
            <input type="email" name="email" required>
            <input type="submit" value="Next" name="submitbtn">
        </form>
        <div class="back-link">
            <a href="login_page.php">Back to Login Page</a>
        </div>
    </div>
</body>

</html>
