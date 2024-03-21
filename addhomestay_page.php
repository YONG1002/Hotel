<?php
	session_start();
	include("dataconection.php");
	$error="";
	
	if(isset($_GET["submitbtn"]))
	{
		$NAME=$_GET["name"];
		$DESCRIBE=$_GET["describe"];
		$EMAIL=$_GET["email"];
		$CONT_NUM=$_GET["cont_num"];
		$ADDRESS1=$_GET["address1"];
		$ADDRESS2=$_GET["address2"];
		$STATE=$_GET["state"];
		$CITY=$_GET["city"];
		$POSTCODE=$_GET["postcode"];
		$MAX_PEOPLE=$_GET["maximum"];
		$PRICE=$_GET["price"];
		$WIFI=isset($_GET["wifi"]) ? 1 : 0;
		$PETALLOW=isset($_GET["petallow"]) ? 1 : 0;
		$KARAOKE=isset($_GET["karaoke"]) ? 1 : 0;
		$FREEMEALS=isset($_GET["freemeals"]) ? 1 : 0;
		$SWIMMINGPOOL=isset($_GET["swimmingpool"]) ? 1 : 0;
		
		$sql=mysqli_query($connect,"INSERT INTO homestay(NAME, COMMENT, EMAIL, CONTACT_NUMBER, ADDRESS1, ADDRESS2, STATE, CITY, POSTCODE, MAX_PEOPLE, PRICE, WIFI, PET_ALLOW, KARAOKE, FREE_MEALS, SWIMMING_POOL) VALUES('$NAME','$DESCRIBE','$EMAIL','$CONT_NUM','$ADDRESS1','$ADDRESS2','$STATE','$CITY','$POSTCODE','$MAX_PEOPLE','$PRICE','$WIFI','$PETALLOW','$KARAOKE','$FREEMEALS','$SWIMMINGPOOL')");
		?>
		<script>
			alert("Homestay successful added");
		</script>
		<?php
		header("refresh:0.5; url=homestaylist_page.php");
	}
?>

<!DOCTYPE HTML>
<html>
<head>

<title>Add Homestay</title>
<style>
    
	body
		{
			font-family: Arial, sans-serif;
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
    input[type="number"],
    input[type="email"]{
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
	var email_check=0, cont_num_check=0;
	var name, email, cont_num, address1, address2, state, city, postcode, price;
	var name_pattern, email_pattern, cont_num_pattern;
	
	name_pattern=/^[a-zA-Z\s]+$/;
	email_pattern=/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
	cont_num_pattern=/^[0-9]{3}-[0-9]{7,8}$/;
	
	name = document.register.name.value;
	email = document.register.email.value;
	cont_num = document.register.cont_num.value;
	address1 = document.register.address1.value;
	address2 = document.register.address2.value;
	state = document.register.state.value;
	city = document.register.city.value;
	postcode = document.register.postcode.value;
	price = document.register.price.value;
	
	if (name == "" || email == "" || cont_num == "" || address1 == "" || address2 == "" || city == "" || postcode == "" || price == "")
	{
		alert("Please fill in all fields");
		return false;
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
	
	if (!cont_num.match(cont_num_pattern))
	{
		document.getElementById("error_contact").innerHTML="<br>The Format must be 012-34567890";
		return false;
	}
	else 
	{
		document.getElementById("error_contact").innerHTML="";
		cont_num_check=1;
	}
	
	// Check if all fields are valid before returning true
	if (email_check==1 && cont_num_check==1)
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
<form name="register" method="GET" onsubmit="return display()">

<p>
<h2><b>Add New Homestay</b></h2>
</p>

<p>
Homestay Name : 
<input type="text" name="name" placeholder="Enter Homestay Name"></input>
</p>

<p>
Describe : 
<textarea type="text" name="describe" placeholder="Describe"></textarea>
</p>

<p>
Email : 
<input type="email" name="email" placeholder="Enter Host Email"></input>
<span id="error_email" style="color:red;"></span>
</p>

<p>
Contact Number : 
<input type="text" name="cont_num" placeholder="Enter Host Contact Number"></input>
<span id="error_contact" style="color:red;"></span>
</p>

<p>
Address Line 1 : 
<input type="text" name="address1" placeholder="Enter Address Line 1"></input>
</p>

<p>
Address Line 2 : 
<input type="text" name="address2" placeholder="Enter Address Line 1"></input>
</p>

<p>
State : 
<select name="state">
	<option value="JOHOR">JOHOR</option>
	<option value="KEDAH">KEDAH</option>
	<option value="KELANTAN">KELANTAN</option>
	<option value="MALACCA">MALACCA</option>
	<option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
	<option value="PAHANG">PAHANG</option>
	<option value="PENANG">PENANG</option>
	<option value="PERAK">PERAK</option>
	<option value="PERLIS">PERLIS</option>
	<option value="SABAH">SABAH</option>
	<option value="SARAWAK">SARAWAK</option>
	<option value="SELANGOR">SELANGOR</option>
	<option value="TERENGGANU">TERENGGANU</option>
</select>
</p>

<p>
City : 
<input type="text" name="city" placeholder="Enter City"></input>
</p>

<p>
Postcode : 
<input type="text" name="postcode" placeholder="Enter Postcode"></input>
</p>

<p>
Maximun Number of Ppeople : 
<input type="number" name="maximum" min="1" max="50" value="1"></input>
</p>

<p>
Provides : 
<div><input type="checkbox" name="wifi">Wifi</div>
<div><input type="checkbox" name="petallow">Pet Allow</div>
<div><input type="checkbox" name="karaoke">Karaoke</div>
<div><input type="checkbox" name="freemeals">Free Meals</div>
<div><input type="checkbox" name="swimmingpool">Swimming Pool</div>
</p>

<p>
Price Per Day : RM
<input type="number" name="price"></input>
<span id="error_price" style="color:red;"></span>
</p>

<p>
<input type="submit" value="Add Homestay" name="submitbtn" style="background-color: #FFA500; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px;" />
</p>

</form>

<a href="homestaylist_page.php">Homestay List
</a>
</div>
</body>
</html>