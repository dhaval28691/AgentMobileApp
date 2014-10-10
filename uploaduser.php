<?php
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage1']['tmp_name'])) {
$sourcePath = $_FILES['userImage1']['tmp_name'];
//$base_url=$_SERVER['SERVER_NAME'];
//$targetPath = $base_url."/kup/uploadimages/".$_FILES['userImage']['name'];
$targetPath ="uploadimages/".$_FILES['userImage1']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
	echo $targetPath;
?>


<?php
}
}
}
?>