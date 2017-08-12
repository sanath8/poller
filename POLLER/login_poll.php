<html>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login PAGE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
     footer {
      color: black;
	      position:fixed;bottom:0;

    }
  </style>
</head>
<body>

<?php
error_reporting(0);
session_start();
/*if(IsSet($_SESSION["user"]))
{
	include('home.php');
exit(0);
}*/

if(isSet($_POST['submit2']))
{
	
$servername = "mysql.hostinger.in";
//$username = "u838042989_cbse";
$username = "u452701521_polle";
$password = "poll123";
//$database='u838042989_bel';
$database='u452701521_poll';
$table="login_table";
	$GLOBALS['flag']=0;

// Create connection
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"$database") or die(mysql_error($conn));
$pass=$_POST['pass'];
$user=$_POST['user'];
$sql="SELECT * FROM $table WHERE password='".$pass."' AND user_name='".$user."'" ;
$res=mysqli_query($conn,$sql);
if(mysqli_num_rows($res)!=0)
{
		$row = mysqli_fetch_array($res);

	$_SESSION["user"] = $row['user_name'];
	if(!IsSet($_SESSION["ser"]))
{
$url="Location: http://ibmmsrit.hol.es/poll/home.php?id=1";
}
else{
	$uid=$_SESSION["ser"];
	unset($_SESSION['ser']);

	$link="Location: http://ibmmsrit.hol.es/poll/display.php?id=";
	$url="$link$uid";
	
}
	header($url);

	mysqli_close($conn);
$GLOBALS['flag']=0;
exit(0);
}
else
{
	$GLOBALS['flag']=1;

}


mysqli_close($conn);

}



 ?>

<div class="container">
  <h2>Login Information</h2>
  <form class="form-horizontal" method="post">
    <div class="form-group">
  <div class="input-group">

    <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
      <div class="col-sm-10">
        <input class="form-control" name="user" type="text" placeholder="user" >
      </div>
	  
	  </div>
	    <div class="input-group">

    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <div class="col-sm-10">
        <input class="form-control" name="pass" type="password" placeholder="password" >
      </div>
	  </div>
	    <button type="submit" name="submit2" class="btn btn-default" >Login</button>
		<a href="http://ibmmsrit.hol.es/poll/signup.php" class="btn btn-info" role="button">Sign up</a>

    </div>

</form>
<a href="forgot_password.php">Forgot password?</a>

	</div>
<footer class="container-fluid">
  <p>&copy sanath</p>
</footer>

</body>
</html>
<?php
if(	$GLOBALS['flag']===1)
{
	echo"</br><font color='red'><p>Wrong user name or password</p></font>";
}


?>