<?php
session_start();
require_once("auth.php");
authVisit("Receptionist");

$conn=mysqli_connect("localhost","root","","entry1");
$dname="select * from dept";
$sql="select id,name,deptid from emp";

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
	$option .= "<option class='".$arr[$row['deptid']]."'>".$row['id']." - ".$row['name']."</option>";
}
?>

<html>
<head>
<script>
var nodes;
setCDateTime = function(){

var tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds
var localISOTime = (new Date(Date.now() - tzoffset)).toISOString().slice(0, -1);
	d = localISOTime.split(/[T\.]/);
	document.getElementsByName("date")[0].value=d[0];
	document.getElementsByName("time")[0].value=d[1];
}

load = function(){
	nodes = document.getElementById('enames').childNodes;
	setCDateTime();
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
<h1>Onsite Appointment</h1>
<br>
<form style="text-align:center" action="adHocAppoint.php" method="post" enctype="multipart/form-data">
<table style="margin:auto">
<tr>
	<td>Name</td>
	<td><input type="name" name="vname"></td>
</tr>
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
	<td>Photo</td>
	<td><input type="file" name="photo"></td>
</tr>
<tr>
	<td colspan="2" style="text-align:center"><input type="submit" value="Submit" name="sub" onmousedown="setCDateTime()"></td>
</tr>
</table>
<input type="hidden" name="date" value="1980-01-01">
<input type="hidden" name="time" value="">

</form>
</div>
</body>
</html>