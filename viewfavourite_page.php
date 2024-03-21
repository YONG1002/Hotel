<?php
	include ("dataconection.php");
	session_start();
	$user_id=$_SESSION['id'];
	$result = mysqli_query($connect,"SELECT * from favourite WHERE USER_ID = '$user_id'");
	
	
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Favourite</title>

<style>
	.slideshow-container 
	{
		position: relative;
		max-width: 500px;
		margin: auto;
	}

	.slide 
	{
		display: none;
	}

	.slide img 
	{
		width: 100%;
		height: auto;
	}

	.radio-container 
	{
		text-align: center;
		margin-top: 10px;
	}
	
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

document.addEventListener("DOMContentLoaded", function () 
{
	var slides = document.getElementsByClassName("slide");
	var radios = document.getElementsByName("selected_image");
	var currentSlide = 0;

	// Show the initial slide
	slides[currentSlide].style.display = "block";
	
	// Add event listeners to radio buttons
	for (var i = 0; i < radios.length; i++) 
	{
		radios[i].addEventListener("change", function () 
		{
			currentSlide = parseInt(this.value) - 1;
			showSlide(currentSlide);
		});
	}

	// Function to show the current slide
	function showSlide(slideIndex) 
	{
		if (slideIndex < 0)
		{
			slideIndex = slides.length - 1;
		}
		else if (slideIndex >= slides.length) 
		{
			slideIndex = 0;
		}
		for (var i = 0; i < slides.length; i++) 
		{
			slides[i].style.display = "none";
		}
		slides[slideIndex].style.display = "block";
	}
});
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

<div style="padding-top: 90px; padding-left: 20px; padding-bottom:30px;">
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
		<th>Discribe</th>
		<th>Image</th>
		<th>Host Email</th>
		<th>Host Contact Number</th>
		<th>Homestay Address</th>
		<th>Maximum People</th>
		<th>Provides</th>
		<th>Price (RM)</th>
		<th></th>
		<th></th>
	</tr>
</thead>
<?php
while($row=mysqli_fetch_assoc($result))
{
	$homestay_ID = $row["HOMESTAY_ID"];
	$favourite_ID = $row["ID"];
	
	if(isset($_GET['delete']))
	{
		$homestay_ID=$_GET['id'];
		mysqli_query($connect,"DELETE FROM favourite WHERE ID='$favourite_ID'");
		?>
		<script>
		alert("Record deleted!");
		location.assign("homestaylist_page.php");
		</script>
		<?php
	}
	
	$result1 = mysqli_query($connect, "SELECT * FROM homestay WHERE ID = '$homestay_ID'");
	$row1 = mysqli_fetch_assoc($result1);
?>
<tbody style="border: 1px solid black">
	<tr>
	<td style="border: 1px solid black" style="text-align: center">
					<?php echo  $row1['NAME']; ?>
					</td>

					<td style="border: 1px solid black" style="text-align: center">
					<?php echo  $row1['COMMENT']; ?>
					</td>
					
					<td style="border: 1px solid black; text-align: center">
					<?php
					$homestay_id=$_SESSION['id1'];
					$img = mysqli_query($connect, "SELECT * FROM homestay_image WHERE HOMESTAY_ID = '$homestay_id'");
					$firstImage = true;

					echo '<div class="slideshow-container">';
					while ($row2 = mysqli_fetch_assoc($img)) 
					{
						$slideClass = $firstImage ? 'slide active' : 'slide';
						echo '<div class="' . $slideClass . '">';
						echo '<img src="data:image/jpeg;base64,' . base64_encode($row2['IMAGE']) . '" height="300" width="500"/>';
						echo '</div>';
						$firstImage = false;
					}
					echo '</div>';
					?>
					
					<div class="radio-container">
					<?php
					$homestay_id=$_SESSION['id1'];
					$img = mysqli_query($connect, "SELECT * FROM homestay_image WHERE HOMESTAY_ID = '$homestay_id'");
					$slideCount = 1;
					while ($row2 = mysqli_fetch_assoc($img)) 
					{
						$checked = $slideCount === 1 ? 'checked' : '';
						echo '<input type="radio" name="selected_image" value="' .$slideCount . '" ' . $checked . '>';
						$slideCount++;
					}
					?>
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
					<?php echo  $row1['MAX_PEOPLE']; ?>
					</td>

					<td style="border: 1px solid black" style="text-align: center">
					<div>
					<?php
					$wifi_query = "SELECT WIFI FROM homestay WHERE ID = " . $row1['ID'];
					$wifi_result = mysqli_query($connect, $wifi_query);
					$wifi_row1 = mysqli_fetch_assoc($wifi_result);
					$wifi_value = $wifi_row1['WIFI'];
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
					$petallow_row1 = mysqli_fetch_assoc($petallow_result);
					$petallow_value = $petallow_row1['PET_ALLOW'];
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
					$karaoke_row1 = mysqli_fetch_assoc($karaoke_result);
					$karaoke_value = $karaoke_row1['KARAOKE'];
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
					$freemeals_row1 = mysqli_fetch_assoc($freemeals_result);
					$freemeals_value = $freemeals_row1['FREE_MEALS'];
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
					$swimmingpool_row1 = mysqli_fetch_assoc($swimmingpool_result);
					$swimming_value = $swimmingpool_row1['SWIMMING_POOL'];
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
					<?php echo  $row1['PRICE']; ?>
					</td>
		
		
		<td style="border: 1px solid black" >
		<a href="viewfavourite_page.php?delete&id=<?php echo $row['ID'];?>" onclick="return confirmation()"> Delete </a>
		</td>
	</tr>
</tbody>
<?php
}
?>
</table>

</div>
</body>
</html>