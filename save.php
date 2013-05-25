<?php
require('class.inc.php');
$db = new db(); 
if(isset($_GET['add'])){
	if(isset($_POST['submit'])) {
		$db->addOsoba($_POST);
		header("Location: index.php");
	}
	
}
















?>