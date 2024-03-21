<?php
	session_start();
	include("dataconection.php");
	$error="";
	
	if(isset($_GET["submitbtn"]))
	{
		$NAME=$_GET["name"];
		$SYMBOL=$_GET["symbol"];
		$RATES=$_GET["rates"];
		
		$checkname="SELECT * from currency where NAME='$NAME'";
		$result=mysqli_query($connect,$checkname);
		$used_name=mysqli_num_rows($result);
		
		if($used_name>0)
		{
			?>
			<script>
				alert("Currency Name Already Registed! Please Type Different Currency Name.");
			</script>
			<?php
		}
		else
		{
			$sql=mysqli_query($connect,"INSERT INTO currency(NAME, SYMBOL, RATES)VALUES('$NAME','$SYMBOL','$RATES')");
			?>
			<script>
				alert("Currency successful added");
			</script>
			<?php
			header("refresh:0.5; url=currencylist_page.php");
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>

<title>Add Currency Rates</title>
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
	var name_check=0, symbol_check=0;
	var name, symbol, rates;
	var name_pattern, symbol_pattern;
	
	name_pattern=/^[a-zA-Z\s]+$/;
	symbol_pattern=/^[a-zA-Z\s]+$/;
	
	name = document.register.name.value;
	symbol = document.register.symbol.value;
	rates = document.register.rates.value;
	
	if (name == "" || symbol == "" || rates == "")
	{
		alert("Please fill in all fields");
		return false;
	}
	
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
	
	if (!symbol.match(symbol_pattern))
	{
		document.getElementById("error_symbol").innerHTML="<br>Please Enter A Valid symbol";
		return false;
	}
	else
	{
		document.getElementById("error_symbol").innerHTML="";
		symbol_check=1;
	}
	
	// Check if all fields are valid before returning true
	if (name_check==1 && symbol_check==1)
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

<form name="register" method="GET" onsubmit="return display()">

<p>
Currency Name : 
<input type="text" name="name" placeholder="Enter Currency Name">
<span id="error_name" style="color:red;"></span>
</p>

<p>
Currency Symbol : 
<input type="text" name="symbol" placeholder="Enter Currency Symbol">
<span id="error_symbol" style="color:red;"></span>
</p>

<p>
Rates : 
<input type="number" name="rates" step="0.01" min="0.00" placeholder="Enter Currency Rates"> = 1 MYR</input>
<span id="error_rates" style="color:red;"></span>
</p>

<p>
<input type="submit" value="Save" name="submitbtn" class="button"/>
</p>

<a href="currencylist_page.php">Back To List</a>

</form>


</div>
</body>
</html>