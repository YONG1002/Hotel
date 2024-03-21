<?php
	session_start();
	include("dataconection.php");
	$error="";
	
	if(isset($_GET["loginbtn"]))
	{
		$cust_email=$_GET["email"];
		$cust_password=$_GET["password"];

		$cust_email=mysqli_real_escape_string($connect,$cust_email);
		$cust_password=mysqli_real_escape_string($connect,$cust_password);
		
		$result=mysqli_query($connect,
		"SELECT * FROM user WHERE email='$cust_email' AND password='$cust_password'");

		$count=mysqli_num_rows($result);

		if($count==1)
		{
			$row=mysqli_fetch_assoc($result);
			$_SESSION["id"]=$row["ID"];
			header("location:landing_page.php");
		}
		else
		{
			?>
			<script>
				alert("Wrong Email or Password!");
			</script>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <style>
		body
		{
			font-family: Arial, sans-serif;
			background-image: url('http://localhost/Homestay_Reservation_System/Image/001.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 90vh;
		}

		.container 
		{
			width: 400px;
			margin: 0 auto;
			padding: 20px;
			background-color: #ffffff;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		h2 
		{
			text-align: center;
		}

		label 
		{
			display: block;
			margin-bottom: 10px;
			margin-top: 10px;
		}

		input[type="email"], input[type="password"] 
		{
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		.forgot-password 
		{
			text-align: right;
			margin-bottom: 10px;
		}

		button:hover 
		{
			background-color: #45a049;
		}
		
		.forgot-password 
		{
			text-align: right;
			margin-bottom: 10px;
			margin-top: 10px;
		}
    </style>
  </head>
  
  <body>
	<div class="container">
	<h2>Login</h2>
	<form name="login" method="GET">
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" placeholder="Enter Your Email" required>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" placeholder="Enter Your Password" required>

		<div class="forgot-password">
		<a href="forgetpassword_page.php">Forgot Password ?</a>
		</div>

		<input type="submit" value="Login" name="loginbtn" style="background-color: #FFA500; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px;" />

	</form>
	<a href="home_page.php" style="display: block; text-align: center; margin-top: 10px;">Back to Home Page</a>
	</div>
  </body>
</html>
