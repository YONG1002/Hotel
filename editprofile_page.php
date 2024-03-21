<?php
include("dataconection.php");
session_start();
$user_id = $_SESSION['id'];

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
    $result = mysqli_query($connect, "SELECT * FROM user WHERE ID='$user_id'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['edit_row'] = $row; // Storing the row data in session for the next page
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Profile</title>
</head>

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

    .container {
        padding-top: 90px;
        padding-left: 20px;
    }

    .welcome-message {
        margin-bottom: 20px;
        font-size: 18px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
        width: 300px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
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
<div class="container">
    <div class="welcome-message">
        <?php
        $resultlogin = mysqli_query($connect, "SELECT * from user WHERE ID='$user_id'");
        $log = mysqli_fetch_assoc($resultlogin);
        echo "WELCOME " . $log["NAME"];
        ?>
    </div>

    <form name="editfrm" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo isset($row['NAME']) ? $row['NAME'] : ''; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo isset($row['EMAIL']) ? $row['EMAIL'] : ''; ?>" disabled>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo isset($row['PASSWORD']) ? $row['PASSWORD'] : ''; ?>">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" value="<?php echo isset($row['PASSWORD']) ? $row['PASSWORD'] : ''; ?>">
        </div>

        <div class="form-group">
            <label for="contact_num">Contact Number:</label>
            <input type="text" name="contact_num" id="contact_num" value="<?php echo isset($row['PHONE_NUMBER']) ? $row['PHONE_NUMBER'] : ''; ?>">
        </div>

        <input type="submit" value="Update" name="editbtn" class="button">
    </form>
</div>
</body>
</html>

<?php
if (isset($_POST["editbtn"])) {
    $user_id = $_SESSION['id'];
    $NAME = $_POST["name"];
    $PASSWORD = $_POST["password"];
    $CONTACT_NUM = $_POST["contact_num"];

    mysqli_query($connect, "UPDATE user SET NAME='$NAME',
                                      PASSWORD='$PASSWORD',
                                      PHONE_NUMBER='$CONTACT_NUM'
                                      WHERE ID='$user_id'");

    ?>
    <script>
        alert("Record Saved!");
        window.location.href = 'landing_page.php';
    </script>
    <?php
    exit();
}
?>
