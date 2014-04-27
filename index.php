<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
// Configuration include files
@include("inc/tinybb-settings.php"); // Most of the forum settings can be found in this file, it is located in your forum /inc/ folder 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="description" content="TinyBB Powered Forum" />
<meta name="keywords" content="General,Discussion,Discuss,Topics,Forum,Writing,People,Social,Network,Create,Accounts" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/pagination.css" />
<title><?php echo "$bbsetting[tinybb_title]"; ?></title>
</head>
<body>

<div id="wrap">

<div id="header">

<div class="menu">
<ul>
<?php if ($user[username] == ""){ ?>
<li><a href="?page=login">Login</a></li>
<li><a href="?page=register">Register</a></li>
<?php } else { ?>
<li><a href="?page=editaccount">My Account</a></li>
<li><a href="?page=profile&id=<?php echo "$user[username]"; ?>">My Profile</a></li>
<?php if ($user[admin] == "1"){ echo "<li><a href='admin.php' style='font-weight:bold;'>Administration</a></li>"; } ?>
<?php } ?>
</ul>
</div>


<h1><a href="index.php"><img src="images/formlogo.png" /></a></h1>

</div>

<div id="content">
<?php if ((!$bbsetting[tinybb_maintenance] == "1") && ($user[admin] == "1")){
  echo "<div class='warning' align'center'>The forum currently has maintenance mode enabled. To disable it, edit your <a href='admin.php?list=settings'>Forum Settings</a>.</div>";
}
?>
<?php if ($bbsetting[tinybb_categories] == "0"){
  include("inc/list.php"); }
  else {
  include("inc/list2.php");
  }
  ?>
</div>


<div style="clear: both;"> </div>

</div>


<p align="center">
<?php echo "$footer"; ?>
<?php if ($user[admin] == "1"){ echo "<a href='admin.php'>Administration</a> | "; } ?><?php if (($user[admin] == "mod") || ($user[admin] == "1")){ echo "<a href='mod.php'>Moderation</a> | "; } ?> <?php if ($user[username] == ""){ } else { ?><a href="?page=logout">Logout</a><?php } ?>
</p>


</div>

</body>
</html>
