<html>
<head>
	<title>CRUD</title>
	<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
	<script>
		$(document).ready(function () {
			$(".zapisz").hide();
			$(".edytuj").click(function() {
				$(this).parent().parent().find(".zapisz").show();
				$(this).parent().parent().children(".val").each(function(i) {
					var name = $(this).attr('name'), value = $(this).html();
					$(this).html('<input type="text" value="' + value + '" name="' + name + '">');
				});
			});
			$(".zapisz").click(function() {
				var osoba = new Object();
				$(this).hide();
				$(this).parent().parent().children(".val").each(function(i) {
					var value = $(this).find("input").val(), name = $(this).find("input").attr('name');
					osoba[name] = value;
					$(this).html(value);
				});
				$.post('edit.php?id=' + $(this).attr('key'), osoba);
			});
		});
	</script>
</head>
<body>
<?php
require('class.inc.php');
$db = new db();
if(empty($_SERVER['QUERY_STRING'])) {
	echo '<a href="?add">Dodaj usera</a><br>';
	
	echo 'Lista wszystkich userów: <br>';
	echo '<table><tr><td>Imię</td><td>Nazwisko</td><td>Telefon</td><td>Adres</td><td>Email</td></tr>';
	$osoby = $db->listOsoby();
	foreach($osoby as $key => $val) {
		$osoba = $val;
		echo '<tr><td class="val" name="imie">'.$osoba->imie.'</td>
		<td class="val" name="nazwisko">'.$osoba->nazwisko.'</td>
		<td class="val" name="telefon">'.$osoba->telefon.'</td>
		<td class="val" name="adres">'.$osoba->adres.'</td>
		<td class="val" name="email">'.$osoba->email.'</td>
		<td><a href="?remove='.$key.'">Usuń</td>
		<td><a href="#" class="edytuj">Edytuj inline</a></td>
		<td><a href="?update='.$key.'">Edytuj</td>
		<td><a href="#" key="'.$key.'" class="zapisz">Zapisz</a></td>
		</tr>';
	}
	echo '</table>';
}
if(isset($_GET['add'])) {
	echo '<table><form action="?add" method="post">';
	echo '<tr><td>Imię:</td><td><input type="text" name="imie" size="100"></td></tr>';
	echo '<tr><td>Nazwsko:</td><td><input type="text" name="nazwisko" size="100"></td></tr>';
	echo '<tr><td>Telefon:</td><td><input type="text" name="telefon" size="100"></td></tr>';
	echo '<tr><td>Adres:</td><td><input type="text" name="adres" size="100"></td></tr>';
	echo '<tr><td>Email:</td><td><input type="text" name="email" size="100"></td></tr>';
	echo '<tr><td colspan="2"><input type="submit" name="submit" value="submit"></td></tr>';
	echo '</form></table>';
	if(isset($_POST['submit'])) {
		$db->addOsoba($_POST);
		header("Location: ?");
	}
}
if(!empty($_GET['remove'])) {
	$db->deleteId(array("_id" => new MongoId($_GET['remove'])));
	header("Location: ?");
}
if(!empty($_GET['update'])) {
	$osoba = $db->getOneOsoba(array("_id" => new MongoId($_GET['update'])));
	echo '<table><form action="?update='.$_GET['update'].'" method="post">';
	echo '<tr><td>Imię:</td><td><input type="text" name="imie" size="100" value="'.$osoba->imie.'"></td></tr>';
	echo '<tr><td>Nazwsko:</td><td><input type="text" name="nazwisko" size="100" value="'.$osoba->nazwisko.'"></td></tr>';
	echo '<tr><td>Telefon:</td><td><input type="text" name="telefon" size="100" value="'.$osoba->telefon.'"></td></tr>';
	echo '<tr><td>Adres:</td><td><input type="text" name="adres" size="100" value="'.$osoba->adres.'"></td></tr>';
	echo '<tr><td>Email:</td><td><input type="text" name="email" size="100" value="'.$osoba->email.'"></td></tr>';
	echo '<tr><td colspan="2"><input type="submit" name="submit" value="submit"></td></tr>';
	echo '</form></table>';
	if(isset($_POST['submit'])) {
		$db->updateOsobaById(array("_id" => new MongoId($_GET['update'])), $_POST);
		header("Location: ?");
	}
}

?>
</body>
</html>