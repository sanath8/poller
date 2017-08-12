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


<?php
	$GLOBALS['id']=$_GET['id'];


	$link="http://ibmmsrit.hol.es/poll/display.php?id=$id";
	echo"<a href='$link' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-menu-left'></span>BACK</a>";

	echo "<img src='qr_img0.50j/php/qr_img.php?d=$link' heigth='300px' width='300px'>";



?>