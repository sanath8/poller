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
        <li><a href="home.php?id=1">Home</a></li>
       
        <li class="active"><a href="create_poll.php">Create a poll</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
	   	          <div class="hint"> <span id="txtHint" ></span></div>

	   
<body>
    <script>
function myFunction() {
var f="poll";
var i=0;
var limit=<?php
if(isSet($_POST['sub_1']))
echo$_POST['num'];
else
	echo"-1";
?>;
	    var y = document.getElementById("p_name");

	for(i=1;i<=limit;i++)
    {
    var x = document.getElementById(f+i);
 var str = x.value; 
    var n = str.search("'");
    if(n!=-1)
    {
    alert("please do not use Apostrophe for any field");
	return false;
    }
	else{
		     n = str.search(",");
			if(n!=-1)
			{
			alert("please do not use comma for choices");
			return false;
			}
		
		
		}
		
    }
	
	var str_name = y.value; 
    var n_name = str_name.search("'");
    if(n_name!=-1)
    {

    alert("please do not use Apostrophe for any field");
	return false;

    }
	return true;
}
	
	
		function validation()
{
		if(isAlphabet()){
			return true;
		
		}
		return false;
}
function isAlphabet(){
var elem=document.forms["myForm"]["num"];
   var elen=document.getElementById("num").value;

	var alphaExp = /^[0-9]+$/;
   //var res = elen.split("*");
  // var part=res.length;

	if(elem.value.match(alphaExp)){
return true;
	}
	else{
		alert("only numbers can be entered");
		elem.focus();
		return false;
	}
}


	
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




<?php
if(isSet($_POST['sub_2']))
{
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table='master_table';

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));
$poll_no=$_POST['p_n'];
$usr=$_SESSION["user"];
$time=date("h:i:sa");
$date=date("d/m/Y");
$p_name=$_POST['p_name'];
$p_no=$_POST['p_n'];
$com=",";
$poll="poll";
$choices=$_POST['poll1'];
for($i=2;$i<=$p_no;$i++)
{
$id="$poll$i";
$choices="$choices$com$_POST[$id]";	
}
	
	$mysqli="INSERT INTO $table (user_name,poll_name,poll_no,poll_opt,date,time) VALUES('$usr','$p_name','$p_no','$choices','$date','$time')";

if(!mysqli_query($conn,$mysqli))
    die(mysqli_error($conn));
$sql1="SELECT * FROM $table WHERE user_name='$usr' ORDER BY sl DESC ";
$result = mysqli_query($conn, $sql1);
 
	  if (mysqli_num_rows($result) >0) {
$row = mysqli_fetch_array($result);
	  }    // output data of each row
$table_name="$row[user_name]$row[sl]";
$sql="CREATE TABLE $table_name
(
SL INT NOT NULL AUTO_INCREMENT,
USER varchar(255) NOT NULL,
CHOICE varchar(500) NOT NULL,
PRIMARY KEY (SL),
UNIQUE (USER)
)";
if ($conn->query($sql) === TRUE) {
    //echo 'Table  created successfully';
$mysqli="UPDATE  `u452701521_poll`.`$table` SET  `table_id` =  '$table_name' WHERE  `master_table`.`sl` =$row[sl]";

if(!mysqli_query($conn,$mysqli))
    die(mysqli_error($conn));

} else {
    echo 'Error creating table: ' . $conn->error;
}
$com="com";
$table_comment="$table_name$com";
$sql="CREATE TABLE $table_comment
(
SL INT NOT NULL AUTO_INCREMENT,
NAME varchar(255) NOT NULL,
COMMENT varchar(500) NOT NULL,
DATEE varchar(30) NOT NULL,
TIMEE varchar(30) NOT NULL,
PRIMARY KEY (SL)

)";
if ($conn->query($sql) === TRUE) {
    //echo 'Table  created successfully';
	$link="Location: http://ibmmsrit.hol.es/poll/display.php?id=";
	$url="$link$table_name";
	header($url);

} else {
    echo 'Error creating table: ' . $conn->error;
}



}
if(isSet($_POST['sub_1']))
{
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table='master_table';

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));
$p_no=$_POST['num'];
if($p_no!="")
	{
		$poll="poll";
echo"<form role='form' method='post' onsubmit='return myFunction()'>

  <div class='form-group'>
     
  <label for='poll'>Total options:</label>
  <input type='text' class='form-control' name='p_n' value=".$p_no." required>
  <label for='poll'>Poll name:</label>
  <input type='text' class='form-control' name='p_name' id='p_name'  required>";
  echo"<hr>";
   
for($i=1;$i<=$p_no;$i++)
{
	$id="$poll$i";
	  echo"<label for='poll'>option:".$i."</label>
  <input type='text' class='form-control' name=".$id." id='$id' required>";
	
	
}
echo" <button type='submit' class='btn btn-success' name='sub_2'>GO</button>
		<a href='create_poll.php' class='btn btn-info' role='button'>RESET</a>

</div>
  </form>


";





}

exit(0);
}




?>

  <form role="form" method="post" onsubmit="return validation()" name="myForm">

  <div class="form-group">
  
    <label for="num">Number of options:</label>
  <input type="text" class="form-control" name="num" id="num" required>
  	        <button type="submit" class="btn btn-success" name="sub_1">GO</button>

 
</div>
  
  
 </form>  
  
  
  </div>

  

  </body>
  
  

  </html>
  


