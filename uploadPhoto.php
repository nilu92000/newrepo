<?php

// Config
$currentDirectory = getcwd();
$uploadDirectory = "\\uploads\\";
$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
$fileLimitMb = 5; // File limit in MB
$uploadOk = true;

$fileName = $_FILES['photo']['name'];
$fileSize = $_FILES['photo']['size'];
$fileTmpFullPath  = $_FILES['photo']['tmp_name'];
$fileType = $_FILES['photo']['type'];
$fileExtension = explode('.',$fileName);
$fileExtension = strtolower(end($fileExtension));
//$fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
$fileTmp = explode("\\",$fileTmpFullPath);
$fileTmp = end($fileTmp);
$fileTmp = explode('.',$fileTmp)[0];

$fileTmpName = $fileTmp.".".$fileExtension;
$uploadPath = $currentDirectory . $uploadDirectory .$fileTmpName; 

if ($fileSize > ($fileLimitMb * 100000)) {
	echo "File must be less than" . $fileLimitMb . "MB.";
	$uploadOk = false;
}

if ($uploadOk == false) {
	$msg = "Photo couldn't be uploaded. Please check file size";

} else {
	$fileUpload = move_uploaded_file($fileTmpFullPath, $uploadPath);
	}


?>