<?php
	include("dataconection.php");
	session_start();
	$user_id = $_SESSION['id'];

	if (isset($_GET["homestaybtn"])) {
		$result = mysqli_query($connect, "SELECT * FROM user WHERE ID ='$user_id'");
		$row = mysqli_fetch_assoc($result);
		$_SESSION["id"] = $row["ID"];
	}
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

		.slideshow-container {
			position: relative;
			max-width: 500px;
			margin: auto;
		}

		.slide {
			display: none;
		}

		.slide img {
			width: 100%;
			height: auto;
		}

		.radio-container {
			text-align: center;
			margin-top: 10px;
		}

		.bottom-design {
		  background-color: #FFA500;
		  padding: 80px 0;
		  color: #fff;
		  text-align: center;
		  width: 600px;
		  margin: 30px auto;
}

		.bottom-design p {
			margin: 0;
			font-size: 24px;
			margin-bottom: 30px;
		}

		.reservation-button {
			background-color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 4px;
			font-size: 18px;
			color: #FFA500;
			text-decoration: none;
			cursor: pointer;
			
		}

		.reservation-button:hover {
			background-color: #FFA500;
			color: #fff;
		}
	</style>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			var slides = document.getElementsByClassName("slide");
			var radios = document.getElementsByName("selected_image");
			var currentSlide = 0;

			// Show the initial slide
			slides[currentSlide].style.display = "block";

			// Add event listeners to radio buttons
			for (var i = 0; i < radios.length; i++) {
				radios[i].addEventListener("change", function () {
					currentSlide = parseInt(this.value) - 1;
					showSlide(currentSlide);
				});
			}

			// Function to show the current slide
			function showSlide(slideIndex) {
				if (slideIndex < 0) {
					slideIndex = slides.length - 1;
				} else if (slideIndex >= slides.length) {
					slideIndex = 0;
				}

				for (var i = 0; i < slides.length; i++) {
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
			<nav>
			<a href="landing_page.php">Main Page</a>
<a href="viewfavourite_page.php">View Favoirite</a>
			<a href="viewcart_page.php">View Cart</a>
			<a href="homestaylist_page.php">Home Stay</a>
			<a href="reservationlist_page.php">Order History</a>
			
			<a href="editprofile_page.php?edit&id=<?php echo $user_id; ?>">Edit Profile</a>
			<a href="logout_page.php">Log Out</a>
        </nav>
		</nav>
	</header>
	
	<div style="padding-top: 90px; padding-left: 20px;">
		<?php
		$resultlogin = mysqli_query($connect, "SELECT * from user WHERE ID='$user_id'");
		$log = mysqli_fetch_assoc($resultlogin);
		echo "WELCOME ".$log["NAME"];
		?>

		<?php
		$img = mysqli_query($connect, "SELECT * FROM ad");
		$firstImage = true;

		echo '<div class="slideshow-container">';
		while ($row = mysqli_fetch_assoc($img)) {
			$slideClass = $firstImage ? 'slide active' : 'slide';
			echo '<div class="' . $slideClass . '">';
			echo '<img src="data:image/jpeg;base64,' . base64_encode($row['IMAGE']) . '" height="300" width="500"/>';
			echo '</div>';
			$firstImage = false;
		}
		echo '</div>';
		?>

		<div class="radio-container">
			<?php
			$img = mysqli_query($connect, "SELECT * FROM ad");
			$slideCount = 1;
			while ($row = mysqli_fetch_assoc($img)) {
				$checked = $slideCount === 1 ? 'checked' : ''; // Add this line
				echo '<input type="radio" name="selected_image" value="' . $slideCount . '" ' . $checked . '>'; // Modify this line
				$slideCount++;
			}
			?>
		</div>
	</div>

	<div class="bottom-design">
		<p>Welcome to our homepage! Browse our selection of homestays and start planning your next trip.</p>
		<div>
		<a href="homestaylist_page.php" class="reservation-button">Start Reservation</a>
		</div>
	</div>
</body>
</html>
