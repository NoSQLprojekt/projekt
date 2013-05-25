<?php
require('class.inc.php');
$db = new db();
if(isset($_GET['id'])) {
	$db->updateOsobaById(array("_id" => new MongoId($_GET['id'])), $_POST);
}

?>