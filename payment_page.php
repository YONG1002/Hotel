<?php
	include("dataconection.php");
	session_start();
	$user_id=$_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment Page</title>
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
        
        .back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #FFA500;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.back-button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2);
}
    
    </style>
<script>
function display()
{
	var card_number_check=0, cvv_check=0, card_name_check=0;
	var card_number, expiry_date, cvv, card_name;
	var card_number_pattern, cvv_pattern, card_name_pattern;
	
	card_number_pattern = /^[0-9]{16}$/;
	cvv_pattern = /^\d{3}$/;
	card_name_pattern = /^[a-zA-Z\s]+$/;
	
	card_number = document.payment.card_number.value;
	expiry_date = document.payment.expiry_date.value;
	cvv = document.payment.cvv.value;
	card_name = document.payment.card_name.value;
	
	if (!card_number.match(card_number_pattern))
	{
		document.getElementById("error_card_number").innerHTML="<br>Only Number Will Be Allow To Fill In And Must Be 16 Digit";
		return false;
	}
	else
	{
		document.getElementById("error_card_number").innerHTML="";
		card_number_check=1;
	}
	
	if (!cvv.match(cvv_pattern))
	{
		document.getElementById("error_cvv").innerHTML="<br>Please Type The Valid Input";
		return false;
	}
	else
	{
		document.getElementById("error_cvv").innerHTML="";
		cvv_check=1;
	}
	
	if (!card_name.match(card_name_pattern))
	{
		document.getElementById("error_card_name").innerHTML="<br>Card Name Must Be Sentences";
		return false;
	}
	else
	{
		document.getElementById("error_card_name").innerHTML="";
		card_name_check=1;
	}
	
	// Check if all fields are valid before returning true
	if (card_number_check && cvv_check && card_name_check == 1)
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
<a href="viewfavourite_page.php">View Favoirite</a>
			<a href="viewcart_page.php">View Cart</a>
			<a href="homestaylist_page.php">Home Stay</a>
			<a href="reservationlist_page.php">Order History</a>
			
			<a href="editprofile_page.php?edit&id=<?php echo $user_id; ?>">Edit Profile</a>
			<a href="logout_page.php">Log Out</a>
        </nav>
    </header>

<div style="padding-top: 90px; padding-left: 20px;">
	<?php 
$resultlogin = mysqli_query($connect,"SELECT * from user WHERE ID='$user_id'");
$log=mysqli_fetch_assoc($resultlogin);
echo "WELCOME ".$log["NAME"];

$cart_id = $_SESSION['id3'];

$result = mysqli_query($connect, "SELECT * from `order` WHERE USER_ID = '$user_id' AND CART_ID = '$cart_id'");

while($row=mysqli_fetch_assoc($result))
{
	$homestay_id = $row["HOMESTAY_ID"];
	$order_id=$row["ID"];
	
	if(isset($_GET['back']))
	{
		mysqli_query($connect,"DELETE FROM `order` WHERE ID='$order_id'");
		?>
		<script>
		location.assign("viewcart_page.php");
		</script>
		<?php
	}
	
	$result1 = mysqli_query($connect, $homestay = "SELECT * FROM homestay WHERE ID = '$homestay_id'");
	while($row1 = mysqli_fetch_array($result1))
	{
		?>
		<table>
		<thead>
		<tr>
			<th>Homestay Name</th>
			<th>Homestay Address</th>
			<th>Total Price</th>
			<th>Check In</th>
			<th>Check Out</th>
		</tr>
		</thead>
		
		<tbody style="border: 1px solid black">
			<tr>
				
				<td style="border: 1px solid black" style="text-align: center">
				<?php echo  $row1['NAME']; ?>
				</td>
				
				<td style="border: 1px solid black" style="text-align: center">
				<div><?php echo  $row1['ADDRESS1']; ?></div>
				<div><?php echo  $row1['ADDRESS2']; ?></div>
				<div><?php echo  $row1['POSTCODE']; ?> <?php echo  $row1['CITY']; ?></div>
				<div><?php echo  $row1['STATE']; ?></div>
				</td>
				
				<td style="border: 1px solid black" style="text-align: center">
				<div>
				<?php
					echo $row['CURRENCY_SYMBOL']." ".number_format($row['TOTAL_PRICE'], 2);
				?>
				</div>
				
				<td style="border: 1px solid black" style="text-align: center">
				<?php echo  $row['CHECK_IN_DATE']; ?>
				</td>
				
				<td style="border: 1px solid black" style="text-align: center">
				<?php echo  $row['CHECK_OUT_DATE']; ?>
				</td>
			</tr>
		</tbody>
		</table>
		<?php
		$_SESSION['id1']=$row['CURRENCY_SYMBOL'];
		$currency_symbol=$_SESSION['id1'];
		
		$_SESSION['id2']=$row['TOTAL_PRICE'];
		$total_price=$_SESSION['id2'];
		?>
		<form name="payment" method="GET" onsubmit="return display()">
		<p>
		Pay:
		<?php $currency_symbol=$_SESSION['id1']; $total_price=$_SESSION['id2']; ?>
		<input type="text" name="pay" value="<?php echo $currency_symbol." ".number_format($total_price, 2);?>" disabled>
		</p>

		<p>
		Card Number:
		<input type="text" name="card_number" required>
		<span id="error_card_number" style="color:red;"></span>
		</p>

		<p>
		Expiry Date:
		<input type="month" name="expiry_date" min="<?php echo date('Y-m'); ?>" required>
		</p>

		<p>
		CVV:
		<input type="text" name="cvv" required>
		<span id="error_cvv" style="color:red;"></span>
		</p>

		<p>
		Name on Card:
		<input type="text" name="card_name" required>
		<span id="error_card_name" style="color:red;"></span>
		</p>
		
		<p>
		<input class="back-button" type="submit" value="Make Payment" name="pay">
		</p>
		
		</form>
		<?php
	}
	
	if(isset($_GET['pay']))
	{
		mysqli_query($connect, "INSERT INTO reservation (USER_ID, HOMESTAY_ID, ORDER_ID) VALUES ('$user_id', '$homestay_id', '$order_id')");
		mysqli_query($connect, "DELETE FROM cart WHERE USER_ID='$user_id'");
		?>
		<script>
		alert("Payment Sucessful");
		location.assign("landing_page.php");
		</script>
		<?php
	}
}
?>

<p>
    <a href="homestaylist_page.php" class="back-button">
        Back
    </a>
</p>
</p>
</div>

</body>
</html>