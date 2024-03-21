<?php
include("dataconection.php");
session_start();

//session_unset(); remove the data of all session variables

unset($_SESSION["id"]);//remove this data

session_destroy();

header("location:home_page.php");
?>