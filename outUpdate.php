<?php
session_start();
$conn=mysqli_connect("localhost","root","","entry1");

$ticid=$_POST["tid"];
$outTime=$_POST["exit"].":00";
$status = $_POST["done"];

$sql = "update appointment set outTime='$outTime',status='$status' where ticId='$ticid'";
if(mysqli_query($conn,$sql))
	{
		$result = mysqli_query($conn,"select * from appointment where ticId='$ticid'");
	
		$thead="<table id='reg'><tr><th>Tic ID</th><th>Vis Id</th><th>Purpose</th><th>Emp Id</th><th>date</th>";
		$thead.="<th>appTime</th><th>inTime</th><th>outTime</th><th>Status</th></tr>";
		$table="";
		while($row = mysqli_fetch_array($result))
		{
		$table.="<tr id='$row[0]'>";
		for($i=0;$i<9;$i++){
			$table.="<td>".$row[$i];
			$table.="</td>";
		}
		$table.="</tr>";
		}
		$table.="</table>";
		$msg = "Appointment Id '$ticid' has updated";
	}
	
	else
	{
		$msg = "An error has occurred.<br>";
		$msg.=mysqli_error($conn);
	}
?>
<html>
<head>
<link rel="stylesheet" href="css/style.css" />
<style>
<?php include "css/reg.css" ?>
</style>
</head>
<body>
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
            <a href="portal.php"><?php echo "Greetings, ".$_SESSION['name'] ?></a>
        </div>

    </header>
	
	<div class="content">
	<?php echo $thead.$table ?>
	<br>
	<div class="msg">
	<?php echo $msg?>
	</div>
	</div>
</body>
</html>

