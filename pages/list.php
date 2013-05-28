<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script src="js/jquery.metadata.js"></script>
<script src="js/jquery.tablesorter.min.js"></script>
<script src="js/tabelka.js"></script>
<div id="content">
	<div class="post">
		<?php
		require('class.inc.php');
		$db = new db();
		$osoby = $db->listOsoby(array('userId' => $_SESSION['id']));		?>
			
			<div class="entry">
					<h2 class="title">Lista kontaków</h2>
								
										<div id="listuser">
											<table id="lista" class="standard tablesorter">
											<thead>
												<tr>
													<th></th>
													<th>Nazwisko</th>
													<th>Imię</th>
													<th>Telefon</th>
													<th>Akcje</th>
													<th></th>
													<th></th>
													<th style="display:none"></th>
													<th style="display:none"></th>
													<th style="display:none"></th>
												</tr>
											</thead>
											<tbody>

												<?php if(is_array($osoby)):
												foreach($osoby as $key => $val):	
												$osoba = $val; ?>
												<tr>
												<td><a href="?contact&id=<?=$key?>"><img src="img/User-icon.png"  alt="" /></a></td>
												<td class="val" name="nazwisko"><?= $osoba->nazwisko; ?></td>
												<td class="val" name="imie"><?= $osoba->imie; ?></td>
												<td class="val" name="telefon"><?=$osoba->telefon; ?></td>
												<td class="val" name="adres" style="display:none"><?=$osoba->adres; ?></td>
												<td class="val" name="email" style="display:none"><?=$osoba->email; ?></td>
												<td class="val" name="userId" style="display:none"><?=$_SESSION['id']; ?></td>
												<td><a href="?save&remove=<?=$key?>">Usuń</td>
												<td><a href="#" class="edytuj">Edytuj</a></td>
												<td><a href="#" key="<?=$key?>" class="zapisz">Zapisz</a></td>
												
												
												</tr>
												<?php endforeach; endif; ?>
											</tbody>
											</table>
										
										</div>
								
							
			</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->

<div style="clear: both;">&nbsp;</div>