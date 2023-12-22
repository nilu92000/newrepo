<?php 
$table="";
function searchV()
{
	GLOBAL $table;
	
	$append = $_POST["append"];
	$len = $_POST["len"];
	$cstat = $_POST["cstat"];
	$thead = $_POST["thead"];
	$view = $_POST["view"];
	$cond = $_POST["cond"];
	$key = $_POST["key"];
	
	$table .= "<table id='reg'><tr>".$thead."</tr>";
	
	$conn = mysqli_connect("localhost","root","","entry1");
	$sql = "select * from ".$view." where ".$cond." = '".$key."'";
	$result = mysqli_query($conn,$sql);
	
	
	
	while($row = mysqli_fetch_array($result))
	{
		$table.="<tr id='$row[0]'>";
		for($i=0;$i<$len;$i++){
			
			if($i == 3)
			{
				$table.="<td><img src='uploads//".$row[$i]."' /></td>";
				continue;
			}
			$table.="<td>".$row[$i];
			if($row[$i] == $cstat){
				$table.=$append;
			}
			$table.="</td>";
		}
		$table.="</tr>";
	}
	$table.="</table>";
}


?>