<?session_start();

if($_SESSION['login']){

	unset($_SESSION["login"]);
	
	session_destroy();

print "Zostałeś wylogowany\n\n";	
print("<a href=\"log.php"."\">Logowanie</a>");
}

else{
print "zaloguj sie\n\n";	
print("<a href=\"log.php"."\">Logowanie</a>");
}
?>
