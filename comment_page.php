<?php

include("dataconection.php");
session_start();
$user_id=$_SESSION['id'];

if(isset($_GET["id1"])) 
{
	$_SESSION['id1'] = $_GET["id1"];
	
}

if (isset($_GET["submitbtn"])) 
{
    $RATING = $_GET["rating"];
    $COMMENT = $_GET["comment"];
	$homestay_id=$_SESSION['id1'];
    $sql = mysqli_query($connect, "INSERT INTO comment(RATING, DETAILS, USER_ID, HOMESTAY_ID)VALUES('$RATING','$COMMENT', '$user_id', '$homestay_id')");
    ?>
    <script>
        alert("Add Comment To Homestay Successful!");
    </script>
    <?php
    header("refresh:0.5; url=landing_page.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Comment</title>
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
	function display()
	{
		var rating_check=0;
		var rating;
		
		rating = document.confirm.rating.value;
		
		if (rating == "")
		{
			alert("Rating must be fill");
			return false;
		}
		else
		{
			return true;
		}
	}
	</script>
	
    <style>
        .rating {
            display: inline-block;
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: center;
        }

        .rating > input {
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
		
		.button {
        display: inline-block;
        background-color: #FFA500;
        color: #fff;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease-in-out;
        cursor: pointer;
        border: none;
    }

    .button:hover {
        background-color: #FF8C00;
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
    <form method="GET" name="confirm" onsubmit="return display()">
        <p>Rating:
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5" />
                <label for="star5"></label>
                <input type="radio" id="star4" name="rating" value="4" />
                <label for="star4"></label>
                <input type="radio" id="star3" name="rating" value="3" />
                <label for="star3"></label>
                <input type="radio" id="star2" name="rating" value="2" />
                <label for="star2"></label>
                <input type="radio" id="star1" name="rating" value="1" />
                <label for="star1"></label>
            </div>
        </p>

        <p>Comment:</p>
        <textarea name="comment" placeholder="Enter Comment" required></textarea>

        <p>
		<input type="submit" value="Submit" name="submitbtn" class="button">
        </p>
    </form>
	
	<p>
			<a href="viewreservation_page.php">
				<input type="button" value="Back" class="button"/>
			</a>
		</p>
		</div>
</body>
</html>
