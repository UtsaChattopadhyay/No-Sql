<?php 
include"connection.php";
mysqli_close($conn);
session_start(); 

session_destroy(); 
?>
<html>
<head>
<title>Logout</title>
</head>
<div style='top:100px;'>Logout Successful <a href='login.php'><u>click here to continue<u></a>
</div>
</html>



 
