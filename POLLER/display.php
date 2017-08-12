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
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      color: black;
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
		      background-color: #f1f1f1;

	}
	.hint {
       background-color: linen;
  
    margin-left: 70px;
	    margin-top: -20px;

	    width:200px;

	word-wrap: break-word;

}
.qr_code {
	
      	    margin-top: -37px;
			margin-left: 255px

	   
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
	        <a class="navbar-brand" href="#" >Poller</a>

      <form class="navbar-form navbar-left">
      <div class="input-group">
 <input type="text" class="form-control" placeholder="Search people.." onkeyup="showHint(this.value)">
        
      </div>
    </form>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="home.php?id=1">Home</a></li>
       
        <li><a href="create_poll.php">Create a poll</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
	   	          <div class="hint"> <span id="txtHint" ></span></div>

	   
<hr>
<?php
include('boot.php');
echo"<div class='qr_code'><a href='generate_qr.php?id=$id' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-qrcode'></span> Qrcode </a></div>";
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table='master_table';
$user=$_SESSION["user"];
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));
echo"<div class='modal fade' id='imgModal' role='dialog'>
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>ADD images(maximum 4)</h4>
        </div>
        <div class='modal-body'>


<form action='upload_image.php?id=$id' method='post' enctype='multipart/form-data'>
    Select image to upload:
    <input type='file' name='fileToUpload' id='fileToUpload'><br>
    <input type='submit' value='Upload Image' name='submit'>
</form>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
    </div>
  </div>";
  
if(isSet($_POST['sub_3']))
{
	$choice=$_POST['poll'];
	if($choice!="")
	{
	$subtable=$id;
	$sep="*";
	$anon="anonymous";
	$a_user="$user$sep$anon";
	$sql1="SELECT * FROM $subtable WHERE USER='$user'";
$result = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result)!=0)
{
	;
}
else{
	$mysqli="INSERT INTO $subtable (USER,CHOICE) VALUES('$a_user','$choice')";
	if(!mysqli_query($conn,$mysqli))
    die(mysqli_error($conn));
}
	}
	
}
if(isSet($_POST['sub_1']))
{
	
	$choice=$_POST['poll'];
	if($choice!="")
	{
	$subtable=$id;
	$anonymous="*anonymous";
	$cheater="$user$anonymous";
	$sql1="SELECT * FROM $subtable WHERE USER='$user' or USER='$cheater'";
$result = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result)!=0)
{
	;
}
else{
	$mysqli="INSERT INTO $subtable (USER,CHOICE) VALUES('$user','$choice')";
	if(!mysqli_query($conn,$mysqli))
    die(mysqli_error($conn));
}
	}
}
if(isSet($_POST['sub_2']))
{
	$com="com";
	$comment=$_POST['comment'];
	$time=date("h:i:sa");
$date=date("d/m/Y");
	$subtable="$id$com";
	$mysqli="INSERT INTO $subtable (NAME,COMMENT,DATEE,TIMEE) VALUES('$user','$comment','$date','$time')";
	if(!mysqli_query($conn,$mysqli))
    die(mysqli_error($conn));
}
$sql1="SELECT * FROM $table WHERE table_id='$id'";
$result = mysqli_query($conn, $sql1);
 
	  if (mysqli_num_rows($result) >0) {
	$row = mysqli_fetch_array($result);
	
	$c=explode(',',$row["poll_opt"],$row["poll_no"]);
	$img=explode(",",$row["poll_images"]);
    // output data of each row
	
	}
	$no_img=sizeof($img)-1;

	$no=$row["poll_no"];
	echo"<div class='col-sm-9'>
      <h4><small>"."Hello ".$user."</small></h4>
      <hr>
      <h3>".$row['poll_name']."</h3>
      <h5><span class='glyphicon glyphicon-time'></span> Post by ". $row['user_name']."  ". $row['date'].".</h5>";
	  if($user===$row['user_name'])
	  echo"<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='#imgModal'>Add images</button>";
     // <h5><span class='label label-danger'>tag1</span> <span class='label label-primary'>tag2</span></h5><br>";
	 if($no_img>0)
	 {
	 echo"
	 
	   <div class='row'>

	 <div class='col-md-4'>";
	 for($i=1;$i<=$no_img;$i++)
	 {

		 $image="http://ibmmsrit.hol.es/poll/images/";
		 $image="$image$img[$i]";
		 echo"<div class='thumbnail'>
				<img src='$image' alt='Nature' style='width:100%'>
				</div>";
	 }
	 echo"
	 </div>
	 </div>";
	 }
	 echo"<hr>";
	echo"<form method='post'>";
	for($i=0;$i<$row["poll_no"];$i++)
	{
		
	echo"
	<label class='radio-inline'>
	<input type='radio' name='poll' value='$c[$i]'><h5>$c[$i]</h5>
    </label></br>";	
		
	}
	echo"<button type='submit' class='btn btn-success' name='sub_1'>SHOW IDENTITY</button>
	<button type='submit' class='btn btn-success' name='sub_3'>GO ANONYMOUS</button>

  </form>      <br><br><hr>";
  echo"<h5> ***Results***</h5>
  <div id='getdata_poll'></div><hr>

  
  <button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#myModal'>View Graph</button><hr>

  <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog'>
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>".$row['poll_name']."</h4>
        </div>
        <div class='modal-body'>
  <div id='getdata_graph'></div>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <div class='panel-group'>
    <div class='panel panel-default'>
      <div class='panel-heading'>
        <h4 class='panel-title'>
          <a data-toggle='collapse' href='#collapse1'>View-Details</a>
        </h4>
      </div>
      <div id='collapse1' class='panel-collapse collapse'>
        	      <div id='getdata_information'></div>

      </div>
    </div>
  </div>
      
      
  <hr><h5> ***Comments***</h5>
	<h4>Leave a Comment:</h4>
      <form role='form' method='post' onsubmit='return myFunction()'>
        <div class='form-group'>
          <textarea class='form-control' rows='3' name='comment' id='comment' required></textarea>
        </div>
        <button type='submit' class='btn btn-success' name='sub_2'>POST</button>
      </form>
	      <div id='getdata_comment'></div>

      <br><br>
      

