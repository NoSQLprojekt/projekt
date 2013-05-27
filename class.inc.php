<?php
/* Obsługa strony po stronie serwera */
// Obiekt osoba
class User{
	public $login;
	public $haslo;
	public $email;
	public function __construct($login = '', $haslo = '', $email = '') {
		$this->login = $login;
		$this->haslo = $haslo;
		$this->email = $email;
	}
	public function getVars() {
		return get_object_vars($this);
	}
}
class Osoba{
	public $userId;
	public $imie;
	public $nazwisko;
	public $telefon;
	public $adres;
	public $email;
	public function __construct($userId = '', $imie = '', $nazwisko = '', $telefon = '', $adres = '', $email = '') {
		$this->userId = $userId;
		$this->imie = $imie;
		$this->nazwisko = $nazwisko;
		$this->telefon = $telefon;
		$this->adres = $adres;
		$this->email = $email;
	}
	public function getVars() {
		 return get_object_vars($this);
	}
}
// Model baza którego jedynym zadaniem jest praca z bazą i zwracanie wyników
class baza{
	var $db;
	var $collection;
	var $dbcol;
	var $model;
	public function connect() {
		$m = new Mongo();
		$this->db = $m->selectDB('test');
		$this->dbcol = $this->db->selectCollection($this->collection);
	}
	public function find($query = array()) {
		return $this->dbcol->find($query);
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
	public function remove($criteria = array(), $options = array()) {
		return $this->dbcol->remove($criteria, $options);
	}
	public function findOne($query = array(), $fields = array()) {
		return $this->dbcol->findOne($query, $fields);
	}
	
}
class dbUser{
	var $baza;
	public function __construct() {
		$this->baza = new baza();
		$this->baza->collection = 'user';
		$this->baza->connect();
	}
	public function createObjectFromArr($arr) {
		$user = new User();
		foreach($user->getVars() as $key => $val) {
			// ta linijka odpowiada za przepisanie tablicy do obiektu
			if($key == 'haslo')
				@$user->{$key} = ($arr[$key])?(sha1($arr[$key])):'';
			else
				@$user->{$key} = ($arr[$key])?($arr[$key]):'';
		}
		return $user;
	}
	public function checkLogin($login) {
		$x = $this->baza->runCommand(array("count" => $this->baza->collection, "query" => array("login" => $login)));
		return $x['n'];
	}
	public function checkLoginPassword($login, $haslo) {
		$x = $this->baza->runCommand(array("count" => $this->baza->collection, "query" => array("login" => $login, "haslo" => sha1($haslo))));
		//var_dump($x);
		if($x == 0) return false;
		else {
			$y = $this->baza->findOne(array("login" => $login, "haslo" => sha1($haslo)));
			//var_dump($y);
			return $y['_id'];
		}
	}
	public function add($arr) {
		$this->baza->insert($this->createObjectFromArr($arr));
	}
}
// kontroler db, to jego wywołujemy z pliku widoku
// ogólnie powinniśmy tutaj renderować pliki widoku jak to jest w mvc ale nie zdąże tego ogarnąć do środy :p
class db{
	var $baza;
	public function __construct() {
		$this->baza = new baza();
		$this->baza->collection = 'projekt';
		$this->baza->connect();
	}
	// zamieniamy tablicę na obiekt tak, że do pola obiektu o danej nazwie 'x' przypisujemy wartość
	// z tablicy $arr o kluczu o tej samej nazwie 'x'
	public function createObjectFromArr($arr) {
		$osoba = new Osoba();
		foreach($osoba->getVars() as $key => $val) {
			// ta linijka odpowiada za przepisanie tablicy do obiektu
			@$osoba->{$key} = ($arr[$key])?($arr[$key]):'';
		}
		return $osoba;
	}
	// zamieniamy tablicę dwuwymiarową na tablicę obiektów
	public function createObjectFromArr2($arr) {
		$i = 0;
		foreach($arr as $key => $val) {
			$osoba = new Osoba();
			$ret[$key] = $this->createObjectFromArr($val);
		}
		return @$ret;
	}
	// zakładamy że otrzymujemy tablice w postaci Imie => JakiesImie, Nazwisko => JakiesNazwisko itd
	public function addOsoba($arr) {
		$this->baza->insert($this->createObjectFromArr($arr));	
	}
	public function updateOsoba($which, $new) {
		$this->baza->update($this->createObjectFromArr($which), $this->createObjectFromArr($new));
	}
	public function updateOsobaById($id, $new) {
		$this->baza->update($id, $this->createObjectFromArr($new));
	}
	public function deleteOsoba($arr = array()) {
		$this->baza->remove($this->createObjectFromArr($arr));
	}
	public function deleteId($arr) {
		$this->baza->remove($arr);
	}
	public function listOsoby($where = array()) {
		return $this->createObjectFromArr2(iterator_to_array($this->baza->find($where)));
	}
	public function removeAll() {
		$this->baza->remove();
	}
	public function returnModel() {
		$osoba = new Osoba();
		return $osoba->getVars();
	}
	public function getOneOsoba($criteria = array(), $fields = array()) {
		return $this->createObjectFromArr($this->baza->findOne($criteria, $fields));
	}
}
?>