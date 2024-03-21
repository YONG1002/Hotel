<?php
	include("dataconection.php");
	session_start();
	$user_id=$_SESSION['id'];
?>

<!DOCTYPE HTML>
<html>
<head>

<title>Cart</title>

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
        
        
    
    </style>
	
 <script>
function confirmation()
{
	var option;
	option = confirm("Do you want to delete the record ?");
	return option;
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

$result = mysqli_query($connect, "SELECT * FROM cart WHERE USER_ID = '$user_id'");

while($row = mysqli_fetch_array($result))
{
	?>
	<table>
	<thead>
		<tr>
			<th>Homestay Name</th>
			<th>Check In</th>
			<th>Check Out</th>
			<th>Night Stay</th>
			<th>Host Email</th>
			<th>Host Contact Number</th>
			<th>Homestay Address</th>
			<th>Provides</th>
			<th>Price</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<?php
	if(isset($_GET['delete']))
	{
		$cart_id=$row['ID'];
		mysqli_query($connect,"DELETE FROM cart WHERE ID ='$cart_id'");
		?>
		<script>
		alert("Record deleted!");
		location.assign("viewcart_page.php");
		</script>
		<?php
	}
	
	$homestay_id = $row["HOMESTAY_ID"];
	
	$result1=mysqli_query($connect,"SELECT * FROM homestay WHERE ID = '$homestay_id'");
	while($row1 = mysqli_fetch_array($result1))
	{
		
		?>
		
		
		<tbody style="border: 1px solid black">
		<tr>
		<td style="border: 1px solid black" style="text-align: center">
		<?php echo  $row1['NAME']; ?>
		</td>
		
		<td style="border: 1px solid black" style="text-align: center">
		<?php echo  $row['CHECK_IN']; ?>
		</td>
		
		<td style="border: 1px solid black" style="text-align: center">
		<?php echo  $row['CHECK_OUT']; ?>
		</td>
		
		<td style="border: 1px solid black" style="text-align: center">
		<?php echo  $row['STAY']; ?>
		</td>
		
		<td style="border: 1px solid black" style="text-align: center">
		<?php echo  $row1['EMAIL']; ?>
		</td>
		
		<td style="border: 1px solid black" style="text-align: center">
		<?php echo  $row1['CONTACT_NUMBER']; ?>
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
		$wifi_query = "SELECT WIFI FROM homestay WHERE ID = " . $row1['ID'];
		$wifi_result = mysqli_query($connect, $wifi_query);
		$wifi_row = mysqli_fetch_assoc($wifi_result);
		$wifi_value = $wifi_row['WIFI'];
		if($wifi_value == 1) 
		{
			echo "- WIFI";
		} 
		else 
		{
			echo "";
		} 
		?>
		</div>
		
		<div>
		<?php
		$petallow_query = "SELECT PET_ALLOW FROM homestay WHERE ID = " . $row1['ID'];
		$petallow_result = mysqli_query($connect, $petallow_query);
		$petallow_row = mysqli_fetch_assoc($petallow_result);
		$petallow_value = $petallow_row['PET_ALLOW'];
		if($petallow_value == 1) 
		{
			echo "- PET ALLOW";
		} 
		else 
		{
			echo "";
		} 
		?>
		</div>
		
		<div>
		<?php
		$karaoke_query = "SELECT KARAOKE FROM homestay WHERE ID = " . $row1['ID'];
		$karaoke_result = mysqli_query($connect, $karaoke_query);
		$karaoke_row = mysqli_fetch_assoc($karaoke_result);
		$karaoke_value = $karaoke_row['KARAOKE'];
		if($karaoke_value == 1) 
		{
			echo "- KARAOKE";
		} 
		else 
		{
			echo "";
		} 
		?>
		</div>
		
		<div>
		<?php
		$freemeals_query = "SELECT FREE_MEALS FROM homestay WHERE ID = " . $row1['ID'];
		$freemeals_result = mysqli_query($connect, $freemeals_query);
		$freemeals_row = mysqli_fetch_assoc($freemeals_result);
		$freemeals_value = $freemeals_row['FREE_MEALS'];
		if($freemeals_value == 1) 
		{
			echo "- FREE MEALS";
		} 
		else 
		{
			echo "";
		} 
		?>
		</div>
		
		<div>
		<?php
		$swimmingpool_query = "SELECT SWIMMING_POOL FROM homestay WHERE ID = " . $row1['ID'];
		$swimmingpool_result = mysqli_query($connect, $swimmingpool_query);
		$swimmingpool_row = mysqli_fetch_assoc($swimmingpool_result);
		$swimming_value = $swimmingpool_row['SWIMMING_POOL'];
		if($swimming_value == 1) 
		{
			echo "- SWIMMING POOL";
		} 
		else 
		{
			echo "";
		} 
		?>
		</div>
		</td>
		
		<td style="border: 1px solid black" style="text-align: center">
		<?php 
		$result2 = mysqli_query($connect, "SELECT * FROM currency");
		if(mysqli_num_rows($result2) > 0) 
		{
			echo "<form method='post'>";
			echo "<select name='currency'>";
			while($row2 = mysqli_fetch_array($result2)) 
			{
				$selected = '';
				if(isset($_POST["currency"]) && $_POST["currency"] == $row2["NAME"]) 
				{
					$selected = 'selected';
				}
				echo "<option value='".$row2["NAME"]."' ".$selected.">".$row2["NAME"]."</option>";
			}
			echo "</select>";
			echo "<input type='submit' value='Confirm'>";
			echo "</form>";

			// Retrieve the selected currency rates]
			if(isset($_POST["currency"]))
			{
				$selected_currency = $_POST["currency"];
				$query = "SELECT * FROM currency WHERE NAME='$selected_currency'";
				$result3 = mysqli_query($connect, $query);
				if(mysqli_num_rows($result3) > 0) 
				{
					$row3 = mysqli_fetch_assoc($result3);
					$rates = $row3["RATES"];
					$symbol = $row3["SYMBOL"];
					
					// Calculate the total price
					$price = $row1['PRICE'];
					$stay_duration = $row['STAY'];
					$total_price = ($price * $rates) * $stay_duration;
					echo "Total price: ".$symbol." ".number_format($total_price, 2);
					
					$_SESSION['id1']=$row3["SYMBOL"];
					$symbol=$_SESSION['id1'];
					
					$_SESSION['id2']=$total_price;
					$total_price=$_SESSION['id2'];
				}
			}
			
			if(isset($_GET['confirm']))
			{
				$check_in = $row['CHECK_IN'];
				$check_out = $row['CHECK_OUT'];
				$symbol=$_SESSION['id1'];
				$total_price=$_SESSION['id2'];
				$_SESSION['id3'] = $row['ID'];
				$cart_id=$_SESSION['id3'];
				
				mysqli_query($connect, "INSERT INTO `order` (USER_ID, HOMESTAY_ID, CART_ID, CURRENCY_SYMBOL, TOTAL_PRICE, CHECK_IN_DATE, CHECK_OUT_DATE) VALUES ('$user_id', '$homestay_id', '$cart_id', '$symbol', '$total_price', '$check_in', '$check_out')");
				?>
				<script>
				location.assign("payment_page.php");
				</script>
				<?php
			}
			?>
			</td>
			
			<td style="border: 1px solid black" >
			<a href="viewcart_page.php?confirm&id">Confirm Order</a>
			</td>
			
			<td style="border: 1px solid black" >
			<a href="viewcart_page.php?delete&id=<?php echo $row1['ID'];?>" onclick="return confirmation()"> Delete </a>
			</td>
			</tr>
			</tbody>
		</table>
		<?php
		}
	}
}
?>

</div>
</body>
</html>