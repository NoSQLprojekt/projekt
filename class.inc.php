<?php
/* Obsługa strony po stronie serwera */
// Obiekt osoba
class Osoba{
	public $imie;
	public $nazwisko;
	public $telefon;
	public $adres;
	public $email;
	public function __construct($imie = '', $nazwisko = '', $telefon = '', $adres = '', $email = '') {
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
	public function findOne($query = array(), $fields = array()) {
		return $this->dbcol->findOne($query, $fields);
	}
	
}
class Test{
	public $baza;
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
	public function modelTestCrud() {
		// Dodawanie przy użyciu naszego obiektu Osoba
		// dodając z widoku dodajemy dane jako tablica która potem jest zmieniona na obiekt, przykład w index.php
		$this->baza->remove();
		$this->baza->insert(new Osoba("Michał", "Jackowski"));
		// dopiszmy nr telefonu do naszej osoby
		$this->baza->update(new Osoba("Michał", "Jackowski"), new Osoba("Michał", "Jackowski", "654123123"));
		$x = iterator_to_array($this->baza->find());
		var_dump($x);
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
		return $ret;
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
	public function listOsoby($where = "") {
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