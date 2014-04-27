<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
@session_start();
//imagecreatefrompng :: create a new image 
//from file or URL
$img = imagecreatefrompng('../images/black.png');
//displaying the random text on the captcha 
$numero = rand(100, 99999999); 
$_SESSION['check'] = ($numero); 
//The function imagecolorallocate creates a 
//color using RGB (red,green,blue) format.
$white = imagecolorallocate($img, 255, 255, 255); 
imagestring($img, 10, 8, 3, $numero, $white);
header ("Content-type: image/png"); imagepng($img);
?>