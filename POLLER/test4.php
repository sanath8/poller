<?php
error_reporting(0);
$GLOBALS['id']=$_GET['id'];
$id=trim($id," ");
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table="$id";
$mtable="master_table";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));
	 $sql1="SELECT * FROM $mtable WHERE table_id='$id'";
	 $result = mysqli_query($conn, $sql1);
 
	  if (mysqli_num_rows($result) >0) {
	$row = mysqli_fetch_array($result);
	
	$c=explode(',',$row["poll_opt"],$row["poll_no"]);
    // output data of each row
	
	}
	$no=$row["poll_no"];
	$sql1="SELECT * FROM $table ORDER BY SL DESC";
	 $result = mysqli_query($conn, $sql1);
	$row = mysqli_fetch_array($result);
	$total=$row["SL"];

$i=0;

while($i<$no)
{
	
	echo"<h6>".$c[$i]."</h6>";
	 $sql1="SELECT * FROM $table WHERE CHOICE='$c[$i]'";
	 $result = mysqli_query($conn, $sql1);
		while($row = mysqli_fetch_array($result)) {
	$count[$i]++;
	}
	$avg[$i]=($count[$i]/$total)*100;
	$avg[$i]=round($avg[$i],2); 
	echo"
	  <div class='progress'>
    <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width:".$avg[$i]."%'>
      <font color='black'>".$avg[$i]."%</font>
    </div>
  </div>
	</br>";
	$i++;
}



?>
