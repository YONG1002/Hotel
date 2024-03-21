<?php
	include ("dataconection.php");
	session_start();
	$user_id=$_SESSION['id'];
	
	if(isset($_GET["id1"])) 
	{
		$_SESSION['id1'] = $_GET["id1"];
		$reservation_ID=$_SESSION['id1'];
	}
	$result = mysqli_query($connect, "SELECT * FROM reservation WHERE USER_ID = '$user_id' AND ID = '$reservation_ID' ");
	
	if(isset($_GET["download"]))
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=Reservation Homestay.xlsx");
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>View Reservation</title>
	
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
		
		table {
            border-collapse: collapse;
            width: 100%;
        }
        
        table th, table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        
        table th {
            background-color: #f2f2f2;
        }
		
		.button {
            display: inline-block;
            background-color: #FFA500;
            color: #fff;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }
		
    </style>
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
?>
	<form>
		<table>
			<thead>
				<tr>
					<th>Homestay Name</th>
					<th>Homestay Address</th>
					<th>Check In Date</th>
					<th>Check Out Date</th>
					<th>Total Price</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($row = mysqli_fetch_assoc($result))
				{
					$homestay_ID = $row["HOMESTAY_ID"];
					$order_ID = $row["ORDER_ID"];
					
					$result1 = mysqli_query($connect, "SELECT * FROM homestay WHERE ID = '$homestay_ID'");
					$row1 = mysqli_fetch_assoc($result1);
					
					$result2 = mysqli_query($connect, "SELECT * FROM `order` WHERE ID = '$order_ID'");
					$row2 = mysqli_fetch_assoc($result2);
				?>
					<tr>
						<td><?php echo $row1['NAME']; ?></td>
						<td>
							<div><?php echo $row1['ADDRESS1']; ?></div>
							<div><?php echo $row1['ADDRESS2']; ?></div>
							<div><?php echo $row1['POSTCODE']; ?> <?php echo $row1['CITY']; ?></div>
							<div><?php echo $row1['STATE']; ?></div>
						</td>
						<td><?php echo $row2['CHECK_IN_DATE']; ?></td>
						<td><?php echo $row2['CHECK_OUT_DATE']; ?></td>
						<td><?php echo $row2['CURRENCY_SYMBOL'] . " " . $row2['TOTAL_PRICE']; ?></td>
						
							
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		
		<?php
		$checkoutDate = $row2['CHECK_OUT_DATE'];
		$currentDate = date('Y-m-d');

		if ($currentDate > $checkoutDate) 
		{
			echo '<p>
					<a href="comment_page.php?&id1=' . $row1['ID'] . '">
						<input type="button" value="Comment" class="button"/>
					</a>
				</p>';
		}
		?>
		
		 <p>
            <a href="reservationlist_page.php" class="button">Back</a>
        </p>
		
		
	</form>
</div>
</body>
</html>