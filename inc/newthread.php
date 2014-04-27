<?php if ($user[username] == ""){ echo "Please login to create a thread."; } else { ?>
<?php
      // TINYBB 1.3 UPDATE CODE
      // Check if the category exists, if it doesn't.. DIE and provide error....

      if ($_GET['do'] == "create"){ 
        $catid = clean($_POST[cat]);
      } else {
      $catid = clean($_GET[cat]);
      }
      $check_category = mysql_query("SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'") or die(mysql_error());
      if(mysql_num_rows($check_category) == 0){
        die("<h2><img src='icons/idea.gif' border='0'> Boom! Error...</h2>The category you're attempting to post this thread in doesn't exist...");
      }
      $sql = MYSQL_QUERY("SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'");
      $checker = mysql_fetch_array($sql);
      if (($checker[cat_admin] == "1") && (!$user[admin] == "1")) {  die("<h2><img src='icons/idea.gif' border='0'> \%\^\*\$\! Error...</h2>The category you're attempting to post this thread in is for staff only..."); }
      ?>

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
// Configuration include files
	// Check if the user is logged in
	?>
    <?php if ($_GET['do'] == "create"){ ?>
    <?php if(($_POST['check']) == $_SESSION['check']) {
      

                // THE THREAD ID RANDOMIZER
                         srand ((double) microtime( )*1000000); $random_number = rand(0,9999999999999);
                $title = trim(addslashes(htmlspecialchars($_POST[title])));
                $content = trim(addslashes(htmlspecialchars($_POST[content])));
                $author = "$user[username]";
                $id = "$random_number";
                $date = date("d-m-Y");
                $cat = clean($_POST[cat]);
                $order = date ("d-m-Y H:m");
                if(empty($title)) {
                echo "Something was left blank, go back and try again!";
                } elseif(empty($content)) {  echo "Something was left blank, go back and try again!"; } else {
				
                // To stop page refreshing
                header("Location: ?page=thread&post=$random_number");
                $sql = "INSERT INTO tinybb_threads
			(
			        thread_title,
				thread_content,
				thread_author,
				thread_key,
				date,
				cat_id

			)
			VALUES 
			(
				'$title',
                                '$content',
				'$author',
				'$id',
				'$date',
				'$catid'
			)";

		mysql_query($sql) or die(mysql_error());
		mysql_close($sql);
		?>
		<?php unset($_SESSION['check']); ?>
		<?php } } else { echo "Spam code entered incorrectly."; } ?>
		<?php } else { ?>
		
		<?php
		$catid = clean($_GET['cat']);
                $cat = MYSQL_QUERY("SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'");
                $checker = mysql_fetch_array($cat);
                echo "<img src='icons/idea.gif' border='0'> Creating new thread in <strong>$checker[cat_title]</strong><br /><br />";
                ?>
		
         <form action="?page=addthread&do=create" name="compose" method="POST">
         <input type="hidden" name="cat" value="<?php echo "$_GET[cat]"; ?>">
         Thread Title<br />
         <input type="text" name="title" size="50" autocomplete="off">
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
         <input type="submit" value="Post Thread">
         </form>

		<?php } ?>

    <?php
	// End thread code
	}
	?>
    <br />