
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<script type="text/javascript">
			
function FormValidation()
			{
				var result=true;
				var x=document.forms["cnfrmpassform"]["cnfrmemail"].value;
				var y=document.forms["cnfrmpassform"]["password"].value;
				var z=document.forms["cnfrmpassform"]["cnfrmpass"].value;
			if(x==null||y==null||z==null||x==''||z==''||y=='')
			{
				alert("Fields can't be empty");
			    result=false;
			}
			
			if(y!=z)
			{

				alert("Password Doesn't Match");
				result=false;
			}
		
				return result;
			}


</script>	
	<title></title>
</head>
<body>
<div class="header">
				<a href="index.php">
                <div >
				Beta<span>study</span>
				</div>
                </a>
			</div>
</body>
</html><?php
include "connection.php";

if(!empty($_POST['password'])&&!empty($_POST['cnfrmpass'])&&!empty($_POST['cnfrmemail'])):

	$cnfrmemail=$_POST['cnfrmemail'];
  $password = $_POST['password'];
  $cnfrmpass = $_POST['cnfrmpass'];
 $query=" SELECT * FROM `users` WHERE  email='$cnfrmemail'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==0)
{
 //echo 'ERROR:num_rows';
 
 }

$userdata= mysqli_fetch_array($result);

if(!($userdata))
{
	echo "Wrong Username";
//echo 'ERROR:fetch_array';
}

else  if($password!=$cnfrmpass)
  {
  	echo "<h6>Password Doesn't Match</h6>";

  }
  else
  {	
  	$q="UPDATE `users` SET password='$password' WHERE email='$cnfrmemail'";
  		if (!mysqli_query($conn,$q))
        {
            die('Error: ' . mysqli_error($conn));
            }
  		else
  			echo "Data Updated";
  
	}
endif;

if(!empty($_POST['email'])):

	$email=$_POST["email"];

$query=" SELECT * FROM `users` WHERE  email='$email'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==0)
{
 //echo 'ERROR:num_rows';
 }

$userdata= mysqli_fetch_array($result);

if(!($userdata))
{
//echo 'ERROR:fetch_array';	
echo "No user Found"	;
}
else
{	echo "<br/>";
	echo "<p>User Found<p>";

	echo '
		<form name="cnfrmpassform" method="post" action="resetpassvalidate.php" onsubmit="return FormValidation()">
				
				
				<input type="text" name="cnfrmemail" id="cnfrmemail" placeholder="Enter Confirm Email" class="format">	
				<input type="password" name="password"  id="pass" placeholder="New Password" class="format">
				<input type="password" name="cnfrmpass"  id="cnfrmpass" placeholder="Confirm Password" class="format">
				<input type="submit" value="Reset_Password">
				';

	}
endif;
if(empty($_POST['email'])&&empty($_POST['cnfrmemail']))
{	header("Location:ResetPass.php");
}


?>