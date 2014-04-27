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
$sql2 = "SELECT * FROM tinybb_news ORDER BY news_id DESC";
$tt = mysql_query($sql2) or die (mysql_error());
while($p=mysql_fetch_assoc($tt)){ ?>
<table id="forum" width="100%">
<th style="background-image:url('style/thread_header.png');" width="100px;">
        <?php if ($user[admin] == "1"){ 
        echo "<a href='admin.php?news=delete&id=$p[news_id]'><img src='icons/delete.gif' border='0'></a>
		<a href='admin.php?news=edit&id=$p[news_id]'><img src='icons/editnews.gif' border='0'></a>
		";
		} ?>
        
        </th>
<th style="background-image:url('style/thread_header.png');" width="500px;"><?php echo "$p[news_title]"; ?> | Posted: <?php echo "$p[news_date]"; ?></th>
<tr>         <td align="center">
           <?php
           $av = MYSQL_QUERY("SELECT * FROM `members` WHERE `username` = '$p[news_author]'");
           $av = mysql_fetch_array($av);
		   if ($av[avatar] == null){ echo "<img src='images/noav.png'><br />"; } else { 
           echo "<img src='$av[avatar]' class='avatar'><br />";
           }
         ?>
         <a href="index.php?page=profile&id=<?php echo "$p[news_author]"; ?>">
         <?php echo "$p[news_author]"; ?></a>
         </a>
</td>
<td>
<?php echo nl2br_limit(convertbb($p[news_content]),5); ?>
</td>
</tr>
</table>
<br />
<?php
}
?>
