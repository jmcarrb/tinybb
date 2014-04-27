<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
@session_start();     
include("config.php"); // Config.php located in your root forum directory contains all data needed to execute scripts from this page
                
                
                // Here is the cleaning function which helps to prevent against SQL injection, used on all public query codes (unless not needed)
                function clean($input) {
			if(is_array($input)){
				foreach( $input as $key => $value) {
					$input[$key] = $this->clean($value);
				}				
				return $input;
			} else {
			$input = addslashes(strip_tags(trim($input)));
				return $input;
			}
		}
		


$user = MYSQL_QUERY("SELECT * FROM `members` WHERE `username` = '$_SESSION[username]'");
$user = mysql_fetch_array($user);

$settingsql = MYSQL_QUERY("SELECT * FROM `tinybb_settings`");
$bbsetting = mysql_fetch_array($settingsql);

$profile2 = clean($_GET[id]);
$sql = MYSQL_QUERY("SELECT * FROM `members` WHERE `username` = '$profile2'");
$profile = mysql_fetch_array($sql);

$page = $_GET['page'];
$today = date("d-m-Y");

// Stat database
if ($bbsetting[tinybb_stats] == "1"){
$result = mysql_query("SELECT * FROM tinybb_threads");
$threads = mysql_num_rows($result);
$result2 = mysql_query("SELECT * FROM tinybb_replies");
$replies = mysql_num_rows($result2);
$result3 = mysql_query("SELECT * FROM members");
$members = mysql_num_rows($result3);
}

if ($bbsetting[tinybb_stats] == "1"){ $stats = "<img src='icons/stats_png.png'> $threads threads, $replies replies, $members members"; }

// You are not required to keep the powered by link, although if you'd like to help us grow, you can leave it :)
$footer = "Proudly powered by <a href='http://tinybb.net'>TinyBB</a> <img src=\"icons/smile.png\"><br />";
?>

