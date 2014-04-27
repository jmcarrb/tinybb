<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
ob_start();session_start();
@include("inc/version_checker.php");
$dcm = $_GET['vc'];
$hostname = "localhost";
$data_username = "root"; //database username
$data_password = ""; //database password
$data_basename = "tinybb"; //database name
$conn = mysql_connect("".$hostname."","".$data_username."","".$data_password."");  
mysql_select_db("".$data_basename."") or die("<center><span style='font-family:tahoma; font-size:12px;'><img src='images/logo.png'><br />Error - Could not connect to a database</span></center>");

?>