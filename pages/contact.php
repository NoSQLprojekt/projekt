<div id="content">
	<div class="post">
		<?php
		require('class.inc.php');
		$db = new db();
	?>
			
			<div class="entry">
					<h2 class="title">Kontakt</h2>
								
										<div id="listuser">
											<table summary="Tabela testowa" id="background-image" >
												<tbody>
												
													<tr>
													   <td id="dl">Imię:</td>
													   <td  class="val" name="imie"><?= @$osoba->imie; ?></td>
													   
													</tr>
													<tr>
													   <td>Nazwisko:</td>
													   <td  class="val" name="nazwisko"><?= @$osoba->nazwisko; ?></td>
													   
													</tr>
													<tr>
													   <td>Adres:</td>
													   <td  class="val" name="adres"><?= @$osoba->adres; ?></td>
													   
													   
													</tr>
													<tr>
													   <td>Telefon:</td>
													   <td  class="val" name="telefon"><?= @$osoba->telefon; ?></td>
													   
													</tr>
													<tr>
													   <td>Email:</td>
													   <td  class="val" name="email"><?= @$osoba->email; ?></td>
													   
													</tr>
													
												</tbody>
											</table>
											
											
											
											
											
											
											
											
											
									
										
										</div>
								
							
			</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->

<div style="clear: both;">&nbsp;</div>