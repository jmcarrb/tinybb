<?php if ($user[username] == null){ echo "Please login to edit your account."; } else { ?>

 <h3><img src="icons/admin.gif"> Edit Account</h3>
 <?php if ($_GET['do'] == "save"){ ?>
 <?php
 $avatar = addslashes(htmlspecialchars($_POST[avatar]));
 $name = addslashes(htmlspecialchars($_POST[name]));
 $biography = addslashes(htmlspecialchars($_POST[biography]));
 $update = mysql_query("UPDATE `members` SET `avatar` = '$avatar', `name` = '$name', `bio` = '$biography' WHERE `username` = '$user[username]'");
 echo "Your profile has been saved.";
 ?>
  <?php } elseif($_GET['do'] == "password"){ ?>

 <?php
 $password = trim(sha1(md5(md5(sha1(md5(sha1(sha1(md5($_POST[password])))))))));
 if ($_POST[password] == null){ echo "Your password cannot be blank..."; } else {
 $update = mysql_query("UPDATE `members` SET `password` = '$password' WHERE `username` = '$user[username]'");
 echo "Your password has been updated.";
 }
 ?>

 <?php } else { ?>
 <form action="?page=editaccount&do=save" method="POST">
 Your Avatar (Enter URL)<br />
 <input type="text" name="avatar" size="50" value="<?php echo "$user[avatar]"; ?>" autocomplete="off">
 <br /><br />
 Your Name<br />
 <input type="text" name="name" value="<?php echo "$user[name]"; ?>" size="50">
 <br /><br />
 Short Biography<br />
 <textarea cols=70 rows=5 maxlength="500" name="biography"><?php echo "$user[bio]"; ?></textarea>
 <br /><br />
 <input type="submit" value="Save Profile">
 </form>
 <br /><br />
 <h3><img src="icons/adminu.gif" border="0"> Change Password</h3>

 <form action ="?page=editaccount&do=password" method="POST">
 New Password<br />
 <input type="password" name="password" size="50"><br /><br />
 <input type="submit" value="Update Password">
 </form>


 <?php } ?>

<?php } ?>