<?php
require('class.inc.php');
$db = new db(); 
if(isset($_GET['add'])){
	if(isset($_POST['submit'])) {
		$db->addOsoba($_POST);
		header("Location: index.php");
	}
	
}
if(!empty($_GET['remove'])) {
$db->deleteId(array("_id" => new MongoId($_GET['remove'])));
header("Location: index.php");
}
if(isset($_GET['addUser']) && isset($_POST['submit']) {
	if ($user->checkLogin($login) == 0) {
		$user->add($_POST);
		print "Udana rejestracja. Mozesz sie teraz zalogowac";
	}
	else {
		print "Taki login juz istnieje!!! Wybierz inny";
	}
	
}















?>