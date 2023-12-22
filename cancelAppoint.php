<?php
$conn=mysqli_connect("localhost","root","","entry1");

$ticid = $_POST["tid"];
//echo $ticid;

$sql = "delete from appointment where ticId='$ticid'";
if(mysqli_query($conn,$sql))
	{

		$msg = "Your Appointment (Ticket id:'$ticid') has been cancelled<br>";
		$msg.= "<a href=#>Review Appointment Status</a><br>";
		$msg.= "<a href=#>Go back</a><br>";
		
		echo $msg;
	}
	
	else
	{
		echo "Not Ok";
		echo "<div class='div1'>".mysqli_error($conn)."</div>";
	}
?>
