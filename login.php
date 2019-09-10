<?php

session_start();

if(isset($_SESSION['sess_username']))
//if(!isset($_SESSION['sess_user_id'])||(trim($_SESSION['sess_user_id'])==' '))
{
header("location:home.php");
exit();
}


include "connection.php";
if(!empty($_POST['uname'])&&!empty($_POST['password'])):

	$email=$_POST["uname"];
	$pass=$_POST["password"];

$query=" SELECT * FROM `users` WHERE  email='$email'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==0)
{
 die( 'ERROR:num_rows');
 }

$userdata= mysqli_fetch_array($result);

if(!($userdata))
{
die('ERROR:fetch_array');
}


if($pass != $userdata['password'])
{

	//alert("Wrong Password");
  $error="<p>Wrong Password</p>";


}
else
{	$error="";
	session_regenerate_id();
 	$_SESSION['sess_user_id']= $userdata['Id'];
 	$_SESSION['sess_username']= $userdata['email'];
	$_SESSION['sess_user']= $userdata['name'];
	session_write_close();
    header('Location:home.php');
    mysqli_close($conn);
	//echo "Successfully Logged IN";
	//header("Location:home.php");
}
//header("Location:home.php");
endif;
?>

<!DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<title>
			Login
		</title>
		<script type="text/javascript">
			function FormValidation()
			{
				var result=true;
				var x=document.forms["loginform"]["uname"].value;
				var y=document.forms["loginform"]["password"].value;
			if(x==''||x==null||y==''||y==null)
			{
				alert("Fields can't be empty");
			    result=false;
			}
			
				return result;
			}




		</script>
	</head>
	<body>
		<div class="header">
				<a href="index.php">
                <div >
				Beta<span>study</span>
				</div>
                </a>
			</div>
		<h1 >Login
		</h1>
		<span>or <a href="register.php">Register</a> here</span>
		<div >
			<form name="loginform" method="post" action="login.php" onsubmit="return FormValidation()">
				
				
				<input type="text" name="uname" placeholder="Enter Your Email" class="format">
					
				<input type="password" name="password"  placeholder="And Password" class="format"><span><?php if(isset($error)) echo $error?></span>
					
				<input type="submit" value="Login">
				<br/>	
				<div><a href="ResetPass.php"> Forgot Password  ?? </a> </div><br/>
 				
					
			</form>
		</div>
	</body>
</html>