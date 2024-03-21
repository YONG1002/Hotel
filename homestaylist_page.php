<?php
include("dataconection.php");
session_start();
$user_id=$_SESSION['id'];

?>

<!DOCTYPE HTML>
<html>
<head>

<title>Homestay List</title>

</head>

<body>

<?php
include("dataconection.php");
session_start();
$user_id=$_SESSION['id'];

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Home Page</title>
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

		
		.container input[type="submit"] {
			padding: 10px 20px;
			background-color: #FFA500;
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
		}
		
		table {
			width: 100%;
			border-collapse: collapse;
		}

		th, td {
			padding: 8px;
			border-bottom: 1px solid #ddd;
			text-align: center;
		}

		tr:hover {
			background-color: #f5f5f5;
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
	
	<div style="padding-top: 60px; padding-left: 20px;">
	<?php 
$resultlogin = mysqli_query($connect,"SELECT * from user WHERE ID='$user_id'");
$log=mysqli_fetch_assoc($resultlogin);
echo "WELCOME ".$log["NAME"];
?>

<form>

<div class="container">
		<p>
			<select name="state" required>
				<option value="">Where To Go... </option>
				<option value="JOHOR" <?php if(isset($_GET['state']) && $_GET['state'] == 'JOHOR') echo 'selected="selected"'; ?>>JOHOR</option>
				<option value="KEDAH" <?php if(isset($_GET['state']) && $_GET['state'] == 'KEDAH') echo 'selected="selected"'; ?>>KEDAH</option>
				<option value="KELANTAN" <?php if(isset($_GET['state']) && $_GET['state'] == 'KELANTAN') echo 'selected="selected"'; ?>>KELANTAN</option>
				<option value="MALACCA" <?php if(isset($_GET['state']) && $_GET['state'] == 'MALACCA') echo 'selected="selected"'; ?>>MALACCA</option>
				<option value="NEGERI SEMBILAN" <?php if(isset($_GET['state']) && $_GET['state'] == 'NEGERI SEMBILAN') echo 'selected="selected"'; ?>>NEGERI SEMBILAN</option>
				<option value="PAHANG" <?php if(isset($_GET['state']) && $_GET['state'] == 'PAHANG') echo 'selected="selected"'; ?>>PAHANG</option>
				<option value="PENANG" <?php if(isset($_GET['state']) && $_GET['state'] == 'PENANG') echo 'selected="selected"'; ?>>PENANG</option>
				<option value="PERAK" <?php if(isset($_GET['state']) && $_GET['state'] == 'PERAK') echo 'selected="selected"'; ?>>PERAK</option>
				<option value="PERLIS" <?php if(isset($_GET['state']) && $_GET['state'] == 'PERLIS') echo 'selected="selected"'; ?>>PERLIS</option>
				<option value="SABAH" <?php if(isset($_GET['state']) && $_GET['state'] == 'SABAH') echo 'selected="selected"'; ?>>SABAH</option>
				<option value="SARAWAK" <?php if(isset($_GET['state']) && $_GET['state'] == 'SARAWAK') echo 'selected="selected"'; ?>>SARAWAK</option>
				<option value="SELANGOR" <?php if(isset($_GET['state']) && $_GET['state'] == 'SELANGOR') echo 'selected="selected"'; ?>>SELANGOR</option>
				<option value="TERENGGANU" <?php if(isset($_GET['state']) && $_GET['state'] == 'TERENGGANU') echo 'selected="selected"'; ?>>TERENGGANU</option>
			</select>
		</p>

		<p>
			Date Check In :
			<input type="date" name="checkin" id="checkinDate" value="<?php echo isset($_GET['checkin']) ? $_GET['checkin'] : ''; ?>" required>
			<script>
var today = new Date().toISOString().split('T')[0];
document.getElementById("checkinDate").setAttribute("min", today);
</script>
		</p>

		<p>
			Date Check Out : 
			<input type="date" name="checkout" id="checkoutDate" value="<?php echo isset($_GET['checkout']) ? $_GET['checkout'] : ''; ?>" required>

			<div id="totalDaysContainer" style="display:none;"><span id="totalDays"></span></div>
			
			<script>
var checkin = document.getElementById("checkinDate");
var checkout = document.getElementById("checkoutDate");
var totalDaysContainer = document.getElementById("totalDaysContainer");
var totalDays = document.getElementById("totalDays");

checkin.addEventListener("change", function() 
{
	checkout.setAttribute("min", checkin.value);
	checkout.disabled = false;
	totalDaysContainer.style.display = "none";
});

checkout.addEventListener("change", function() 
{
	calculateTotalDays();
	totalDaysContainer.style.display = "block";
});

function calculateTotalDays() 
{
	var checkinDate = new Date(checkin.value);
	var checkoutDate = new Date(checkout.value);
	
	var diffTime = Math.abs(checkoutDate - checkinDate);
	var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
	
	if( diffDays > 30)
	{
		alert("Sorry, reservations for more than 30 nights are not possible");
		location.reload();
	}
	else
	{
		totalDays.textContent = + diffDays + " Night Stay";
	}
}
</script>
		</p>

		<p>
			Maximun Number of People : 
			<input type="number" name="maximum" min="1" max="50" value="<?php echo isset($_GET['maximum']) ? $_GET['maximum'] : '0'; ?>" required>
		</p>

		<p>
			Requipment : 
			<div><input type="checkbox" name="wifi">Wifi</div>
			<div><input type="checkbox" name="petallow">Pet Allow</div>
			<div><input type="checkbox" name="karaoke">Karaoke</div>
			<div><input type="checkbox" name="freemeals">Free Meals</div>
			<div><input type="checkbox" name="swimmingpool">Swimming Pool</div>
		</p>

		<p>
			<div>
				Budget of Homestay (Per Night) : 

				RM 
				<output name="priceoutput" id="priceoutput">1000</output> 
			</div>

			<div>
				<input type="range" name="price" id="pricerange" value="1000" min="30" max="1000" oninput="priceoutput.value = pricerange.value">
			</div>
		</p>

		<p>
			<input type="submit" value="Search" name="searchbtn"/>
		</p>
	</div>



<table>
	

<?php
	if(isset($_GET["searchbtn"]))
	{
		$STATE = $_GET["state"];
		$MAXIMUM = $_GET["maximum"];
		$PRICE = $_GET["price"];
		$CHECK_IN_DATE = $_GET["checkin"];
		$CHECK_OUT_DATE = $_GET["checkout"];
		$CHECKBOX = array();

		if(isset($_GET['wifi'])) 
		{
			$CHECKBOX[] = "WIFI = '1'";
		}

		if(isset($_GET['petallow'])) 
		{
			$CHECKBOX[] = "PET_ALLOW = '1'";
		}

		if(isset($_GET['karaoke'])) 
		{
			$CHECKBOX[] = "KARAOKE = '1'";
		}

		if(isset($_GET['freemeals'])) 
		{
			$CHECKBOX[] = "FREE_MEALS = '1'";
		}

		if(isset($_GET['swimmingpool'])) 
		{
			$CHECKBOX[] = "SWIMMING_POOL = '1'";
		}

		$query = "SELECT * FROM homestay 
          WHERE STATE = '$STATE' AND MAX_PEOPLE >= '$MAXIMUM' AND PRICE <= '$PRICE'
          AND NOT EXISTS (
              SELECT * FROM `order` 
              WHERE homestay_id = homestay.id
                AND (('$CHECK_IN_DATE' BETWEEN CHECK_IN_DATE AND CHECK_OUT_DATE)
                     OR ('$CHECK_OUT_DATE' BETWEEN CHECK_IN_DATE AND CHECK_OUT_DATE))
          )";


if (count($CHECKBOX) > 0) {
    $query .= " AND (" . implode(' AND ', $CHECKBOX) . ")";
}

$result = mysqli_query($connect, $query);


		$num = mysqli_num_rows($result);

		if($num > 0)
		{
			?>
				<thead>
					<tr>
						<th>Homestay Name</th>
						<th>Discribe</th>
						<th>Image</th>
						<th>Maximum People</th>
						<th>Provides</th>
						<th>Price (RM)</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
			<?php
			while($row = mysqli_fetch_array($result))
			{
				$_SESSION['id1']=$row["ID"];
				$homestay_id=$_SESSION['id1'];
				
				?>
					
					<tbody>
					<tr>
						<td style="border: 1px solid black" style="text-align: center">
						<?php echo  $row['NAME']; ?>
						</td>

						<td style="border: 1px solid black" style="text-align: center">
						<?php echo  $row['COMMENT']; ?>
						</td>
						
						<td style="border: 1px solid black; text-align: center">
						<?php
							$img = mysqli_query($connect, "SELECT * FROM homestay_image WHERE HOMESTAY_ID = '$homestay_id'");
						?>
						<div>
							<?php
								$row1 = mysqli_fetch_array($img);
								echo '<img src="data:image/jpeg;base64,' . base64_encode($row1['IMAGE']) . '" height="300" width="500"/>';
							?>
						</div>
						</td>

					

					<td style="border: 1px solid black" style="text-align: center">
					<?php echo  $row['MAX_PEOPLE']; ?>
					</td>

					<td style="border: 1px solid black" style="text-align: center">
					<div>
					<?php
					$wifi_query = "SELECT WIFI FROM homestay WHERE ID = " . $row['ID'];
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
					$petallow_query = "SELECT PET_ALLOW FROM homestay WHERE ID = " . $row['ID'];
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
					$karaoke_query = "SELECT KARAOKE FROM homestay WHERE ID = " . $row['ID'];
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
					$freemeals_query = "SELECT FREE_MEALS FROM homestay WHERE ID = " . $row['ID'];
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
					$swimmingpool_query = "SELECT SWIMMING_POOL FROM homestay WHERE ID = " . $row['ID'];
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
					<?php echo  $row['PRICE']; ?>
					</td>
					
					<td style="border: 1px solid black" >
					<a name="submitbtn" href="viewhomestay_page.php?view&id1=<?php echo $row['ID'];?>&id2=<?php echo $CHECK_IN_DATE;?>&id3=<?php echo $CHECK_OUT_DATE;?>">View</a>
					</td>
					
					</tr>
					</tbody>
					<?php
			}
		}
		else 
		{
			?>
				<thead>
				<tr>
					<th>Result Not Found !</th>
				</tr>
				</thead>
				<?php
		}
	}
?>
</table>
</form>

</div>

</body>
</html>

</html>