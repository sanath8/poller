<?php
session_start();
unset($_SESSION['user']);
header('Location: http://ibmmsrit.hol.es/poll/home.php?id=1');
?>



