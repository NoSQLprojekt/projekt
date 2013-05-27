<?php
unset($_SESSION["login"]);
session_destroy();

header("Location: ?");
//print "Zostałeś wylogowany\n\n";	
//print("<a href=\"index.php?login"."\">Logowanie</a>");

?>
