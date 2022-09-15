<?php
//define("DB_SERVER", "200.57.119.102:53307");
define("DB_SERVER", "192.168.74.116");
define("DB_USER", "superuser");
define("DB_PASS", "E079D388");
define("DB_NAME", "C_SCHNEIDER");

$con_116 = mysqli_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysqli_error());
mysqli_select_db($con_116, DB_NAME) or die("Cannot select DB");

mysqli_query($con_116, "SET NAMES 'utf8'");

/*define("DB_SERVER2", "198.20.94.194");
define("DB_USER2", "superadmin");
define("DB_PASS2", "E079D388");
define("DB_NAME2", "Pedimento");

$con_portal = mysqli_connect(DB_SERVER2,DB_USER2, DB_PASS2) or die(mysqli_error());
mysqli_select_db($con_portal, DB_NAME2) or die("Cannot select DB");


//define("DB_SERVER3", "201.130.10.110:53306");
define("DB_SERVER3", "192.168.74.112");
define("DB_USER3", "superuser");
define("DB_PASS3", "E079D388");
define("DB_NAME3", "CAAAREM3");

$con_112 = mysqli_connect(DB_SERVER3,DB_USER3, DB_PASS3) or die(mysqli_error());
mysqli_select_db($con_112, DB_NAME3) or die("Cannot select DB");*/
?>