<?php
$host="localhost";
$user="root";
$pass="";
$conn = new mysqli($host,$user,$pass);
//check connection msq_li object oriented
if($conn->connect_error)
{
 die('Connection Failed'. $conn->connect_error);
}
else
	//echo "connection successful";

if(!mysqli_select_db($conn,"mini"))
{
  die("Can't select database");
}
else 
//echo "DAtabase selected";
?>