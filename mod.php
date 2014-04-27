<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
// Configuration include files
@include("inc/tinybb-settings.php");
?>
<?php if ((($user[admin] == "mod") && ($user[username] != null) || ($user[admin] == "1"))){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$notes = MYSQL_QUERY("SELECT * FROM `admin`");
$notes = mysql_fetch_array($notes);
?>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "$bbtitle"; ?> Moderator Control Panel</title>
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
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
<style type="text/css">
<!-- 
body  {
	font: 12px Verdana, Arial, Helvetica, sans-serif;
	background: #81B5E9;
	background: #feffff url(images/bg.jpg) top repeat-x;
	background-repeat:repeat-x;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
}
textarea
{
    width:98%;
	height:420px;
}
.twoColFixLt #container { 
	width: 80%;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.twoColFixLt #sidebar1 {
	float: left; /* since this element is floated, a width must be given */
	width: 200px; /* the actual width of this div, in standards-compliant browsers, or standards mode in Internet Explorer will include the padding and border in addition to the width */
	background: #ffffff; /* the background color will be displayed for the length of the content in the column, but no further */
	padding: 15px 10px 15px 20px;
}
.twoColFixLt #mainContent { 
	margin: 0 0 0 250px; /* the left margin on this div element creates the column down the left side of the page - no matter how much content the sidebar1 div contains, the column space will remain. You can remove this margin if you want the #mainContent div's text to fill the #sidebar1 space when the content in #sidebar1 ends. */
	padding: 0 20px 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
	min-height:600px;
} 
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class should be placed on a div or break element and should be the final element before the close of a container that should fully contain a float */
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}

body {
	padding-bottom: 0;
	margin-bottom: 0;
}

body, a, td, th, input, textarea, select {
	font-family: Arial;
	font-size: 12px;
	color: #444;
	text-decoration: none;
}
a {
	font-weight: bold;
}
img {	
	border: 0;
}
form {	
	padding: 0;
	margin: 0;
}
table {
	margin-left:auto;
	margin-right:auto;
	width:600px;
}
.box {
	background: #fff;
	padding: 5px;
	margin-bottom: 10px;
}
.box .content {
	padding: 0px 5px 5px 5px;
}
.square {
	padding: 5px;
	margin-bottom: 5px;
}
.square strong {
	font-size: 14px;
}
.square.menu {
	color: #fff;
	margin-bottom: 0px;
	cursor: pointer;
}
.square.title {
	background-color: #eee;
	color: #444;
}
#pmbar {
	margin:5px;
	width:600px;
	text-align:center;
	padding-top:4px;
	padding-bottom:4px;
}
.square.good {
	background-color: #d9ffcf;
	border-color: #ade5a3;
	color: #1b801b;
}
.square.bad {
	background-color: #ffcfcf;
	border-color: #e5a3a3;
	color: #801b1b;
}
input, textarea, select {
	border: 1px #e0e0e0 solid;
	border-bottom-width: 2px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	padding: 5px;
	font-size: 14px;
	font-weight: bold;
}
input:focus {
	border-color: #ccc;
	background-color: #fafafa;
}
input[type=submit], input.button {	
	border: 1px #e0e0e0 solid;
	border-bottom-width: 2px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	padding: 5px;
	font-size: 14px;
	font-weight: bold;
}
input[type=submit], input.submit {	
	border: 1px #e0e0e0 solid;
	border-bottom-width: 2px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	padding: 5px;
	font-size: 14px;
	font-weight: bold;
}
input[type=submit], input.submit:hover {	
	border: 1px #e0e0e0 solid;
	border-bottom-width: 2px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	padding: 5px;
	font-size: 14px;
	font-weight: bold;
}
td.label {
	width: 25%;
	text-align: right;
}
td.field {
	width: 200px;
	text-align: right;
}
.tpaw {
	background-color: #eee;
	color: #333;
	padding:5px;
	border:#f2f2f2 thin solid;
}
.tpow {
	background-color: #f8f8f8;
	color:#333;
	padding:5px;
	border:#f2f2f2 thin solid;
}
.tpow:hover {
	background-color: #f2f2f2;
	color:#222;
	padding:5px;
	border:#eee thin solid;
}
.tpew {
	background-color: #ccc;
	font-size:16px;
	color: #333;
	padding:5px;
	border:#f2f2f2 thin solid;
}
.tpiw {
	background-color: #ccc;
	font-size:16px;
	color: #333;
	padding:5px;
	border:#f2f2f2 thin solid;
}
.read {
	font-weight:normal;
}
.alert {
	background:#CCC;
	border: 2px solid #666;
	text-align: center;
	padding: 3px;
	font-size: 11px;
	margin-bottom:5px;
	margin-right:auto;
	margin-left:auto;
}

#forum
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:75%;
border-collapse:collapse;
}
#forum td, #forum th 
{
font-size:1em;
border:1px solid #000;
padding:3px 7px 2px 7px;
}
#forum th 
{
font-size:13px;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-image:url('style/thread_header.png');
color:#ffffff;
}
#forum tr.alt td
{
color:#000000;
background-color:#EAF2D3;
}

.admin {
font-size:12px;
text-align:left;
padding:10px;
background-image:url('style/thread_header.png');
color:#ffffff;
}
.admin {
color: #ffffff;
background-image:url('style/thread_header.png');
}

.avatar {
  max-width: 25px;
  max-height: 25px;
}
--> 
</style>
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixLt #sidebar1 { width: 230px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixLt #sidebar1 { padding-top: 30px; }
.twoColFixLt #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */

.warning {
    color: #ffffff;
    background-color: #1C1C1C;
    background-image: url('icons/alert.png');
    padding:5px;
    margin: 10px 0px;
    padding:15px 10px 15px 50px;
    background-repeat: no-repeat;
    background-position: 10px center;
}

