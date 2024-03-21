<?php
include ("dataconection.php");
session_start();
if(isset($_POST["editbtn"]))
{
    $homestay_id = $_GET["id"];
    $NAME=$_POST["name"];
	$DESCRIBE=$_POST["describe"];
	$EMAIL=$_POST["email"];
	$CONT_NUM=$_POST["cont_num"];
	$ADDRESS1=$_POST["address1"];
	$ADDRESS2=$_POST["address2"];
	$STATE=$_POST["state"];
	$CITY=$_POST["city"];
	$POSTCODE=$_POST["postcode"];
	$MAX_PEOPLE=$_POST["maximum"];
	$PRICE=$_POST["price"];
	$WIFI=isset($_POST["wifi"]) ? 1 : 0;
	$PETALLOW=isset($_POST["petallow"]) ? 1 : 0;
	$KARAOKE=isset($_POST["karaoke"]) ? 1 : 0;
	$FREEMEALS=isset($_POST["freemeals"]) ? 1 : 0;
	$SWIMMINGPOOL=isset($_POST["swimmingpool"]) ? 1 : 0;
    
    mysqli_query($connect,"UPDATE homestay SET NAME='$NAME',
											COMMENT='$DESCRIBE',
											EMAIL='$EMAIL',
											CONTACT_NUMBER='$CONT_NUM',
                                            ADDRESS1='$ADDRESS1',
											ADDRESS2='$ADDRESS2',
											STATE='$STATE', 
											CITY='$CITY', 
											POSTCODE='$POSTCODE',
											MAX_PEOPLE='$MAX_PEOPLE',
											PRICE='$PRICE',
											WIFI='$WIFI',
											PET_ALLOW='$PETALLOW',
											KARAOKE='$KARAOKE',
											FREE_MEALS='$FREEMEALS',
											SWIMMING_POOL='$SWIMMINGPOOL'
                                            WHERE ID='$homestay_id'");
                                            
    ?>
        <script>
            alert("Record Saved !");
        </script>
    <?php
                                            
    header("refresh:0.5; url='homestaylist_page.php'");
}

if(isset($_GET["id"]))
{
    $homestay_id = $_GET["id"];
    $result = mysqli_query($connect,"SELECT * FROM homestay WHERE ID='$homestay_id'");
    $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE HTML>
<html>
<head>

<title>Edit Homestay</title>
<style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        header {
            background-color: #FFA500;
            padding: 20px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 97.5%;
            z-index: 999;
        }
        
        h1 {
            margin: 0;
            font-size: 32px;
            color: #fff;
        }
        
        nav {
            display: flex;
            align-items: center;
        }
        
        nav a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            margin-left: 20px;
            transition: all 0.3s ease-in-out;
        }
        
        nav a:hover {
            color: #f5f5f5;
            transform: scale(1.1);
        }
        
        .button {
            display: block;
            padding: 10px;
            background-color: #FFA500;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #FF8C00;
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
	
	name = document.editfrm.name.value;
	email = document.editfrm.email.value;
	cont_num = document.editfrm.cont_num.value;
	address1 = document.editfrm.address1.value;
	address2 = document.editfrm.address2.value;
	state = document.editfrm.state.value;
	city = document.editfrm.city.value;
	postcode = document.editfrm.postcode.value;
	price = document.editfrm.price.value;
	
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
<header>
        <h1>Booking Homestay</h1>
        <nav>
			<a href="landing_page.php">Main Page</a>
    <a href="userlist_page.php">User</a>
	<?php
	
	$admin_id = $_SESSION['id'];
	
	if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM admin WHERE ID = 1 AND ID = '$admin_id'")) > 0)
	{
		echo '<a href="adminlist_page.php">Admin</a>';
	}
	?>
    
    <a href="homestaylist_page.php">Homestay</a>
	<a href="currencylist_page.php">Currency</a>
	<a href="reservationlist_page.php">Reservation</a>
	<a href="commentlist_page.php">Comment</a>
	<a href="logout_page.php">Log Out</a>
        </nav>
    </header>

<div style="padding-top: 90px; padding-left: 20px;">
	<?php 
$resultlogin = mysqli_query($connect,"SELECT * from admin WHERE ID='$admin_id'");
$log=mysqli_fetch_assoc($resultlogin);
echo "WELCOME ".$log["NAME"];
?>
<form name="editfrm" method="POST" onsubmit="return display()">

<p>
Homestay Name : 
<input  type="text" name="name" value="<?php echo isset($row['NAME']) ? $row['NAME'] : ''; ?>"></input>
</p>

<p>
Describe : 
<textarea type="text" name="describe"><?php echo isset($row['COMMENT']) ? $row['COMMENT'] : ''; ?></textarea>
</p>

<p>
Email : 
<input type="email" name="email" value="<?php echo isset($row['EMAIL']) ? $row['EMAIL'] : ''; ?>"></input>
<span id="error_email" style="color:red;"></span>
</p>

<p>
Contact Number : 
<input type="text" name="cont_num" value="<?php echo isset($row['CONTACT_NUMBER']) ? $row['CONTACT_NUMBER'] : ''; ?>"></input>
<span id="error_contact" style="color:red;"></span>
</p>

<p>
Address Line 1 : 
<input name="address1" value="<?php echo isset($row['ADDRESS1']) ? $row['ADDRESS1'] : ''; ?>"></input>
</p>

<p>
Address Line 2 : 
<input name="address2" value="<?php echo isset($row['ADDRESS2']) ? $row['ADDRESS2'] : ''; ?>"></input>
</p>

<p>
State : 
<select name="state" value="<?php echo isset($row['STATE']) ? $row['STATE'] : ''; ?>">
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
<input name="city" value="<?php echo isset($row['CITY']) ? $row['CITY'] : ''; ?>"></input>
</p>

<p>
Postcode : 
<input name="postcode" value="<?php echo isset($row['POSTCODE']) ? $row['POSTCODE'] : ''; ?>"></input>
</p>

<p>
Maximun Number of Ppeople : 
<input type="number" name="maximum" min="1" max="50" value="<?php echo isset($row['MAX_PEOPLE']) ? $row['MAX_PEOPLE'] : ''; ?>"></input>
</p>

<p>
Provides : 
<div><input type="checkbox" name="wifi" <?php echo !empty($row['WIFI']) ? 'checked' : ''; ?> value="1">Wifi</div>
<div><input type="checkbox" name="petallow" <?php echo !empty($row['PET_ALLOW']) ? 'checked' : ''; ?> value="1">Pet Allow</div>
<div><input type="checkbox" name="karaoke" <?php echo !empty($row['KARAOKE']) ? 'checked' : ''; ?> value="1">Karaoke</div>
<div><input type="checkbox" name="freemeals" <?php echo !empty($row['FREE_MEALS']) ? 'checked' : ''; ?> value="1">Free Meals</div>
<div><input type="checkbox" name="swimmingpool" <?php echo !empty($row['SWIMMING_POOL']) ? 'checked' : ''; ?> value="1">Swimming Pool</div>
</p>

<p>
Price Per Day : RM
<input type="number" name="price" value="<?php echo isset($row['PRICE']) ? $row['PRICE'] : ''; ?>"></input>
<span id="error_price" style="color:red;"></span>
</p>

<input type="submit" value="Update" name="editbtn" class="button"/>

</form>

<p>
<a href="homestaylist_page.php">Homestay List
</a>
</p>
</div>
</body>
</html>