<?php
 /* Obs³uga strony po stronie serwera */
class baza{
	var $db;
	var $collection;
	public function connect() {
		$m = new Mongo();
		$this->db = $m->selectDB('test');
	}
	public function find($query = "") {
		return $this->db->selectCollection($this->collection)->find();
	}
	public function runCommand($query = array()) {
		return $this->db->command($query);
	}
	
}
class db{
	public function __construct() {
		$this->baza = new baza();
		$this->baza->collection = 'kody3';
		$this->baza->connect();
	}
	public function Test() {
		var_dump($this->baza->runCommand(array('buildInfo' => 1)));
		// Wyœwietlanie wszystkich wyników z kolekcji 'kody3'
		// foreach($this->baza->find() as $one) {
			// var_dump($one);
		// }
	}
}
class User{

}
?>