</style>
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixLt #sidebar1 { width: 230px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixLt #sidebar1 { padding-top: 30px; }
.twoColFixLt #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */


</style>
<![endif]-->
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
</head>

<body class="twoColFixLt">
<p>&nbsp;</p>
<div id="container">
<div class="admin"><strong><?php echo "$bbtitle"; ?> Moderator Control Panel</strong> <a href="index.php?page=logout"><span style="float:right; color:#ffffff; font-weight:bold;">Logout</span></a></div>
  <div id="sidebar1">
    <?php $list = $_GET['list']; ?>
    <h3>Manage Forum</h3>
    <p><img src="icons/none.gif" alt="none" /> <a href="index.php">Forum Home</a><br />
    <img src="icons/none.gif" alt="none" /> <a href="mod.php">Moderation Home</a>    </p>
    <div id="CollapsiblePanel1" class="CollapsiblePanel" align="center">
      <div class="CollapsiblePanelTab" tabindex="0"><img src="admin/settings.png" border="0" /> Tools </div>
      <div class="CollapsiblePanelContent">
        <p><a href="?list=banned">Banned Accounts</a><br />
        <a href="?list=rules">Forum Rules</a><br /><br />
        </p>
      </div>
    </div>
    <p>&nbsp;</p>
  <!-- end #sidebar1 --></div>
  <div id="mainContent">
         <?php if ($_GET['do'] == "unban"){ ?>
         
         <?php
         if ((($profile[admin] == 1) || ($profile[id] == null) || (!$profile[admin] == 3))) { echo "<h2></h2>Error with request."; } else {
         $account = clean($_GET[id]);
         $update = mysql_query("UPDATE `members` SET `admin` = '0' WHERE `username` = '$account'") or die ("Error while attempting to modify database information");
         echo "<h2></h2>Successfully unbanned $_GET[id]";
         }
         ?>
         <?php } elseif ($_GET['do'] == "ban"){ ?>
         
         <?php
         $modp = clean($_POST[account]);
         $sql = MYSQL_QUERY("SELECT * FROM `members` WHERE `username` = '$modp'");
         $modp2 = mysql_fetch_array($sql);
         if ((($modp2[admin] == 1) || ($modp2[id] == null) || ($modp2[admin] == 3))) { echo "<h2></h2>Error with request."; } else {
         $account = clean($_GET[id]);
         $update = mysql_query("UPDATE `members` SET `admin` = '3' WHERE `username` = '$modp'") or die ("Error while attempting to modify database information");
         echo "<h2></h2>Successfully banned $_GET[id]";
         }
         ?>

         <?php } elseif($_GET['list'] == "banned"){ ?>
         <h2><img src="admin/tinybb.png"> Banned Accounts</h2>
         <div class="warning" align="center">
         <form action="mod.php?do=ban" method="POST">
         Username: <input type="text" name="account" autocomplete="off">
         <input type="submit" value="Ban Account">
         </form>
         </div>
         <table id="forum">
          <th>Username</th>
          <th>Actions</th>
          <?php
          // The below is calling data from the "data"base and listing it here in an array.
          $result = mysql_query("SELECT * FROM members WHERE admin='3'");
          while($row = mysql_fetch_array($result)) { ?>
          <tr>
          <td align="center"><?php echo "$row[username]"; ?></td>
          <td align="center"><a href="?do=unban&id=<?php echo "$row[username]"; ?>"><img src="icons/modu.gif" title="Unban Account" alt="Unban Account" border="0"></a></td>
          </tr>  
          <?php } ?>
          </table> 
          <br />
                   <center>

         </center>
         <?php } elseif ($_GET['list'] == "rules"){ ?>
         <h2><img src="admin/tinybb.png"> Rules</h2>
         <?php echo nl2br_limit(convertbb($notes[rules]),5); ?>
<?php } else { ?>
<h2></h2>
	  <div class="admin">Admin Message</div><br />
	  <?php echo nl2br_limit(convertbb($notes[admin_message]),5); ?>
<br /><br />
<?php } ?>
</div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
<!-- end #container --></div>
<script type="text/javascript">
<!--
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2");
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
</body></html>
<?php } else { ?>

<html>
<head>
<title>TinyBB > Moderator Login</title>
<style>
body {
background-color:#151515;
background-image:url('admin/mbg.png');
background-repeat:repeat-x;
font-family:verdana;
font-size:12px;
}
#login {
  margin:auto;
  width:600px;
  background:#fff;
  min-height:100px;
  margin-top:20px;
  -moz-border-radius: 15px;
  border-radius: 15px;
  padding:10px;
}
#head {
  width:600px;
  margin:auto;
  margin-top:100px;
}
#footer {
  width:600px;
  margin:auto;
  margin-top:10px;
  color:#fff;
  text-align:center;
  font-size:10px;
}
.warning {
    color: #ffffff;
    background-color: #1C1C1C;
    background-image: url('icons/alert.png');
    padding:5px;
    margin: 10px 0px;
    padding:15px 10px 15px 50px;
    background-repeat: no-repeat;
    background-position: 140px center;
  -moz-border-radius: 15px;
  border-radius: 15px;
}
</style>
</head>
<body>
<div id="head"><img src="admin/modlogo.png"></div>
<div id="login" align="center">
<div class="warning" align="center">Please login to access the moderation panel</div>
<form action="index.php?page=login&return=mod" method="post">

      <input type="text" name="username" size="30" autocomplete="off" value="Username" maxlength="25">
    <input type="password" name="password" size="30" autocomplete="off" value="Password" maxlength="25">
     <input type="submit" name="login" value="Login" />

</form>
</div>
<div id="footer">TinyBB Moderation Panel 1.0</div>
</body>
</html>
<?php } ?>