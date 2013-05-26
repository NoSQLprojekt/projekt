<html>

<head>
  <title>Rejestracja</title>
</head>

<body>
<form action="#" name="form" method="POST">
          <br />
          	<input type="text" name="login"  size="20">
                <input type="text" name="haslo"  size="20">
                
          <input type="submit" name="submit" value="Send!">
</form>

<pre><?php
require('class.inc.php');
$user = new dbUser();
	// $connection = new Mongo();
	// $db = $connection->selectDB( "testowa" );
	// $collection = $db->selectCollection( "test" );


if (isset($_POST['submit'])){
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
	// $count = 0;

	//---- Sprawdzanie loginu----//

	// $check = $db->command(array("distinct" => "test", "key" => "login"));
	// foreach ($check['values'] as $log) {
		// if ($log == $login) {
			// $count=$count + 1;
		// }
 	// }
	//----wpisanie do bazy------//
	if ($user->checkLogin($login) == 0) {
		// $person = array("login" => $login, "password" => $password);
		$user->add($_POST);
		// $collection->insert($person);
		print "udana rejestracja. Mozesz sie teraz zalogowac";
	}
	else {
		print "Taki login juz istnieje!!! Wybierz inny";
	}

}

?>
</pre>
</body>
</html>
