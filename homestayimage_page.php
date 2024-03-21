<?php
include("dataconection.php");
session_start();
$admin_id = $_SESSION['id'];

if(isset($_GET["id3"])) 
{
    $_SESSION['id1'] = $_GET["id3"];
    $homestay_id = $_SESSION['id1'];
}
?>

<?php

$name = mysqli_query($connect, "SELECT * from homestay WHERE ID = '$homestay_id'");
while($row1 = mysqli_fetch_assoc($name))
{
	echo  "<br><br>".$row1['NAME'];
}

if(isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) 
{
	$homestay_id=$_SESSION['id1'];
	
	$image_data = file_get_contents($_FILES['image']['tmp_name']);
	$stmt = mysqli_prepare($connect, "INSERT INTO homestay_image (HOMESTAY_ID, IMAGE) VALUES ('$homestay_id', ?)");
	mysqli_stmt_bind_param($stmt, "s", $image_data);
	mysqli_stmt_execute($stmt);
	?>
	<script>
		alert("Upload successful");
		window.location.href = "homestaylist_page.php";
	</script>
	<?php
	exit();
}

if (isset($_GET['id2'])) 
{
    $image_id = $_GET['id2'];
    
    $stmt = mysqli_prepare($connect, "DELETE FROM homestay_image WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $image_id);
    mysqli_stmt_execute($stmt);
    
    ?>
    <script>
        alert("Deleted");
        window.location.href = "homestaylist_page.php";
    </script>
    <?php
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Homestay Image</title>
	
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

<div style="padding-top: 60px; padding-left: 20px;">
	<?php 
$resultlogin = mysqli_query($connect,"SELECT * from admin WHERE ID='$admin_id'");
$log=mysqli_fetch_assoc($resultlogin);
echo "WELCOME ".$log["NAME"];
?>
    <?php
	$homestay_id=$_SESSION['id1'];
    $img = mysqli_query($connect, "SELECT * FROM homestay_image WHERE HOMESTAY_ID = '$homestay_id'");
    $firstImage = true;

    echo '<div class="slideshow-container">';
    while ($row = mysqli_fetch_assoc($img)) 
	{
		$slideClass = $firstImage ? 'slide active' : 'slide';
		echo '<div class="' . $slideClass . '">';
		echo '<img src="data:image/jpeg;base64,' . base64_encode($row['IMAGE']) . '" height="300" width="500"/>';
		echo '<a href="homestayimage_page.php?delete&id2=' . $row['ID'] . '" onclick="return confirmation()">Delete</a>';
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
    while ($row = mysqli_fetch_assoc($img)) 
	{
		$checked = $slideCount === 1 ? 'checked' : '';
		echo '<input type="radio" name="selected_image" value="' .$slideCount . '" ' . $checked . '>';
		$slideCount++;
	}
?>

</div>
<p>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit" class="button">Upload</button>
    </form>
</p>

<p>
	<a href="homestaylist_page.php">Homestay List</a>
</p>

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
</div>
</body>
</html>