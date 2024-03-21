<?php

include ("dataconection.php");
session_start();

$result = mysqli_query($connect,"SELECT * from admin");
if(isset($_GET["download"]))
{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Admin List.xlsx");
}

if(isset($_GET['delete']))
	{
		$admin_ID=$_GET['id'];
		mysqli_query($connect,"DELETE FROM admin WHERE ID='$admin_ID'");
		?>
		<script>
		alert("Record deleted!");
		location.assign("adminlist_page.php");
		</script>
		<?php
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Admin List</title>
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
		
		table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        
        th {
            background-color: #FFA500;
            color: #fff;
            font-weight: bold;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
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

<div style="padding-top: 90px; padding-left: 20px;">
	<?php 
$resultlogin = mysqli_query($connect,"SELECT * from admin WHERE ID='$admin_id'");
$log=mysqli_fetch_assoc($resultlogin);
echo "WELCOME ".$log["NAME"];
?>

<form>
<table>
<thead>
	<tr>
		<th>Admin_ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Password</th>
		<?php 
		if (!isset($_GET["download"])) 
		{
			?>
			<th></th>
			<th></th>
			<?php 
		}
		?>
	</tr>
</thead>
<?php
while($row=mysqli_fetch_assoc($result))
{
?>
<tbody style="border: 1px solid black">
	<tr>
		<td style="border: 1px solid black" style="border: 1px solid black" class="align-middle text-center">
		<?php echo  $row['ID']; ?>
		</td>
		
		<td style="border: 1px solid black" style="border: 1px solid black" class="align-middle text-center">
		<?php echo  $row['NAME']; ?>
		</td>
		
		<td style="border: 1px solid black" style="border: 1px solid black" class="align-middle text-center">
		<?php echo  $row['EMAIL']; ?>
		</td>
		
		<td style="border: 1px solid black" style="border: 1px solid black" class="align-middle text-center">
		<?php echo  $row['PASSWORD']; ?>
		</td>
		
		<?php 
			if (!isset($_GET["download"])) 
			{
				?>
				<td style="border: 1px solid black" >
				<a href="editadmin_page.php?edit&id=<?php echo $row['ID'];?>">Edit </a>
				</td>
				
				<td style="border: 1px solid black" >
				<a href="adminlist_page.php?delete&id=<?php echo $row['ID'];?>" onclick="return confirmation()"> Delete </a>
				</td>
				<?php 
			}
		?>
	</tr>
</tbody>
<?php
}
?>
</table>

<a href="signup_page.php">Add New Admin</a>

<p>
<input type="submit" value="Download" name="download" class="button"/>
</p>

</form>

</div>

</body>
</html>
