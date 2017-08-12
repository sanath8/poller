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
$count=1;
	$sql1="SELECT * FROM $table ORDER BY SL DESC";
	 $result = mysqli_query($conn, $sql1);
	 echo"<table class='table table-striped'>
    <thead>
      <tr>
	          <th>Sl</th>

        <th>Name</th>
        <th>Vote</th>
      </tr>
    </thead>
	    <tbody>
";
 
	if (mysqli_num_rows($result) >0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
			$m_user=explode('*',$row["USER"],2);
			if($m_user[1]!="")
				$d_user=$m_user[1];
			else
				$d_user=$row['USER'];

		echo"<tr>
        <td>".$count++."</td>
		<td>".$d_user."</td>
		<td>".$row['CHOICE']."</td>
		</tr>";
		
	}
	}
	
	echo"</tbody>
  </table>";
	
?>
