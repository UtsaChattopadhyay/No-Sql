<?php
session_start();
if(!isset($_SESSION['sess_username'])||(trim($_SESSION['sess_username'])==' '))
//if(!isset($_SESSION['sess_user_id'])||(trim($_SESSION['sess_user_id'])==' '))
{
header("location:index.php");
exit();
}

?>

<!DOCTYPE html>
<html>
<head>

			<link rel="stylesheet" type="text/css" href="CSS/style.css">

	<title>Homepage</title>
</head>
<body>
<div class="header">
				<a href="index.php">
                <div >
				Beta<span>study</span>
				</div>
                </a>
			</div>
<h1 style="text-align:center;font-size:50px;">Welcome <span style="color:green;"><?php echo $_SESSION['sess_user']?></span></h1>
<?php include("connection.php"); 
$emailid=$_SESSION['sess_username'];
$query=" SELECT * FROM users WHERE email='$emailid'";
//$id=$_SESSION['sess_user_id'];
//$query=" SELECT * FROM users WHERE Id=$id";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==0)
{
 echo 'num_rows';
}
$userdata= mysqli_fetch_array($result);
if(! $userdata)
{
echo 'fetch_array';
}

 ?>
 <div id="details">
<ul type="none">
<li>Full Name: <?php echo $userdata['name'];?> </li>
<li>Email: <?php echo $userdata['email'];?> </li>
<li>Contact No: <?php echo $userdata['contact_no'];?> </li>
<li>Gender: <?php echo $userdata['Gender'];?> </li>
<li>Password: <?php echo $userdata['password'];?> </li>

<br/><br/>



</div>
<div>
<a href="logout.php">Logout
</a>
</div>

</body>
</html>
