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
		header("Location: ?login&good");
	}
	else {
		header("Location: ?register&bad");
	}
}
if(isset($_GET['edit']) && isset($_GET['id'])) {
	$db->updateOsobaById(array("_id" => new MongoId($_GET['id'])), $_POST);
}

if(isset($_GET['login']) && isset($_POST['submit'])){
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
	$id = $dbuser->checkLoginPassword($_POST['login'], $_POST['haslo']);
	if (!$id) {
		header("Location: ?login&bad");
	}
	else {
		$_SESSION['id'] = $id->__toString();
		$_SESSION['login']=$login;
		header("Location: ?");
	}
}













?>
