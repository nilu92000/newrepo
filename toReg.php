<?php
session_start();
$conn=mysqli_connect("localhost","root","","entry1");

$ticid = $_POST["tid"];
$intime = $_POST["time"];
//echo $ticid;

$sql = "update appointment set inTime='$intime',status='Ongoing' where ticId='$ticid'";
if(mysqli_query($conn,$sql))
	{

		$msg = "Your Visit (Ticket id:<b>'$ticid'</b>) has been recorded<br>";
		$msg.= "<a href='portal.php'>Go back</a><br>";
	}
	
	else
	{
		$msg = "An error has occured.<br>";
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
            <div> Markham Hospital </div>
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
	<div class="msg">
	<?php echo $msg?>
	</div>
	</div>
</body>
</html>
