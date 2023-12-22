<?php
session_start();
require_once("auth.php");
authVisit("Visitor");

$conn=mysqli_connect("localhost","root","","entry1");
$dname="select * from dept";
$sql="select id,name,deptId from emp";

$result = mysqli_query($conn,$sql);
$dres = mysqli_query($conn,$dname);

$option = "";$doption = "";
while($row = mysqli_fetch_array($dres))
{
	$doption .= "<option>".$row['name']."</option>";
	$arr[$row['id']]=$row['name'];
}

while($row = mysqli_fetch_array($result))
{
	$option .= "<option class='".$arr[$row['deptId']]."'>".$row['id']." - ".$row['name']."</option>";
}
?>

<html>
<head>
<script>
var nodes;
load = function(){
	nodes = document.getElementById('enames').childNodes;
}

dchange = function(){
	var cdept = document.getElementById('dnames').value;
	for(i=0;i<nodes.length;i++)
	{
		nodes[i].style.display = (cdept === nodes[i].getAttribute("class"))?'block':'none';
	}
}
</script>
<link rel="stylesheet" href="css/style.css" />
<style>
<?php include "css/reg.css" ?>
</style>
</head>
<body onload="load()">
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
<h1>Visitor's Appointment Form</h1>
<br>
<form style="text-align:center" action="makeAppoint.php" method="post">
<table style="margin:auto">
<tr>
	<td>Purpose</td>
	<td><input type="name" name="purpose"></td>
</tr>
<tr>
	<td>Employee Department</td>
	<td>
	<select id="dnames" onchange="dchange()" name="dnames">
	<?php echo @$doption?>
	</select>
	</td>
</tr>
<tr>
	<td>Employee Name</td>
	<td><select id="enames" name="enames"><?php echo @$option?></select></td>
</tr>
<tr>
	<td>Date</td>
	<td><input type="date" name="date"></td>
</tr>
<tr>
	<td>Time</td>
	<td><input type="time" name="time"></td>
</tr>
<tr>
	<td colspan="2" style="text-align:center"><input type="submit" value="Submit" name="sub"></td>
</tr>
</table>

</form>
</div>

</body>
</html>