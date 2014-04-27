<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
if(isset($_SESSION['username']) || isset($_SESSION['password'])){
  echo "<meta http-equiv='Refresh' content='0; URL=?page=error&e=2'/>";
}

session_start();
include_once"config.php";
$username= htmlentities(clean(trim($_POST['username'])));
$check_user_data2 = mysql_query("SELECT * FROM `members` WHERE `username` = '$username'") or die(mysql_error());
$checker = mysql_fetch_array($check_user_data2);
if(isset($_POST['login'])){
$password = htmlentities(clean(trim(sha1(md5(md5(sha1(md5(sha1(sha1(md5($_POST[password])))))))))));
if($username == NULL OR $password == NULL){
$final_report.="<div class='warning'>Please fill in the username & password</div><br />";
}else{
$check_user_data = mysql_query("SELECT * FROM `members` WHERE `username` = '$username'") or die(mysql_error());
if(mysql_num_rows($check_user_data) == 0){
$final_report.="<div class='warning'>Username doesn't exist, why not <a href=\"?page=register\">Register</a>!</div><br />";
}elseif($checker[admin] == "3"){ 
  
  $final_report.="<div class='warning'>The account is banned, you cannot login.</div><br />";

}else{
$get_user_data = mysql_fetch_array($check_user_data);
if($get_user_data['password'] == $password){
$start_idsess = $_SESSION['username'] = "".$get_user_data['username']."";
$start_passsess = $_SESSION['password'] = "".$get_user_data['password']."";
if ($_GET['return'] == "admin"){
  header("Location: admin.php");
} elseif ($_GET['return'] == "mod"){ 
  header("Location: mod.php");
} else {
  header("Location: index.php?page=usercp");
}
} else {
  echo "<div class='warning'>Username and/or password was incorrect.</div>";
}
}}}
?>
<table id="forum">
<th style="background-image:url('style/thread_header.png');">Login</th>
<?php echo "$final_report"; ?>
<tr><td>
<form action="" method="post">

    Username:<br />
      <input type="text" name="username" size="30" autocomplete="off" maxlength="25">
      <br /><br />
    Password:<br />
    <input type="password" name="password" size="30" autocomplete="off" maxlength="25">
     <br /><br />
     <input type="submit" name="login" value="Login" />

</form>
</tr></td>
</table>
