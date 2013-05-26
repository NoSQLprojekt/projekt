<html>

<head>
  <title>Rejestracja</title>
</head>

<body>
<form action="#" name="form" method="POST">
          <br />
          	<input type="text" name="login"  size="20">
                <input type="text" name="password"  size="20">
                
          <input type="submit" name="sub" value="Send!">
</form>

<pre><?php
	
	$connection = new Mongo();
	$db = $connection->selectDB( "testowa" );
	$collection = $db->selectCollection( "test" );


	if ($_POST['sub']){
		$login=$_POST['login'];
		$password=$_POST['password'];
		$count = 0;

//---- Sprawdzanie loginu----//

		$check = $db->command(array("distinct" => "test", "key" => "login"));
		foreach ($check['values'] as $log) {
		     		
		if ($log == $login){
			$count=$count + 1;}
		

 	}
//----wpisanie do bazy------//
	if ($count == 0){
	$person = array("login" => "$login", "password" => "$password");
	$collection->insert($person);
		print "udana rejestracja. Mozesz sie teraz zalogowac";
			}
	else{
	print "Taki login juz istnieje!!! Wybierz inny";
		}

	}

?>

</body>
</html>
