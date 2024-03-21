<?php
session_start();
include("dataconection.php");

if(isset($_GET['id1'])) 
{
	$_SESSION['id1'] = $_GET['id1'];
}

$result = mysqli_query($connect, "SELECT * from comment WHERE ID = '" . $_SESSION['id1'] . "'");
?>

<!DOCTYPE HTML>
<html>
<head>

<title>Reply Comment</title>
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



while($row=mysqli_fetch_assoc($result))
{
	$user_id = $row['USER_ID'];
	
	$result1 = mysqli_query($connect,"SELECT * from user WHERE ID = '$user_id'");
	while($row1=mysqli_fetch_assoc($result1))
	{
		$homestay_id = $row['HOMESTAY_ID'];
		
		$result2 = mysqli_query($connect,"SELECT * from homestay WHERE ID = '$homestay_id'");
		while($row2=mysqli_fetch_assoc($result2))
		{
			
			?>
			
			<p>
			Username : 
			<?php echo  $row1['NAME']; ?>
			</p>
		
			<p>
			Rating : 
			<?php echo  $row['RATING']; ?>
			</p>
			
			<p>
			Comment : 
			<input value="<?php echo  $row['DETAILS']; ?>" disabled>
			</p>
			
			<p>
			Homestay Name : 
			<?php echo  $row2['NAME']; ?>
			</p>
			
			<form method="GET">

				<p>Reply Comment:</p>
				<textarea name="reply_comment" placeholder="Reply..."></textarea>
				
				<p>
				<input type="submit" value="Reply" name="reply" class="button"/>
				</p>
				
				<a href="commentlist_page.php">Comment List</a>
			</form>
			
			<?php
			if (isset($_GET['reply'])) 
			{
				$comment_ID = $row['ID'];
				$reply = $_GET["reply_comment"];
				
				mysqli_query($connect, "UPDATE comment SET REPLY = '$reply' WHERE ID = '$comment_ID'");
				
				$result_comment = mysqli_query($connect, "SELECT * FROM comment WHERE ID = '$comment_ID'");
				$row_comment = mysqli_fetch_assoc($result_comment);
				
				$user_id = $row_comment['USER_ID'];
				$result_user = mysqli_query($connect, "SELECT * FROM user WHERE ID = '$user_id'");
				$row_user = mysqli_fetch_assoc($result_user);
				$cust_email = $row_user['EMAIL'];
				
				$to = $cust_email;
				$subject = 'THANK YOU FOR YOUR COMMENT';
				$content = 'Hi ' . $row_user["NAME"] . ', ';
				$content .= $reply;
				$headers = "From: mmutse2231@gmail.com\r\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

				if (mail($to, $subject, $content, $headers)) 
				{
					?>
					<script>
						alert("Reply Comment Successful!");
						location.assign("commentlist_page.php");
					</script>
					<?php
				}
				else 
				{
					?>
					<script>
						alert("Failed to send reply. Please try again.");
						location.assign("commentlist_page.php");
					</script>
					<?php
				}
			}
		}
	}
}

?>
</div>
</body>
</html>