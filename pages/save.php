<?php
require('class.inc.php');
$db = new db(); 
$dbuser = new dbUser();
if(isset($_GET['add'])){
	if(isset($_POST['submit'])) {
		$db->addOsoba($_POST);
		header("Location: index.php?list");
	}
}
if(!empty($_GET['remove'])) {
	$db->deleteId(array("_id" => new MongoId($_GET['remove'])));
	header("Location: index.php?list");
}
if(isset($_GET['addUser']) && isset($_POST['submit'])) {
	if ($dbuser->checkLogin($_POST['login']) == 0) {
		$dbuser->add($_POST);
		print "Udana rejestracja. Mozesz sie teraz zalogowac";
		print("<a href=\"index.php?login"."\">Logowanie</a>");
	}
	else {
		print "Taki login juz istnieje!!! Wybierz inny";
	}
}
if(isset($_GET['edit']) && isset($_GET['id'])) {
	$db->updateOsobaById(array("_id" => new MongoId($_GET['id'])), $_POST);
}














?>
