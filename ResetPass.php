<!DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<title>
			Reset Password
		</title>
		<script type="text/javascript">
			function FormValidation()
			{
				var result=true;
				var x=document.forms["forgotform"]["email"].value;

			if(x==''||x==null)
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
		</div>
		<h1 >Reset Password
		</h1>
		<span>or <a href="register.php">Register</a> here</span>
		<span>or <a href="login.php">Login </a>here</span>
		<div >
	     		<form name="forgotform" method="post" action="resetpassvalidate.php" onsubmit="return FormValidation()">
				
				<input type="text" name="email" placeholder="Enter Email" class="format">
					
					
				<input type="submit" name="verifyemail" value="Verify Email">
	
					
			</form>
		</div>
	</body>
</html>