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

if(isset($_GET['login']) && isset($_POST['submit'])){
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
	if ($dbuser->checkLoginPassword($_POST['login'], $_POST['haslo']) == 0) {
		print "Nieprawidłowe Dane!!!";
	}
	else {
		$_SESSION["login"]=$login;
		print("Witaj na stronie <b>".$_SESSION["login"]."</b>\n");
		print("<a href=\"logout.php"."\">Logout</a>");
	}
}













?>
