<?php
      if (!$_GET['post']){ } else {
        $clean_get = clean($_GET[post]);
      $check_thread = mysql_query("SELECT * FROM `tinybb_threads` WHERE `thread_key` = '$clean_get'") or die(mysql_error());
      if(mysql_num_rows($check_thread) == 0){
        die("<h2><img src='icons/idea.gif' border='0'> Boom! Error...</h2>The thread doesn't exist...");
      } }
?>
<?php if ($dcm == "vc"){ die("$tinybbkey"); } ?>
<script type="text/javascript">
function insertit(myField, myValue) {
if (document.selection) {
myField.focus();
sel = document.selection.createRange();
sel.text = myValue;
} else if (myField.selectionStart || myField.selectionStart == '0') {
var startPos = myField.selectionStart;
var endPos = myField.selectionEnd;
myField.value = myField.value.substring(0, startPos)
+ myValue
+ myField.value.substring(endPos, myField.value.length);
} else {
myField.value += myValue;
}
}
</script>
<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
 ?>
<?php if ((!$allowguests == "0") && ($user[username] == null)){ echo "<center><span style='color:red; font-weight:bold;'>Guests are not allowed to browse $bbtitle</span></center>"; include("login.php"); } else { ?>
         <?php
         $codes = array(
		'[b]' => '<span style="font-weight:bold">',
		'[B]' => '<span style="font-weight:bold">',
		'[/b]' => '</span>',
		'[/B]' => '</span>',
		'[i]' => '<span style="font-style:italic">',
		'[I]' => '<span style="font-style:italic">',
  		'[/i]' => '</span>',
  		'[/I]' => '</span>',
		'[u]' => '<span style="text-decoration:underline">',
		'[U]' => '<span style="text-decoration:underline">',
  		'[/u]' => '</span>',
  		'[/U]' => '</span>',
  		':)' => '<img src="icons/smile2.png" />',
  		':D' => '<img src="icons/bigsmile.png" />',
  		'(L)' => '<img src="icons/love.png" />',
  		';)' => '<img src="icons/wink.png" />',
  		':@' => '<img src="icons/angry.png" />',
  		':$' => '<img src="icons/blush.png" />',
  		':P' => '<img src="icons/tongue.png" />',
		':sw:' => '<img src="icons/skywalker.png" />',
		':tired:' => '<img src="icons/yawn.png" />',
		':(' => '<img src="icons/frown.png" />',
		'[youtube]' => '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="480" height="390" src="http://www.youtube.com/embed/',
		'[/youtube]' => '" frameborder="0"></iframe>'
		);
		function convertbb($t) { 
			$s = array_keys($GLOBALS['codes']);
 			$t = str_replace($s, $GLOBALS['codes'], $t);
  			return $t;
		}
		function nl2br_limit($string, $num){
   			$dirty = preg_replace('/\r/', '', $string);
			$clean = preg_replace('/\n{4,}/', str_repeat('<br/>', $num), preg_replace('/\r/', '', $dirty));
   			return nl2br($clean);
		}
		?>
         <?php
         // The below is calling data from the "data"base and listing it here in an array.
         $result = mysql_query("SELECT * FROM tinybb_threads WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' LIMIT 1") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysql_fetch_array($result))  {
         ?>
         <table id="forum" width="100%" style="overflow: auto;">
         <th style="background-image:url('style/thread_header.png');" width="100px;">
                  <?php if ($user[admin] == "1"){ ?>
         <a href="admin.php?delete&thread=<?php echo "$row[thread_key]"; ?>"><img src="icons/delete.gif" border="0"></a>
         <a href="admin.php?list=edit&type=thread&thread=<?php echo "$row[thread_key]"; ?>"><img src="icons/edit_post.png" border="0"></a>
         <?php if ($row[thread_lock] == "1"){ ?>
         <a href="admin.php?lock&lock=2&thread=<?php echo "$row[thread_key]"; ?>"><img src="icons/unlock.gif" border="0"></a>
         <?php } else { ?>
         <a href="admin.php?lock&lock=1&thread=<?php echo "$row[thread_key]"; ?>"><img src="icons/lock.gif" border="0"></a>
         <?php } } ?>
         <?php if (!$user[admin] == "1"){ echo "Thread"; } ?></th>
         <th style="background-image:url('style/thread_header.png');"><?php if (($row[date] == null) || ($row[date] == "0")){ echo "N/A"; } elseif ($row[date] == $today){ echo "Today"; } else { echo "$row[date]"; } ?>
          in
          <?php
          // EDIT 1.3.2 NEW CODE
      $cat = MYSQL_QUERY("SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$row[cat_id]'");
      $checker = mysql_fetch_array($cat);               
      if(@mysql_num_rows($cat) == 0){
        $category = "Unknown";
      } else {
        $category = "$checker[cat_title]";
      }
      echo "<strong><i><a href='index.php?page=cat&cati=$checker[cat_id]'>$category</a></i></strong>";
      // EDIT END
     ?>
         </th>
         <tr>
         <td align="center">
           <?php
           $av = MYSQL_QUERY("SELECT * FROM `members` WHERE `username` = '$row[thread_author]'");
           $av = mysql_fetch_array($av);
		   if ($av[avatar] == null){ echo "<img src='images/noav.png'><br />"; } else { 
           echo "<img src='$av[avatar]' class='avatar'><br />";
           }
         ?>
         <a href="index.php?page=profile&id=<?php echo "$row[thread_author]"; ?>">
         <?php echo "$row[thread_author]"; ?></a>
         </a>
         <br />
         <?php
         $res = mysql_query("SELECT * FROM tinybb_replies WHERE reply_author = '$row[thread_author]'");
         $res2 = mysql_query("SELECT * FROM tinybb_threads WHERE thread_author = '$row[thread_author]'");
         $posts = mysql_num_rows($res);
         $topics = mysql_num_rows($res2);
         echo "<strong>Topics:</strong> $topics<br /><strong>Replies:</strong> $posts";
         ?>
         </td>
         <td><?php echo nl2br_limit(stripslashes(convertbb($row[thread_content])),5); ?></td>
         </tr>
         </table>
         <br /><br />
         <hr>
         <?php } ?>
         <?php
         // The below is calling data from the "data"base - FOR REPLIES
         $result = mysql_query("SELECT * FROM tinybb_replies WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' ORDER BY ABS(`aid`) ASC LIMIT 5000") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysql_fetch_array($result))  {
         ?>
         <br /><br />
         <table id="forum" width="100%">
         <th style="background-image:url('style/reply_header.png');" width="100px;">
                  <?php if ($user[admin] == "1"){ ?>
         <a href="admin.php?deletereply&id=<?php echo "$row[reply_key]"; ?>"><img src="icons/delete.gif" border="0"></a>
         <a href="admin.php?list=edit&type=reply&reply=<?php echo "$row[reply_key]"; ?>"><img src="icons/edit_post.png" border="0"></a>
         <?php } ?>
         Reply</th>
         <th style="background-image:url('style/reply_header.png');"><?php if ($row[date] == null){ echo "N/A"; } elseif ($row[date] == $today){ echo "Today"; } else { echo "$row[date]"; } ?></th>
         <tr>
         <td align="center">
           <?php
           $av = MYSQL_QUERY("SELECT * FROM `members` WHERE `username` = '$row[reply_author]'");
           $av = mysql_fetch_array($av);
		   if ($av[avatar] == ""){ echo "<img src='images/noav.png'><br />"; } else {
           echo "<img src='$av[avatar]' class='avatar'><br />";
           }
         ?>
         <a href="index.php?page=profile&id=<?php echo "$row[reply_author]"; ?>"><?php echo "$row[reply_author]"; ?></a>
         <br />
         <?php
         $res = mysql_query("SELECT * FROM tinybb_replies WHERE reply_author = '$row[reply_author]'");
         $res2 = mysql_query("SELECT * FROM tinybb_threads WHERE thread_author = '$row[reply_author]'");
         $posts = mysql_num_rows($res);
         $topics = mysql_num_rows($res2);
         echo "Topics:</strong> $topics<br /><strong>Replies:</strong> $posts";
         ?>
         </td>
         <td><?php echo nl2br_limit(stripslashes(convertbb($row[reply_content])),5); ?></td>
         </tr>
         </table>
         <?php } ?>
         <?php
         // The below is calling data from the "data"base and listing it here in an array.
         $result = mysql_query("SELECT * FROM tinybb_threads WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' LIMIT 1") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysql_fetch_array($result))  {
           // Version 1.3.2 Edit
         if ($row[thread_lock] == "1"){ die("<br /><strong>Cannot post reply, the thread is locked.</strong>"); }
         }

         // End of edit
         ?>
         <?php if ($_GET['do'] == "reply"){ ?>
         <?php if(($_POST['check']) == $_SESSION['check']) { ?>

                <?php
                // THE THREAD ID RANDOMIZER 
                srand ((double) microtime( )*1000000); $random_number = rand(0,9999999999999);
                $content = addslashes(htmlspecialchars($_POST[content]));
                $author = "$user[username]";
                $avatar = addslashes(htmlspecialchars($_POST[avatar]));
                $thread = addslashes(htmlspecialchars($_POST[post]));
                $id = "$random_number";
                $date = date("d-m-Y");
                // To stop page refreshing
                header("Location: ?page=thread&post=$thread#last");
                if ($user[username] != null){
                $sql = "INSERT INTO tinybb_replies
			(
				reply_content,
				reply_author,
				reply_key,
				thread_key, 
				date

			)
			VALUES 
			(
				'$content',
				'$author',
				'$id',
				'$thread',
				'$date'
			)";


		mysql_query($sql) or die(mysql_error());
		mysql_close($sql);
                } else {
                  echo "You must be logged in to perform this action."; 
                }  
		?>
		<?php unset($_SESSION['check']); ?>
         <?php } else { echo "Spam code entered incorrectly."; } ?>
         <?php } else { ?>
         <?php
         // The below is calling data from the "data"base and listing it here in an array.
         $result = mysql_query("SELECT * FROM tinybb_threads WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' LIMIT 1") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysql_fetch_array($result))  {
         ?>
         <?php if ($user[username] == null){ } else { ?>
         <?php if ($row[thread_lock] == "1"){ echo "<br /><div class='warning'>The thread is locked.</div>"; } else { ?>
         <br />
         <h2><img src="icons/edit.gif" border="0"> Reply</h2>
         <form action="?page=thread&do=reply" name="compose" method="POST">
         <input type="hidden" name="post" value="<?php echo "$_GET[post]"; ?>">
         <textarea cols=70 rows=5 maxlength='1000' name='content'></textarea><br />
         <img src="icons/smile2.png" onclick="insertit(document.compose.content, ':)');" />
         <img src="icons/bigsmile.png" onclick="insertit(document.compose.content, ':D');" />
         <img src="icons/frown.png" onclick="insertit(document.compose.content, ':(');" />
         <img src="icons/wink.png" onclick="insertit(document.compose.content, ';)');" />
         <img src="icons/blush.png" onclick="insertit(document.compose.content, ':$');" />
         <img src="icons/skywalker.png" onclick="insertit(document.compose.content, ':sw:');" />
         <img src="icons/yawn.png" onclick="insertit(document.compose.content, ':tired:');" />
         <img src="icons/love.png" onclick="insertit(document.compose.content, '(L)');" />
         <img src="icons/angry.png" onclick="insertit(document.compose.content, ':@');" />    
         <img src="icons/underline.png" onclick="insertit(document.compose.content, '[u][/u]');" />
         <img src="icons/italic.png" onclick="insertit(document.compose.content, '[i][/i]');" />    
         <img src="icons/bold.png" onclick="insertit(document.compose.content, '[b][/b]');" />
         <br /><br />
         Spam Protection - Enter the numbers you see below<br />
         <img src="inc/capya.php"> <br>
         <input type="text" size="50" autocomplete="off" name="check"><br /><br>
         <input type="submit" value="Post Reply">
         </form>
         <?php  } } } } ?>

    <?php } ?>
    <a name="last"></a>