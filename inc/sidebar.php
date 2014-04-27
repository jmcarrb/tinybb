<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele
###################
	// Define links for guests & registered users
	if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){ ?>
    <h3><img src="icons/idea.gif" border="0" /> Guest</h3>
    <li><a href="index.php?page=login">Login</a></li>
    <li><a href="index.php?page=register">Register</a></li>
    <br />
    <?php } else { ?>
    <h3><img src="icons/idea.gif" border="0" /> <?php echo "$user[username]"; ?></h3>
    <li><a href="index.php">Home</a></li>
    <li><a href="index.php?page=profile&id=<?php echo "$user[username]"; ?>">My Profile</a></li>
    <li><a href="index.php?page=usercp">Account</a></li>
    <?php
	$username = $_SESSION['username'];
	$getid= mysql_query("SELECT id FROM members WHERE username = '".$username."'");
	$getid = mysql_fetch_row($getid);
	$getid = $getid[0];
        $query = mysql_query("SELECT * FROM private WHERE to_id = ".$getid." AND is_deleted = 'no' AND is_permdeleted = 'no' AND status ='unread'");
	$number = mysql_num_rows($query);
	if($number == 0) {
	?><li><a href="index.php?page=private&inbox">Private Messages</a></li>
	<?php } elseif($number >= 1){?>
    <li><a href="index.php?page=private&inbox">Private Messages (<?php echo $number." Unread)";?></a></li><?php }?>
    <li><a href="index.php?page=addthread">Create Thread</a></li>
    <li><a href="index.php?page=logout">Logout</a></li><br />
    <?php } ?>
    <?php if ($user[admin] == "1"){ ?>
    <br /><hr><br />
    <li><a href="admin.php">Administration Panel</a></li>
    <?php } elseif ($user[admin] == "2"){ ?>
    <br /><hr><br />
    <li>Moderation Panel</li>
    <?php
	// End defining user links
	}
	?>
    <br />
    </li>
