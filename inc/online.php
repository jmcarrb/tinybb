<?php
// By developer from RMB Scripting
$logout_time = 300;
$current = time();
$offline = ($current - $logout_time);
if($user['username']){
$update = mysql_query("UPDATE `members` SET `online` = '$current' WHERE `username` = '$user[username]';");
}
?>