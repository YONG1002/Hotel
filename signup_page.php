<?php
	session_start();
	include("dataconection.php");
	$error="";
	
	if(isset($_GET["submitbtn"]))
	{
		$NAME=$_GET["name"];
		$PASSWORD=$_GET["password"];
		$EMAIL=$_GET["email"];
		$CONTACT_NUM=$_GET["contact_num"];
		$GENDER=$_GET["gender"];
		
		$checkeamil="SELECT * from user where EMAIL='$EMAIL'";
		$result=mysqli_query($connect,$checkeamil);
		$used_email=mysqli_num_rows($result);
		
		if($used_email>0)
		{
			?>
			<script>
				alert("Email already uesd, please use another email to register");
			</script>
			<?php
		}
		else
		{
			$query = mysqli_query($connect, "INSERT INTO user (NAME, PASSWORD, EMAIL, PHONE_NUMBER, GENDER) VALUES ('$NAME', '$PASSWORD', '$EMAIL', '$CONTACT_NUM', '$GENDER')");
			?>
			<script>
				alert("User successful added");
			</script>
			<?php
			header("refresh:0.5; url=home_page.php");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign Up Form</title>
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

    .container {
      width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      box-sizing: border-box;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    h2 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
	
    .form-group button {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #ffffff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
  
  <script>
function display()
{
	var name_check=0, email_check=0, password_check=0, confirm_password_check=0, contact_num_check=0;
	var name, email, password, contact_num, gender;
	var name_pattern, password_pattern, email_pattern, cont_num_pattern;
	
	name_pattern=/^[a-zA-Z\s]+$/;
	password_pattern=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
	email_pattern=/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
	cont_num_pattern=/^[0-9]{3}-[0-9]{7,8}$/;
	//Exp : 012-34567890
	
	name = document.register.name.value;
	email = document.register.email.value;
	password = document.register.password.value;
	confirm_password = document.register.confirm_password.value;
	contact_num = document.register.contact_num.value;
	gender = document.register.gender.value;
	
	if (!name.match(name_pattern))
	{
		document.getElementById("error_name").innerHTML="<br>Name must be sentences";
		return false;
	}
	else
	{
		document.getElementById("error_name").innerHTML="";
		name_check=1;
	}
	
	if (!email.match(email_pattern))
	{
		document.getElementById("error_email").innerHTML="<br>Please Enter A Valid Email";
		return false;
	}
	else
	{
		document.getElementById("error_email").innerHTML="";
		email_check=1;
	}
	
	if (!password.match(password_pattern))
	{
		document.getElementById("error_password").innerHTML="<br>Must contain at least 8 or more characters with at least one number,one uppercase letter,one lowercase letter and one special character!";
		return false;
	}
	else 
	{
		document.getElementById("error_password").innerHTML="";
		password_check=1;
	}
	
	if (confirm_password != password)
	{
		document.getElementById("error_confirm_password").innerHTML="<br>Not Match With Password!";
		return false;
	}
	else 
	{
		document.getElementById("error_confirm_password").innerHTML="";
		confirm_password_check=1;
	}
	
	if (!contact_num.match(cont_num_pattern))
	{
		document.getElementById("error_contact_num").innerHTML="<br>Please Enter A Valid Contact Number";
		return false;
	}
	else
	{
		document.getElementById("error_contact_num").innerHTML="";
		contact_num_check=1;
	}
	
	// Check if all fields are valid before returning true
	if (name_check && email_check && password_check && confirm_password_check && contact_num_check == 1)
	{
		return true;
	} 
	else 
	{
		return false;
	}
}
</script>
</head>
<body>
  <div class="container">
    <h2>Sign Up</h2>
    <form name="register" method="GET" onsubmit="return display()">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
		<span id="error_name" style="color:red;"></span>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
		<span id="error_email" style="color:red;"></span>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
		<span id="error_password" style="color:red;"></span>
      </div>
      <div class="form-group">
        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
		<span id="error_confirm_password" style="color:red;"></span>
      </div>
      <div class="form-group">
        <label for="contact-number">Contact Number:</label>
        <input type="text" id="contact-number" name="contact_num" placeholder="Enter Contact Number" required>
		<span id="error_contact_num" style="color:red;"></span>
      </div>
	  
	  <div class="form-group">
        <label for="gender">Gender:</label>
      <select id="gender" name="gender" required>
	  <option value="">Select</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
		</div>

      <input type="submit" value="Sign Up" name="submitbtn" style="background-color: #FFA500; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px;" />
    </form>
    <a href="home_page.php" style="display: block; text-align: center; margin-top: 10px;">Back to Home Page</a>
  </div>
</body>
</html>