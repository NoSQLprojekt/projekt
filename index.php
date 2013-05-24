<?php
 /* Plik widoku */
require('class.inc.php');

$test = new Test();
//$test->modelTestCrud();

$db = new db();
$db->removeAll();
$db->addOsoba(array('imie' => 'Michał', 'nazwisko' => 'Stankiewicz'));
$db->updateOsoba(
	array('imie' => 'Michał', 'nazwisko' => 'Stankiewicz'), 
	array('imie' => 'Michał', 'nazwisko' => 'Stankiewicz', 'telefon' => '123456789')
);
var_dump($db->listAllOsoby());
?>