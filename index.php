<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Książka adresowa</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="menu-wrapper">
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="?">Strona Główna</a></li>
			<li><a href="#">Statystyki</a></li>
			<li><a href="?login">Logowanie</a></li>
			<li><a href="?add">Dodaj kontakt</a></li>
			
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
							include('main.php');
					} else {
						$query = explode('&', $_SERVER['QUERY_STRING']);
						if(file_exists($query[0] .'.php')) {
							include($query[0] .'.php');
						}
						else {
							echo 'Błąd 404 nie ma takiej strony';
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
