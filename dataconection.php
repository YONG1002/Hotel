<?php

$connect= mysqli_connect("localhost","root","","Homestay_Reservation_System");
//echo "Success Connected to Database";

if(!$connect)
{
	echo "not connected to database";
}
?>