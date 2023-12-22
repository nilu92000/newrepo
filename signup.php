<?php
session_start();
$msg = "";
if(isset($_POST["sub"]))
{
	$uid = $_POST["uid"];
	$name = $_POST["name"];
	$pass = $_POST["pass"];
	
	$conn = mysqli_connect("localhost","root","","entry1");
	$sql = "select * from register where id='$uid'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	if($row >0)
	{
		$msg = "Sorry, this user id is taken";
	}
	else
	{
		//$files = $_FILES["photo"];
		require("uploadPhoto.php");
		if($fileUpload)
		{
			$sql = "insert into register (id,name,photo,password) values ('$uid','$name','$fileTmpName','$pass')";
			
			if(mysqli_query($conn,$sql))
			{
				header("Location:login.php");
			}
			else{
				$msg = "Sorry, something went wrong";
			}
		}
		else{
			$msg = "Sorry, photo couldn't be uploaded";
		}
	}

}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Markham Hospital </title>
<style>
.sig{border: 3px solid black;width:45%;
margin-left:50px;
margin-top:20px;
 border-radius: 20px;
}
body{
background-image: url("img/back4.jpg");
background-repeat: no-repeat;
  background-size: 100%;
  
   background-opacity:0.5;
    background-attachment: fixed;
  background-position: center;
}
</style>
</head>

<link rel="stylesheet" href="css/style.css">


<body ontouchstart>
    <header class="header">

        <!-- left box for logo in navbar -->
        <div class="left">
            <img src="img/logo.png">
            <div>Markham Hospital </div>
        </div>

        <!-- mid box for buttons navbar -->
        <nav class="mid">
            <ul class="navbar">
                <li><a href="index.html">home</a></li>
                <li><a href="aboutus.html">about us</a></li>
                <li><a href="contactus.html">contact us</a></li>
                <li><a href="facilities.html">facilities</a></li>
				<li><a href="#">portal</a>
					<ul>
						<li><a href="PortalVisitors.html">for Vistors</a></li>
						<li><a href="PortalEmployee.html">for Employees</a></li>
						<li><a href="PortalGuard.html">for Receptionist</a></li>
					</ul>
				</li>
            </ul>
        </nav>

        <!-- right box for logo in navbar -->
        <div class="right">
            <input class="searchbar" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"> Search</button>
			<br>
            <a href="login.php">Login/Signup</a>
        </div>

    </header>

    <!--  Welcome to AAC - content  -->
	<div class="sig">
	<div class="content">
		
		<h1>Sign-up Page</h1>
		<br>
		<form method="post" enctype="multipart/form-data">
		<div class="sign">
		<table>
		<tr>
		<td>User ID</td>
		<td>
			<input type="text" name="uid" placeholder="Enter User Id" />
		</td>
		</tr>
		<tr>
		<td>Name</td>
		<td><input name="name" type="text" placeholder="Enter Your Name"></td>
		</tr>
		<tr>
		<td>Photo</td>
		<td><input name="photo" type="file"></td>
		</tr>
		<tr>
		<td>Password</td>
		<td><input name="pass" type="password" placeholder="Enter Your Password"></td>
		</tr>
		<td>Retype Password</td>
		<td><input name="repass" type="password" placeholder="ReEnter Your Password"></td>
		</tr>
		<tr>
		<td colspan=2><input type="submit" name="sub" value="Sign Up"></td>
		</tr>
		</table>
		</div>
		
		</form>
		<a href="login.php">Have an account? Login</a>
		<div><?php echo $msg?></div>
	</div>
	</div>
</body>

</html>