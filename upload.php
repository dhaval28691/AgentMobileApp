<?php
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
//$base_url=$_SERVER['SERVER_NAME'];
//$targetPath = $base_url."/kup/uploadimages/".$_FILES['userImage']['name'];

//$targetPath ="uploadimages/".$_FILES['userImage']['name'];
//$targetPath="http://sghomey.com/admin/propertyimages_upload/".$_FILES['userImage']['name']; 

////ftp connection to move files..............
$ftp_server = "itwsprojects.com";
$ftp_user_name = "itwsprojects";
$ftp_user_pass = "vkW%NK%rIxE[";
//$file = $tmp_name;
$file=$sourcePath;
$remote_file = "/public_html/AgentMobileApp/property/propertyimagesupload/".$_FILES['userImage']['name'];

// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// upload a file
if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
// echo "successfully uploaded $file\n";
 echo $_FILES['userImage']['name'];
} else {
 //echo "There was a problem while uploading $file\n";
}

// close the connection
ftp_close($conn_id);



//if(move_uploaded_file($sourcePath,$targetPath)) {
	//echo $targetPath;
	//echo $_FILES['userImage']['name'];
?>


<?php
//}
}
}
?>