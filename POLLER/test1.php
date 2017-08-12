<?php
$GLOBALS['id']=$_GET['id'];
$id=trim($id," ");
$com="com";
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$ctable="$id$com";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));


  $sql1="SELECT * FROM $ctable ORDER BY SL DESC ";
$result = mysqli_query($conn, $sql1);
 
	  if (mysqli_num_rows($result) >0) {
$row = mysqli_fetch_array($result);
    // output data of each row
	echo"<p><span class='badge'>".$row[SL]."</span> Comments:</p><br>
      
      <div class='row'>";
        $result = mysqli_query($conn, $sql1);

    while($row = mysqli_fetch_array($result)) {
            echo" 
        <div class='col-sm-10'><h4>".$row[NAME]." <small>".$row[DATEE]." ".$row[TIMEE]."</small></h4>  <p>".$row[COMMENT]."</p></br></div>";

	 }

	}
echo"</div>";


?>

     