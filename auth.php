<?php
function authVisit($authidtype){
	if($_SESSION["idtype"]!=$authidtype)
	{
		header("Location:portal.php");
	}
}
?>
