<?php
        
    session_start();   

if(isset($_SESSION['sess_username']))
//if(!isset($_SESSION['sess_user_id'])||(trim($_SESSION['sess_user_id'])==' '))
{
header("location:home.php");
exit();
}


    include "connection.php";
    if(isset($_POST['submitbutton'])):

        if(empty($_POST['name'])||empty($_POST['email'])||empty($_POST['contact_no'])||empty($_POST['password'])||empty($_POST['gender']))
            {
                $error= "Fill the required Fields"; 
                if(empty($_POST['name']))
                {
                    $nameerror="<p>*Please Enter Name</p>";
                    }
                else
                { 
                    if(!preg_match("/^[a-zA-Z ]*$/", $_POST['name']))
                    {
                        $nameerror="<p>*Only Letters and WhiteSpaces are allowed</p>";
                    }
                    else
                            $nameerror="";
                    

                }

                if(empty($_POST['email']))
                {
                    $emailerror="<p>*Please Enter Email</p>";
                    }
                else  
                {
                    if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
                    {

                    $emailerror="<p>*Invalid Email</p>";
                        
                    }
                    else
                    $emailerror="";
                      

                }    
                
                if(empty($_POST['contact_no']))
                {
                    $contacterror="<p>*Please Enter Contact_no</p>";
                    }
                else
                {   echo $contact_error;
                    if(!preg_match("/^[1-9]{1}[0-9]{9}$/", $_POST['contact_no']))
                    {
                       $contacterror="<p>*Only Digits are Allowed</p>";
                    }
                    else  
                    {
                        $contacterror="";
                    }
                          
                    
                        
                }

                   if(empty($_POST['password']))
                {
                    $passworderror="<p>*Please Enter Password</p>";
                    }
                    else
                        $passworderror="";
                        

                   if(empty($_POST['gender']))
                    {
                    $gendererror="<p>*Please Enter Gender</p>";

                    }
                    else
                    {
                     $gendererror="";                   
                    }
                            
            }

    else
      {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact_no=$_POST['contact_no'];
        $password=$_POST['password'];
        $gender=$_POST['gender'];
        if(($name=='')||($email=='')||($contact_no=='')||($password=='')||($gender==''))
            { die("Cannot Insert NULL values");}
        $sql="INSERT INTO users (name,email,contact_no,gender,password) VALUES ('$name','$email','$contact_no','$gender','$password')";
        if (!mysqli_query($conn,$sql))
        {
            die('Error: ' . mysqli_error($conn));
            }
        else
        {
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

    session_regenerate_id();
    $_SESSION['sess_user_id']= $userdata['Id'];
    $_SESSION['sess_username']= $userdata['email'];
    $_SESSION['sess_user']= $userdata['name'];
    session_write_close();
    header('Location:home.php');
    //mysqli_close($conn);

        }

      
}






endif;
?>
<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" type="text/css" href="CSS/style.css">
			<style type="text/css">
                #name_error,#email_error,#contact_error,#password_error,.error
                    {
                       
                        color:red;

                    }
            </style>
            <title>Register</title>
            <script type="text/javascript">
                
                
                //document.write("Hello");
                var Invalid=0;
                function validation()
                { 
                    Invalid = 0;
                

                    //Name of User
                    var nam=/^[A-Za-z]+$/;
                    var txtName=document.getElementById("name");

                    if(nam.test(txtName.value)==false)                   
                
                    {   
                        document.getElementById("name_error").innerHTML="*Invalid Name";
                        Invalid += 1;
                    }
                    else
                       {
                        document.getElementById("name_error").innerHTML="";
                        
                        }
                    //Email
                    var x=document.forms["myForm"]["email"].value;
                    var atpos=x.indexOf("@");
                    var dotpos=x.lastIndexOf(".");
                    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
                    {
                      //  alert("Not a valid e-mail address");
                        document.getElementById("email_error").innerHTML="*Invalid Email";
                        Invalid += 1;
                    
                    }
                    else
                       {
                        document.getElementById("email_error").innerHTML="";
                        }
                        
                  //Contact_no
                    var mob = /^[1-9]{1}[0-9]{9}$/;
                    var txtMobile = document.getElementById("contact_no");
                    if (mob.test(txtMobile.value) == false) 
                    {
                        //alert("Please enter valid mobile number.");
                    
                        document.getElementById("contact_error").innerHTML="*Invalid Contact No";
                        if(txtMobile.value.length<10)
                              document.getElementById("contact_error").innerHTML="*Invalid Contact No There must be 10 digits";
                            
                        Invalid += 1;
                    
                    }
                    else
                       {
                        document.getElementById("contact_error").innerHTML="";
                        }

                    
                    //Password


                    if(document.getElementById("password").value=='')
                    {
                        document.getElementById("password_error").innerHTML=" Password must be atleast 6 characters";
                        Invalid += 1;
                    
                    }
                    else
                       {
                        document.getElementById("password_error").innerHTML="";
                        }


              
                                           
                    if(Invalid!=0)
                        {
                         return false;
                        }
                    else 
                        {
                          return true;
                           }
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
			<h1 >
				Register 
			</h1>
			<span>Already Registered <a href="login.php">Login </a>here</span>
			
            <br/>
            <div id="phperr"</div>
           <?php  if(isset($error))
                 
                 echo "<br/>".$error;
                 ?>
            </div>
				<form name="myForm" method="post" action="register.php" onSubmit="return validation()">
          			<table>
                        <tr>
                            <td>
                                <label>Name<sup>*</sup>: </label>
                            </td>
                            <td>
                                <input class="format2" type="text" id="name" size="50" name="name"  maxlength="50" placeholder="Enter Your Name"  />
							</td>
                            <td>
                                <span class="error"><?php if(isset($_POST['name'])) echo $nameerror;?></span>
                                <p id="name_error"> </p>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <label>Email<sup>*</sup>:   </label>
                            </td>
                            <td>
                                <input class="format2" type="text" size="50" name="email" id="email" maxlength="50" placeholder="abcd@example.com" />
                            </td>
                            <td>
                                <span class="error"><?php if(isset($_POST['email'])) echo $emailerror;?></span>
                                <p id="email_error">  </p>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <label>Contact No<sup>*</sup>:   </label>
                            </td>
                            <td>
                                <input class="format2" type="text" name="contact_no" id="contact_no" size="50" maxlength="10" placeholder="Mobile No."  />
                            </td>
                            <td>
                                <span class="error"><?php if(isset($_POST['contact_no'])) echo $contacterror;?></span>
                                <p id="contact_error">  </p>
                            </td>
                            
                        </tr>
                      
                        <tr>
                            <td>
                                <label>Password<sup>*</sup>:   </label>
                            </td>
                            <td>
                                <input class="format2" type="password" size="50" name="password" id="password" minlength="6" maxlength="16" placeholder="***********"  />
                            </td>
                            <td>
                                <span class="error"><?php if(isset($_POST['password'])) echo $passworderror;?></span>
                                <p id="password_error">  </p>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>                            
                            	<label>Gender:   </label>
                            </td>
                        	<td>
                        		<input type="radio" name="gender" value="male" id="male" checked/> Male
								<input type="radio" name="gender" value="female" id="female"/> Female
							</td>
                            <td>
                                <span class="error"><?php if(isset($_POST['gender'])) echo $gendererror;?></span>
                                <p id="gender_error">  </p>
                            </td>
                            
                        </tr>
                        <tr>
                           <td>                             
                           </td>
                            <td >
                                <input type="submit" value="Register" name="submitbutton"/>
                            </td>
                        </tr>
                    </table>
               </form>
            </div>
        </body>
	</html>