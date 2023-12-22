<?php
session_start();
require_once("auth.php");
authVisit("Receptionist");
require_once("search2.php");
if(isset($_POST["sub"]))
{
	$_POST["append"] = "<br><input type='button' name='ccl' value='Register'/>";
	$_POST["len"] = 10;
	$_POST["cstat"] = "Approved";
	$_POST["thead"] =	"<th>Ticket ID</th>".
						"<th>Visitor Id</th>".
						"<th>Name</th>".
						"<th>Photo</th>".
						"<th>Purpose</th>".
						"<th>Employee Name</th>".
						"<th>Employee Dept</th>".
						"<th>Date</th>".
						"<th>Appoint. Time</th>".
						"<th>Status</th>";
	$_POST["view"]="vwapt";
	
	switch($_POST["keytype"])
	{	
		case "Ticket Id":
		$_POST["cond"] = "ticId";
		break;
		case "Visitor Id":
		$_POST["cond"] = "visId";
		break;
	}
	
	searchV();
}


?>
<script>
window.onload = function(){
	buttons = document.querySelectorAll("#reg input");
	for(i=0;i<buttons.length;i++)
	{
		ticid = buttons[i].parentNode.parentNode.id;
		buttons[i].addEventListener("click",function(){action(ticid);});
		//buttons[i].style.backgroundColor = 'red';
	}
    console.log('The page has fully loaded');
};

setCDateTime = function(){

var tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds
var localISOTime = (new Date(Date.now() - tzoffset)).toISOString().slice(0, -1);
	d = localISOTime.split(/[T\.]/);
	//document.getElementsByName("date")[0].value=d[0];
	document.getElementsByName("time")[0].value=d[1];
}

var action = function(id){
	document.getElementsByName("tid")[0].value = id;
	setCDateTime();
	document.getElementById("rem").submit();
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
<h1>Appointment Verifier</h1>
<form method="post">
<label>Search By:</label>
<select name="keytype">
<option>Ticket Id</option>
<option>Visitor Id</option>
</select>
<br><br>
<input name="key" type="text"/>
<input name="sub" type="submit" value="search"/>
</form>
<div id="pres"><?php echo $table?></div>
<form id="rem" method="post" action="toReg.php">
<input name="tid" type="hidden" value=""/>
<input name="time" type="hidden" value=""/>
</form>
</div>
</body>