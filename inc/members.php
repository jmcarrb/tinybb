<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele
###################
session_start();
include_once"config.php";
if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
	header("Location: ?page=login");
}else{
}
?>
<h2>Welcome to <?php echo "$bbsetting[tinybb_title]"; ?></h2>
Hey <?php echo "$user[username]"; ?>, thanks for visiting. From this page you can choose what task you'd like to do on your visit.
<br /><hr><br />

<img src="icons/panel.gif"> <a href="index.php?page=editaccount">Edit Account</a><br />
<img src="icons/llc.gif"> <a href="?page=profile&id=<?php echo "$user[username]"; ?>">My Profile</a>
