<?php
session_start();
if(isset($_POST["sub"]))
{
	$conn = mysqli_connect("localhost","root","","entry1");
	
	echo $_POST["idtype"];
	switch($_POST["idtype"]){
		case "Visitor":
			$sql = "select * from register where id='".$_POST["id"]."'and password='".$_POST["pass"]."'";
			break;
		case "Employee":
			$sql = "select * from emp where id='".$_POST["id"]."'and password='".$_POST["pass"]."'";
			break;
		case "Receptionist":
			$sql = "select * from emp where id='".$_POST["id"]."'and password='".$_POST["pass"]."'and deptId='000'";
			break;
	}
	
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	
	if($row>0)
	{
		$_SESSION["id"]=$_POST["id"];
		$_SESSION["idtype"] = $_POST["idtype"];
		$_SESSION["name"] = $row["name"];
		header("Location:portal.php");
	}
	else
	{
		header("Location:login.php");
	}
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 
	Markham Hospital
	</title>
<style>
.log{border: 3px solid black;width:45%;
margin-left:50px;
margin-top:20px;
 border-radius: 25px;
}
body{
background-image: url("img/back1.jpg");
background-repeat: no-repeat;
  background-size: cover;
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
                <li><a href="index.html" class="active">home</a></li>
                <li><a href="aboutus.html">about us</a></li>
                <li><a href="contactus.html">contact us</a></li>
                <li><a href="facilities.html">facilities</a></li>
				<li><a href="#">portal</a>
					<ul>
						<li><a href="PortalVisitor.php">for Vistors</a></li>
						<li><a href="PortalEmployee.php">for Employees</a></li>
						<li><a href="PortalGuard.php">for Receptionist</a></li>
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

    <!--  Welcome to Markham Hospital - content  -->
	<div class="log">
	<div class="content">
		<h1>Login Page</h1>
		<br>
		<form method="post">
		<table >
		<tr>
		<td>Login as</td>
		<td>
			<select name="idtype">
				<option>Visitor</option>
				<option>Employee</option>
				<option>Receptionist</option>
			</select>
		</td>
		</tr>
		<tr>
		<td>Login Id</td>
		<td><input name="id" type="text"></td>
		</tr>
		<tr>
		<td>Password</td>
		<td><input name="pass" type="password"></td>
		</tr>
		<tr>
		<td colspan=2><input type="submit" name="sub" value="Login"></td>
		</tr>
		</table>
		
		</form>
		<a href="signup.php">Sign up as Visitor</a>
	</div>
	</div>
</body>

</html>