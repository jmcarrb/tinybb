<?php if (!$bbsetting[tinybb_registration] == "1"){ ?>
<table id="forum">
<th style="background-image:url('style/thread_header.png');">Register</th>
<tr><td>
Registration is disabled.
</tr></td> 
</table>
<?php } else { ?>
<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
include_once"config.php";
if(isset($_SESSION['username']) || isset($_SESSION['password'])){
  echo "<meta http-equiv='Refresh' content='0; URL=?page=error&e=1'/>";
}
if(isset($_POST['register'])){
if(($_POST['check']) == $_SESSION['check']) {
$username= htmlentities(clean(trim($_POST['username'])));
$password = htmlentities(clean(trim(sha1(md5(md5(sha1(md5(sha1(sha1(md5($_POST[password])))))))))));
$email = $_POST[email];
$memip = $_SERVER['REMOTE_ADDR'];
$date = date("d-m-Y");
if($username == NULL OR $password == NULL OR $email == NULL){
$final_report.= "<div class='warning'>Please fill in all fields!</span>";
}else{
if(strlen($username) <= 3 || strlen($username) >= 30){
$final_report.="<div class='warning'>Your username must be between 3 and 30 characters.</span>";
}else{
$check_members = mysql_query("SELECT * FROM `members` WHERE `username` = '$username'");   
if(mysql_num_rows($check_members) != 0){
$final_report.="<div class='warning'>The username you are attempting to register is taken.</div><br />";
}else{
if(strlen($password) <= 5 || strlen($password) >= 100){
$final_report.="<div class='warning'>Your password must be between 6 and 12 digits.</div><br />";
}else{
if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){ 
$final_report.="<div class='warning'>Please enter a valid email address.</div><br />";
}else{
$create_member = mysql_query("INSERT INTO `members` (`id`,`username`, `password`, `email`, `ip`, `date`) 
VALUES('','$username','$password','$email','$memip','$date')");
$final_report.="<meta http-equiv='Refresh' content='0; URL=?page=registered'/>";
}}}}}
} else { echo "<div class='warning'>Spam code entered incorrectly!</div><br />"; }
}
?>
<table id="forum">
<th style="background-image:url('style/thread_header.png');">Register</th>
<?php echo "$final_report"; ?> 
<tr><td>
<form action="" method="post" name="register">

    Username:<br /> 
      <input name="username" type="text" id="username" autocomplete="off" size="30" /> 
      <br /><br /> 
    Password:<br /> 
    <input name="password" type="password" id="password" autocomplete="off" value="" size="30" /> 
     <br /><br /> 
    Email:<br /> 
    <input name="email" type="text" id="email" autocomplete="off" size="30" />
     <br /><br /> 
     <img src="inc/capya.php"> <br><input type="text" size="50" autocomplete="off" name="check"><br /><br />
      <input name="register" type="submit" id="register" value="Register" /> 
 
</form> 
</tr></td> 
</table>
<br />
<center><strong>Details</strong><br />
By registering to this TinyBB powered forum your IP address is taken for logging purposes.
</center>
<?php } ?>
