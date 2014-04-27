<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
if ($_GET[e] == "1"){ echo "<strong>You are already registered.</strong>"; }
elseif ($_GET[e] == "2"){ echo "<strong>You are already logged in.</strong>"; }
else { echo "<strong>Error doesn't exist.</strong>";  }
 ?>