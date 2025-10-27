<?php

session_start(); //will access the session variables

session_unset(); // removes those variables
session_destroy(); //destroyes the session

header("Location: loginform.php"); //redirected to login page after logging out
exit;

?>