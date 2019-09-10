<?php
session_start();
if(isset($_SESSION['sess_username']))
//if(!isset($_SESSION['sess_user_id'])||(trim($_SESSION['sess_user_id'])==' '))
{
header("location:home.php");
exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<title>BetaStudy</title>
</head>
<body>
<div class="header">
				<a href="index.php">
                <div >
				Beta<span>Study</span>
				</div>
                </a>
			</div>
<div class="loreg">
<h1 >
Please <span><a href="login.php">Login</a></span> or <span><a href="register.php">register</a></span>
</h1>
</div>


</body>
</html>