";
  
?>
      
	    <script>
		var id = " <?php echo $id ?> ";
		var url="test3.php?id="+id;
		var urlcom="test1.php?id="+id;
		var urlinfo="test2.php?id="+id;
		var urlgraph="test4.php?id="+id;


  dis1();
function dis1() {
   xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", urlcom, false);
  xmlhttp.send(null);
  document.getElementById("getdata_comment").innerHTML=xmlhttp.responseText;
  
}
    setInterval(function(){dis1();},20000);
	
	  dis2();
function dis2() {
   xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", url, false);
  xmlhttp.send();
  document.getElementById("getdata_poll").innerHTML=xmlhttp.responseText;
  
}
    setInterval(function(){dis2();},20000);
	  dis3();
function dis3() {
   xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", urlinfo, false);
  xmlhttp.send();
  document.getElementById("getdata_information").innerHTML=xmlhttp.responseText;
  
}
    setInterval(function(){dis3();},20000);
	
		  dis4();
function dis4() {
   xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", urlgraph, false);
  xmlhttp.send();
  document.getElementById("getdata_graph").innerHTML=xmlhttp.responseText;
  
}
    setInterval(function(){dis4();},20000);


	function showHint(str) {
			//document.getElementById("txtHint").innerHTML="reached";

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
function myFunction() {
		    
var y = document.getElementById("comment");
var str_name = y.value; 
    var n_name = str_name.search("'");
    if(n_name!=-1)
    {

    alert("please do not use Apostrophe");
	return false;

    }
	return true;
}

</script>


</div>
  </div>
</div>

<footer class="container-fluid">
  <p>&copy sanath</p>
</footer>

</body>
</html>













