<?php
include("dataconection.php");
session_start();
$user_id=$_SESSION['id'];

if(isset($_GET["id1"])) 
{
    $_SESSION['id1'] = $_GET["id1"];
    $homestay_id = $_SESSION['id1'];
}

if(isset($_GET["id2"])) 
{
    $_SESSION['id2'] = $_GET["id2"];
    $CHECK_IN_DATE=$_SESSION['id2'];
}

if(isset($_GET["id3"])) 
{
    $_SESSION['id3'] = $_GET["id3"];
    $CHECK_OUT_DATE=$_SESSION['id3'];
}

$result = mysqli_query($connect, "SELECT * FROM homestay WHERE ID = '$homestay_id'");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>View Homestay</title>
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
	.rating 
	{
		display: inline-block;
		unicode-bidi: bidi-override;
		direction: rtl;
		text-align: center;
	}

	.rating > input 
	{
		display: none;
	}

	.rating > label {
		cursor: pointer;
		width: 20px;
		font-size: 30px;
		color: #ccc;
		float: right;
	}

	.rating > label:before {
		content: '\2605';
	}

	.rating > input:checked ~ label,
	.rating > input:checked ~ label:before {
		color: #f8d64e;
	}

	.rating > label:hover,
	.rating > label:hover ~ label {
		color: #f8d64e;
	}

	.rating > input:checked + label:hover,
	.rating > input:checked ~ label:hover,
	.rating > label:hover ~ input:checked ~ label,
	.rating > input:checked ~ label:hover ~ label {
		color: #f8d64e;
	}
	
	table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    .slideshow-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px;
    }

    .slide {
        display: none;
    }

    .active {
        display: block;
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
}
    
    </style>
    
    <script>
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
	
	<div style="padding-top: 60px; padding-left: 20px;">
<?php 
$resultlogin = mysqli_query($connect,"SELECT * from user WHERE ID='$user_id'");
$log=mysqli_fetch_assoc($resultlogin);
echo "WELCOME ".$log["NAME"];
?>
<form>

<p>
Check In Date:
<input type="date" value="<?php echo $CHECK_IN_DATE; ?>" disabled>
</p>

<p>
Check Out Date:
<input type="date" value="<?php echo $CHECK_OUT_DATE; ?>" disabled>
</p>

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
		</tr>
	</thead>
<?php


while($row = mysqli_fetch_array($result))
{
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
			$homestay_id=$_SESSION['id1'];
			$img = mysqli_query($connect, "SELECT * FROM homestay_image WHERE HOMESTAY_ID = '$homestay_id'");
			$firstImage = true;

			echo '<div class="slideshow-container">';
			while ($row1 = mysqli_fetch_assoc($img)) 
			{
				$slideClass = $firstImage ? 'slide active' : 'slide';
				echo '<div class="' . $slideClass . '">';
				echo '<img src="data:image/jpeg;base64,' . base64_encode($row1['IMAGE']) . '" height="300" width="500"/>';
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
			while ($row1 = mysqli_fetch_assoc($img)) 
			{
				$checked = $slideCount === 1 ? 'checked' : '';
				echo '<input type="radio" name="selected_image" value="' .$slideCount . '" ' . $checked . '>';
				$slideCount++;
			}
			?>
			</td>

			<td style="border: 1px solid black" style="text-align: center">
			<?php echo  $row['EMAIL']; ?>
			</td>

			<td style="border: 1px solid black" style="text-align: center">
			<?php echo  $row['CONTACT_NUMBER']; ?>
			</td>

			<td style="border: 1px solid black" style="text-align: center">
			<div><?php echo  $row['ADDRESS1']; ?></div>
			<div><?php echo  $row['ADDRESS2']; ?></div>
			<div><?php echo  $row['POSTCODE']; ?> <?php echo  $row['CITY']; ?></div>
			<div><?php echo  $row['STATE']; ?></div>
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
			
			<td style="border: 1px solid black">
			<input type="submit" value="Add To Favourite" name="favouritebtn"/>
			</td>
			
			<td style="border: 1px solid black" >
			<input type="submit" value="Add To Cart" name="cartbtn"/>
			</td>
		</tr>
		
		<tbody>
		
    <tr style="text-align:center; padding 30px 0px 0px 0px;"> 
        <th colspan="10">Customer Comment:</th>
    </tr>
    <tr>
        <td colspan="10" style="border: 1px solid black; text-align: center">
            <?php
            $homestay_id = $_SESSION['id1'];
            $result1 = mysqli_query($connect, "SELECT * FROM comment WHERE HOMESTAY_ID = '$homestay_id'");
            $result2 = mysqli_query($connect, "SELECT * FROM comment WHERE HOMESTAY_ID = '$homestay_id'");

            $sumRatings = 0;
            $totalRatings = 0;

            $count1 = mysqli_num_rows($result1);
            $count2 = mysqli_num_rows($result2);

            if ($count1 && $count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($result1)) {
                    $sumRatings += $row2['RATING'];
                    $totalRatings += 1;
                }
                $meanRating = $sumRatings / $totalRatings;
                echo "Rating : " . $meanRating;

                while ($row3 = mysqli_fetch_assoc($result2)) {
                    echo "<br>" . $row3['DETAILS'];
                }
            } else {
                echo "No Comments Yet From Other Customers";
            }
            ?>
        </td>
    </tr>
</tbody>
	</tbody>
	<?php
}
?>
</table>

</form>

<p>
    <a href="homestaylist_page.php" class="back-button">Back</a>
</p>

</div>
</div>
    
</body>
</html>


<?php

if(isset($_GET["favouritebtn"]))
{
	
	$homestay_id=$_SESSION['id1'];
	
	$checkfavourite="SELECT * FROM favourite WHERE USER_ID = '$user_id' AND HOMESTAY_ID = '$homestay_id'";
	$checkfavouriteresult=mysqli_query($connect,$checkfavourite);
	$addedfavourite=mysqli_num_rows($checkfavouriteresult);
	
	if($addedfavourite>0)
	{
		?>
		<script>
			alert("Fail ! The Homestay Has Been Added In Favourite");
		</script>
		<?php
	}
	else
	{
		$favourite = mysqli_query($connect,"INSERT INTO favourite (USER_ID, HOMESTAY_ID) VALUES ('$user_id', '$homestay_id')");
		?>
		<script>
			alert("Add Homestay To Favourite Successful !");
		</script>
		<?php
	}
}

if(isset($_GET["cartbtn"]))
{
	$homestay_id=$_SESSION['id1'];
	$checkcart="SELECT * FROM cart WHERE USER_ID = '$user_id'";
	$checkcartresult=mysqli_query($connect,$checkcart);
	$addedcart=mysqli_num_rows($checkcartresult);
	
	$checkinDate = $_SESSION['id2'];
	$checkoutDate = $_SESSION['id3'];
	
	$checkinTimestamp = strtotime($checkinDate);
	$checkoutTimestamp = strtotime($checkoutDate);

	$diffSeconds = abs($checkoutTimestamp - $checkinTimestamp);
	$diffDays=ceil($diffSeconds / 86400);
	
	if($addedcart>0)
	{
		?>
		<script>
			alert("Fail ! Please Clear Your Cart");
		</script>
		<?php
		
	}
	else
	{
		$cart = mysqli_query($connect,"INSERT INTO cart (USER_ID, HOMESTAY_ID, CHECK_IN, CHECK_OUT, STAY) VALUES ('$user_id', '$homestay_id', '$checkinDate', '$checkoutDate', '$diffDays')");
		?>
		<script>
			alert("Add Homestay To Cart Successful !");
		</script>
		<?php
	}
}
?>