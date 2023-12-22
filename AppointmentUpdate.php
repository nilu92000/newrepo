<?php
session_start();
require_once("auth.php");
authVisit("Receptionist");
require_once("search2.php");
if(isset($_POST["sub"]))
{
	$_POST["append"] = "<br><input type='button' name='upd' value='Update'/>";
	$_POST["len"] = 11;
	$_POST["cstat"] = "Ongoing";
	$_POST["thead"] =	"<th>Ticket ID</th>".
						"<th>Visitor Id</th>".
						"<th>Name</th>".
						"<th>Photo</th>".
						"<th>Purpose</th>".
						"<th>Employee Name</th>".
						"<th>Employee Dept</th>".
						"<th>Date</th>".
						"<th>Appoint. Time</th>".
						"<th>In Time</th>".
						"<th>Status</th>";
	$_POST["view"]="vwaptin";
	
	$_POST["cond"] = "ticId";
	
	searchV();
}

?>
<script>
window.onload = function(){
	buttons = document.querySelectorAll("#reg input");
	for(i=0;i<buttons.length;i++)
	{
		ticid = buttons[i].parentNode.parentNode.id;
		buttons[i].addEventListener("click",function(){change(ticid);});
		//buttons[i].style.backgroundColor = 'red';
	}
    console.log('The page has fully loaded');
};

var change = function(id){
	nlist = document.getElementById(id).innerHTML;
	document.getElementById("reg").innerHTML = "<?php echo $_POST['thead']?>" + "<tr>"+nlist+"</tr>";
	document.getElementById("update").style.display = "block";
	document.getElementsByName("tid")[0].value = id;
}
</script>
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
<h1>Appointment Update</h1>
<form method="post">
<input name="key" type="text" placeholder="Search by Ticket Id"/>
<input name="sub" type="submit" value="search"/>
</form>
<div id="pres"><?php echo $table?></div>


<form id="update" style="text-align:center;display:none;margin:1em;" method="post" action="outUpdate.php">
<table style="margin:auto">
<input type="hidden" name="tid" />
<tr>
	<td>Exit time</td>
	<td><input type="time" name="exit"></td>
</tr>
<tr>
	<td>Purpose Fulfilled</td>
	<td>
		<input type="radio" value="Complete" name="done">Yes<br>
		<input type="radio" value="Ineffective" name="done">No
	</td>
</tr>
<tr>
	<td colspan="2" style="text-align:center"><input type="submit" value="Submit"></td>
</tr>
</table>

</form>
</div>
</body>