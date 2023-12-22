<?php
session_start();
require_once("auth.php");
authVisit("Employee");
$table="";

if(isset($_SESSION['id']))
{
	$data = $_SESSION['id'];
	$conn = mysqli_connect("localhost","root","","entry1");

	$sql="select * from appointment a inner join register r on r.id=a.visId where empId='$data' and status='Pending'";

	$result=mysqli_query($conn,$sql);
	$table = "<table id='reg'>
	<tr>
	<th>empId</th>
	<th>ticId</th>
	<th>visId</th>
	<th>name</th>
	<th>photo</th>
	<th>purpose</th>
	<th>date</th>
	<th>aptTime</th>
	<th>status</th>
	</tr>";
while($row=mysqli_fetch_array($result))
{
	$table.= "<tr>
	<td>".$row[3]."</td>
	<td>".$row['ticId']."</td>
	<td>".$row['visId']."</td>
	<td>".$row['name']."</td>
	<td><img src='uploads/".$row['photo']."'/></td>
	<td>".$row['purpose']."</td>
	<td>".$row['date']."</td>
	<td>".$row['aptTime']."</td>
			<td>".$row['status']."<br>
			<input type='button' value='Accept' onclick=\"response('".$row['ticId']."','Approved')\" /><br>
			<input type='button' value='Reject' onclick=\"response('".$row['ticId']."','Rejected')\" /></td>
			
	</tr>";
}
$table .= "</table>"; 
}
else
{
	header("Location:portal.php");
}

?>
<head>
<link rel="stylesheet" href="css/style.css" />
<style>
<?php include "css/reg.css" ?>
</style>
<script>
response = function(id,stat){
	document.getElementsByName("rid")[0].value = id;
	document.getElementsByName("stat")[0].value = stat;
	//alert(document.getElementsByName("stat")[0].value);
	document.getElementById('response').submit();
}
</script>
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
<h1>Pending Appointments</h1>
<?php echo $table ?>
<form id="response" action="responseEmp.php" method="post">
<input name="rid" type="hidden" value=""/>
<input name="stat" type="hidden" value=""/>
</form>
</div>
</body>