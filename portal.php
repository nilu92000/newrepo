<?php
session_start();
if(isset($_SESSION["id"]))
{
	switch($_SESSION["idtype"]){
	case "Visitor":
		header("Location:PortalVisitor.php");
		break;
	case "Employee":
		header("Location:PortalEmployee.php");
		break;
	case "Receptionist":
		header("Location:PortalGuard.php");
		break;
	}
}
else
{
	header("Location:login.php");
}
?>