    <?php if ((!$allowguests == "0") && ($user[username] == null)){ echo "<center><span style='color:red; font-weight:bold;'>Guests are not allowed to browse $bbtitle</span></center>"; include("inc/login.php"); } else { ?>
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
	<?php if ($profile[username] == null){ echo "Profile doesn't exist!"; } else { ?>
    <?php if ($profile[admin] == "3"){ echo "<strong>This profile has been banned.</strong>"; } else { ?>
    <h4><?php echo "$profile[username]"; ?>'s Profile <?php if ($_GET['do'] == "awards"){ ?>(<a href="index.php?page=profile&id=<?php echo "$profile[username]"; ?>">View Profile</a>)
	<?php } else { ?>(<a href="index.php?page=profile&id=<?php echo "$profile[username]"; ?>&do=awards">View Awards</a>)<?php } ?></h4>
    <br />
    <?php if ($_GET['do'] == "awards"){ ?>
    <table id="forum">
    <th style="background-image:url('style/thread_header.png');" width="150px;">Awards</th>
    <tr>
    <td align="center">
                            <?php
                            $result = mysql_query("SELECT * FROM awards WHERE award_user = '$profile[username]'");
                            $awards = mysql_num_rows($result);
                            if ($awards == "0"){ echo "$profile[username] has no awards."; } else { 
                            ?>
                            <?php
                            $sql = "SELECT * FROM awards WHERE award_user = '$profile[username]' ORDER BY id DESC LIMIT 50";
                            $res = mysql_query($sql) or die (mysql_error());
                            while($r=mysql_fetch_assoc($res)){
                            echo "<img src='$r[award_img]' border='0' alt='$r[award_desc]' title='$r[award_desc]'>";  
                            }
                            ?>
                            <?php } ?>
    </td>
    </tr>
    </table>
    <?php } else { ?>
    <table id="forum">
    <th style="background-image:url('style/thread_header.png');" width="150px;">Details <?php if ($user[admin] == "1"){ ?>(<a href="admin.php?list=editaccount&id=<?php echo "$profile[username]"; ?>">Edit</a>)<?php } ?></th>
    <th style="background-image:url('style/thread_header.png');">About Me</th>
    <tr>
    <td align="center">
    <strong>Name</strong>: <?php if ($profile[name] == null){ echo "Annonymous"; } else { echo "$profile[name]"; } ?>
    <br />
    <strong>Group</strong>: <?php if ($profile[admin] == 1){ echo "Admins"; } elseif ($profile[admin] == "mod"){ echo "Moderators"; } else { echo "Members"; } ?>
    <br />
    <strong>Joined</strong>: <?php echo "$profile[date]"; ?>
    <br /><br />
    <?php
         $res = mysql_query("SELECT * FROM tinybb_replies WHERE reply_author = '$profile[username]'");
         $res2 = mysql_query("SELECT * FROM tinybb_threads WHERE thread_author = '$profile[username]'");
         $posts = mysql_num_rows($res);
         $topics = mysql_num_rows($res2);
         echo "<strong>Topics:</strong> $topics<br /><strong>Replies:</strong> $posts";
    ?>
    <br /><br />
    <?php if ($profile[avatar] == null ){ echo "<img src='images/noav.png'>"; } else { echo "<img src='$profile[avatar]' class='avatar'>"; } ?>
    <br /><br />
    </td>
    <td align="center">
    <?php if ($profile[bio] == null ){ echo "No biography added."; } else { ?><?php echo nl2br_limit(convertbb($profile[bio]),5); ?><?php } ?>
    </tr></td></table>
     </td>
    </tr>
    </table>
    <?php } } } } ?>
