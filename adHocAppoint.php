<?php
session_start();
$conn=mysqli_connect("localhost","root","","entry1");

$visid="V".rand(0,10000);
$name=$_POST["vname"];
$password="password";

$ticid = "T".rand(0,10000);

$purpose = $_POST["purpose"];
$empid=explode(" ",$_POST["enames"],2)[0];
$date = $_POST["date"];

$aptTime = $_POST["time"].":00";
require_once("uploadPhoto.php");

$sqlr = "insert into register values('$visid','$name','$fileTmpName','$password')";
$sql = "insert into appointment values('$ticid','$visid','$purpose','$empid','$date','$aptTime','inTime','outTime','Pending')";
$msg = "";
if(mysqli_query($conn,$sqlr))
{
	$msg .= "Added to register<br>";
}
else
{
	$msg .= "Can't add to register".mysqli_error($conn)."<br>";
}
if(mysqli_query($conn,$sql))
	{
		$result = mysqli_query($conn,"select * from appointment where ticId='$ticid'");
	
		$thead="<table id='reg'><tr><th>Tic ID</th><th>Visitor Id</th><th>Purpose</th><th>Emp Id</th><th>date</th>";
		$thead.="<th>appTime</th><th>Status</th></tr>";
		$table="";
		while($row = mysqli_fetch_array($result))
		{
		$table.="<tr id='t$row[0]'>";
		for($i=0;$i<9;$i++){
			if($i==7 | $i==6) continue;
			$table.="<td>".$row[$i];
			$table.="</td>";
		}
		$table.="</tr>";
		}
		$table.="</table>";
		$msg.= "Your Appointment has been made (Ticket id:<b>'$ticid'</b>). Check the review portal to verify approval<br>";
		$msg.= "<a href='AppointmentVerifier.php'>Review Appointment Status</a><br>";
		$msg.= "<a href='portal.php'>Go back</a><br>";
		
	}
	
	else
	{
		$msg.="Appointment could not be made".mysqli_error($conn);
	}
?>
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
            <div> Markham Hospital</div>
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
