
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



if(isSet($_POST['submit1']))
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
$e_mail=$_POST['email'];
$sql="SELECT * FROM $table WHERE email='$e_mail'" ;
$res=mysqli_query($conn,$sql);
if(mysqli_num_rows($res)===0)
{
	
$GLOBALS['flag']=1;
}
else
{
		$res=mysqli_query($conn,$sql);

	 if (mysqli_num_rows($res) >0) {
$row = mysqli_fetch_array($res);
	 }
$pass=$row[password];
	
		$to = $e_mail;
$subject = "Password details";
$txt = "Hello ".$row[user_name]." your password is ". $pass;
$headers = "From: sanathbhargav26@gmail.com" ."\r\n" .
"CC: sanathbhargav26@gmail.com";

mail($to,$subject,$txt,$headers);
echo"<br><font color='green'>mail is sent successfully</font><br>";
exit(0);

}


mysqli_close($conn);

}



 ?>

<div class="container">
  <p>Please fill in the details and the password would be sent to your mail<p>
  <form class="form-horizontal" method="post" onsubmit='return validation()' name="myForm">
    <div class="form-group">
	<label class="col-sm-2 control-label">E-mail:</label>
      <div class="col-sm-10">
        <input class="form-control" name="email" id="email" type="text" required >
      </div>
 	  	    <button type="submit" name="submit1" class="btn btn-default" >Done</button>

    </div>

</form>
	</div>

	<footer class="container-fluid">
  <p>&copy sanath</p>
</footer>

</body>
</html>
<script>

function validation()
{
		var email = document.getElementById('email');

			if(emailValidator(email, "Please enter a valid email address")){
							return true;
			
		
		}
		return false;
}

function emailValidator(elem, helperMsg){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}
</script>
<?php
if(	$GLOBALS['flag']===1)
{
	echo"</br><font color='red'><p>Sorry!!!the email doesn't exsist</p></font>";
}

?>