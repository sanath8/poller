<!DOCTYPE html>
<?php
session_start();
if(!IsSet($_SESSION["user"]))
{
	include('login_poll.php');
	exit(0);

	
}
?>
<html lang="en">
<head>
  <title>Poller</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
	.color_header{
		      background-color: #ffffff;

	}
	.hint {
       background-color: linen;
  
    margin-left: 70px;
	    margin-top: -20px;

	    width:200px;

	word-wrap: break-word;

}

  </style>

 

</head>
<body>

<div class="container">
    
	   
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	        <a class="navbar-brand" href="#">Poller</a>

      <form class="navbar-form navbar-left">
      <div class="input-group">
 <input type="text" class="form-control" placeholder="Search people.." onkeyup="showHint(this.value)">
        
      </div>
    </form>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php?id=1">Home</a></li>
       
        <li><a href="create_poll.php">Create a poll</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
	   	          <div class="hint"> <span id="txtHint" ></span></div>

	   

<?php
$GLOBALS['id']=$_GET['id'];
$user=$_SESSION["user"];
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table="master_table";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));
	$sql="SELECT * FROM $table WHERE user_name='$user' ORDER BY sl DESC";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) >0) {
		$x=0;
		    while($row = mysqli_fetch_array($result)) {
				$x++;
			}
$no_polls = $x;  
    }
	$count=0;

		$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) >0) {

		$url="http://ibmmsrit.hol.es/poll/display.php?id=";
	echo"<div class='list-group'><a href='#' class='list-group-item active'>
	<h5>
	Here are your Polls ".$user."
	</h5></a>";
	$flag=0;
    // output data of each row
	if (mysqli_num_rows($result) >0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
		$count++;
		if(($count>($id-1)*4)&&($count<=4*$id))
		{
		$flag=1;

		$r=$row['table_id'];
		$link="$url$r";
		
		echo"<a href='$link'  class='list-group-item'><h6>".$row['poll_name']."</h6></a></br>";
		}
	}
	
	}
			}
	if($flag!=1)
		echo" <h4><small>*******No Polls created yet*******</small></h4>";
	echo"</div>";


$count=1;
$ser=($no_polls/4)+1;
echo"<ul class='pagination'>";
while($count<=$ser)
{
	if($count!=$id)
	echo"<li ><a href='home.php?id=".$count."'>".$count++."</a></li>";
	else
	echo"<li class='active'><a href='home.php?id=".$count."'>".$count++."</a></li>";

 
}	
echo"</ul><p>&copy sanath</p>";

?>

</div>

</body>
</html>
<script>

function showHint(str) {
				//document.getElementById("txtHint").innerHTML=str;

    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }


}

</script>
