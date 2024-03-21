<?php
session_start();
include("dataconection.php");
$error = "";

$cust_email = $_SESSION['id'];

if (isset($_GET["submitbtn"])) {

    $PASSWORD = $_GET["password"];
    $CONFIRM_PASSWORD = $_GET["confirm_password"];

    $sql = mysqli_query($connect, "UPDATE user SET PASSWORD = '$PASSWORD' WHERE EMAIL = '$cust_email'");

    session_destroy();
    ?>
    <script>
        alert("Reset Password Successful");
    </script>
    <?php
    header("refresh:0.5; url=login_page.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>

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
            margin: 5px;
        }

        input[type="password"] {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
			
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

        input[type="submit"]:hover {
            background-color: #FF8C00;
        }

        .error-message {
            color: red;
        }
    </style>

    <script>
        function display() {
            var password_check = 0,
                confirm_password_check = 0;
            var password, confirm_password;
            var password_pattern;

            password_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

            password = document.reset.password.value;
            confirm_password = document.reset.confirm_password.value;

            if (!password.match(password_pattern)) {
                document.getElementById("error_password").innerHTML = "<br>Must contain at least 8 or more characters with at least one number, one uppercase letter, one lowercase letter, and one special character!";
                return false;
            } else {
                document.getElementById("error_password").innerHTML = "";
                password_check = 1;
            }

            if (confirm_password != password) {
                document.getElementById("error_confirm_password").innerHTML = "<br>Does not match with the password!";
                return false;
            } else {
                document.getElementById("error_confirm_password").innerHTML = "";
                confirm_password_check = 1;
            }

            if (password_check && confirm_password_check == 1) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Password Reset</h1>
        <form name="reset" method="GET" onsubmit="return display()">
            <label>New Password:</label>
            <input type="password" name="password" required>
            <span id="error_password" class="error-message"></span>

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" required>
            <span id="error_confirm_password" class="error-message"></span>

            <input type="submit" value="Reset Password" name="submitbtn">
        </form>
    </div>
</body>

</html>
