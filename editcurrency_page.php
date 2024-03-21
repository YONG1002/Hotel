<?php
include ("dataconection.php");
session_start();
if(isset($_POST["editbtn"]))
{
    $currency_id = $_GET["id"];
    $NAME=$_POST["name"];
	$SYMBOL=$_POST["symbol"];
	$RATES=$_POST["rates"];
    
    mysqli_query($connect,"UPDATE currency SET NAME='$NAME',
											SYMBOL='$SYMBOL',
											RATES='$RATES'
                                            WHERE ID='$currency_id'");
                                            
    ?>
        <script>
            alert("Record Saved !");
        </script>
    <?php
                                            
    header("refresh:0.5; url='currencylist_page.php'");
}

if(isset($_GET["id"]))
{
    $currency_id = $_GET["id"];
    $result = mysqli_query($connect,"SELECT * FROM currency WHERE ID='$currency_id'");
    $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE HTML>
<html>
<head>

<title>Edit Currency</title>
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
	
	name = document.editfrm.name.value;
	symbol = document.editfrm.symbol.value;
	rates = document.editfrm.rates.value;
	
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
<form name="editfrm" method="POST" onsubmit="return display()">

<p>
Currency Name : 
<input type="text" name="name" value="<?php echo isset($row['NAME']) ? $row['NAME'] : ''; ?>"></input>
<span id="error_name" style="color:red;"></span>
</p>

<p>
Currency Symbol : 
<input type="text" name="symbol" value="<?php echo isset($row['SYMBOL']) ? $row['SYMBOL'] : ''; ?>"></input>
<span id="error_symbol" style="color:red;"></span>
</p>

<p>
Rates : 
<input type="number" name="rates" step="0.01" min="0.00" value="<?php echo isset($row['RATES']) ? $row['RATES'] : ''; ?>"> = 1 MYR</input>
<span id="error_rates" style="color:red;"></span>
</p>

<input type="submit" value="Update" name="editbtn" class="button"/>

</form>

<p>
<a href="currencylist_page.php">Currency List
</a>
</p>
</div>
</body>
</html>
