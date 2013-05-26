<?
session_start();
?>
﻿<html>
<head>
  <title>Logowanie</title>
</head>

<body>
<form action="#" name="form" method="POST">
          <br />
          	<input type="text" name="login"  size="20">
                <input type="text" name="haslo"  size="20">
                
          <input type="submit" name="submit" value="Logowanie">
</form>

<?php
require('class.inc.php');
$user = new dbUser();


if (isset($_POST['submit'])){
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];

	if(empty($login)) print "Musisz podać login</br>";
	if(empty($haslo)) print "Musisz podać hasło</br>";
	if(($login and $haslo)){
	
	if ($user->checkLoginPassword($login, $haslo) == 0) {

		print "Nieprawidłowe Dane!!!";
	}
	else {
	$_SESSION["login"]=$login;
	print("Witaj na stronie <b>".$_SESSION["login"]."</b>\n");
	print("<a href=\"logout.php"."\">Logout</a>");
	}


 }
}

?>

</body>
</html>
