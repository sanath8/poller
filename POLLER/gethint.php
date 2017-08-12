<?php
// Array with names
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table="login_table";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));

$sql="SELECT * FROM $table";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) >0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
		$a[]=$row['user_name'];
		}
	
	}



// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint[] = $name;
            } else {
                $hint[]=$name;
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
if($hint==="")
	echo"no suggestion";
else
{
	$arrlength=count($hint);
	for($x=0;$x<$arrlength;$x++)
  {

  echo "<a href='http://ibmmsrit.hol.es/poll/other_user.php?ido=".$hint[$x]."&id=1'><code><font size='4 px'>".$hint[$x]."</font></code></a>";
  	    echo "<br>";

  }
	
}

?>