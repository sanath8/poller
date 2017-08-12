<!DOCTYPE html>
<?php
$GLOBALS['id']=$_GET['id'];
session_start();
if(!IsSet($_SESSION["user"]))
{
	$_SESSION["ser"]=$id;
	include('login_poll.php');
	exit(0);

	
}
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table='master_table';
$user=$_SESSION["user"];
$table_id=$id;
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));
$sql1="SELECT * FROM $table WHERE table_id='$table_id'";
$result = mysqli_query($conn, $sql1);
 
	  if (mysqli_num_rows($result) >0) {
	$row = mysqli_fetch_array($result);
	
	$c=explode(',',$row["poll_images"]);
	 $limit=sizeof($c);
	 if($limit>=4)
	 {
		 echo"<h5>maximimum limit reached...cannot upload more images<h5>";
		 exit(0);
	 }
	 else
	 {
		 $com=",";

		 if($limit===1)
		 {
			 			 $file=$_FILES['fileToUpload']['name'];

			$updated_image_data="$com$file";
		 }
		 else
		 {
			 $old_file=$row['poll_images'];
			 $file=$_FILES['fileToUpload']['name'];
			$updated_image_data="$old_file$com$file";
			 
		 }
	 }
    // output data of each row
	
	}


$target_dir = $_SERVER['DOCUMENT_ROOT']."/poll/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2500000) {
    echo "Sorry, your file is too large please make sure it does not exceed 2.5mb.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		
		$mysqli="UPDATE  `u452701521_poll`.`master_table` SET  `poll_images` =  '$updated_image_data' WHERE   `master_table`.`sl` =$row[sl]";

if(!mysqli_query($conn,$mysqli))
    die(mysqli_error($conn));


        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$link="Location: http://ibmmsrit.hol.es/poll/display.php?id=";
	$url="$link$table_id";
	header($url);
		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
