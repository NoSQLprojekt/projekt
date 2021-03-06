<?php
session_start();
?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Książka adresowa</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="menu-wrapper">
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="?">Strona Główna</a></li>
			<li><a href="?statistics">Statystyki</a></li>
			<?php if(!isset($_SESSION['login'])): ?> <li><a href="?login">Logowanie</a></li> <?php endif; ?>
			<?php if(isset($_SESSION['login'])): ?><li><a href="?add">Dodaj kontakt</a></li>
			<li><a href="?list">Lista kontaktów</a></li>
			<li><a href="?logout">Wyloguj</a></li><?php endif; ?>
			
		</ul>
	</div>
	<!-- end #menu -->
</div>

<div id="wrapper">
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<?php
					if(empty($_SERVER['QUERY_STRING'])) {
							include('pages/main.php');
					} else {
						$query = explode('&', $_SERVER['QUERY_STRING']);
						if(file_exists('pages/'.$query[0] .'.php')) {
							include('pages/'.$query[0] .'.php');
						}
						else {
							include('pages/page404.php');
							//echo 'Błąd 404 nie ma takiej strony';
						}
					}
				?>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>

</body>
</html>
