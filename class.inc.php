<?php
 /* Obsługa strony po stronie serwera */
class baza{
	var $db;
	var $collection;
	var $dbcol;
	public function connect() {
		$m = new Mongo();
		$this->db = $m->selectDB('test');
		$this->dbcol = $this->db->selectCollection($this->collection);
	}
	public function find($query = "") {
		return $this->dbcol->find();
	}
	public function runCommand($query = array()) {
		return $this->db->command($query);
	}
	public function insert($query) {
		return $this->dbcol->insert($query);
	}
	public function update($criteria, $newobject, $options = array()) {
		return $this->dbcol->update($criteria, $newobject, $options);
	}
	public function ownQuery($query, $param = array()) {
		return $this->dbcol->{$query}($param);
	}
	public function remove($criteria = array(), $options = array())
	{
		return $this->dbcol->remove($criteria, $options);
	}
	
}
class db{
	public function __construct() {
		$this->baza = new baza();
		$this->baza->collection = 'test';
		$this->baza->connect();
	}
	public function Test() {
		/** Prosty CRUD **/
		$this->baza->remove();
		$this->baza->insert(array("Imie" => "Janek", "Nazwisko" => "Waśniewski"));
		$this->baza->insert(array("Imie" => "Franek", "Nazwisko" => "Frankowski"));
		/** Foreach iteracja na elementach zwracanych przez find() **/
		// foreach($this->baza->find() as $key => $val) {
			// var_dump($key);
			// var_dump($val);
		// }
		/** Inna metoda poprzez iterator_to_array() : **/
		$x = iterator_to_array($this->baza->find());
		var_dump($x);
		/** Update pierwszego elementu, dopisujemy ulice i numer  **/
		$this->baza->update(array("_id" => new MongoId(key($x))), array('$set' => array("Ulica" => "Słoneczna", "Numer" => "15")));
		/** key($x) wyświetla nam klucz pierwszego elementu z tablicy, jeżeli chcemy kolejny to możemy dać next($x) i wtedy key($x) nam zwróci kolejny element **/
		/** wartości zwraca current($x) -- jest to też kolejny sposób na iterowanie po tablicy **/
		echo '-------------------------------';
		foreach($this->baza->find() as $one) {
			var_dump($one);
		}
		/** A teraz usuńmy franka **/
		$this->baza->remove(array("Imie" => "Franek", "Nazwisko" => "Frankowski"));
		echo '-------------------------------';
		foreach($this->baza->find() as $one) {
			var_dump($one);
		}
		//var_dump($this->baza->ownQuery("findOne")); /** Własne polecenie, jeżeli brakuje czegoś w klasie baza co chcemy użyć to wystarczy, **/
													/** że wpiszemy polecenie jak w przykładzie obok, tu akurat nie ma w klasie findOne() **/
	}
}
class User{

}
?>