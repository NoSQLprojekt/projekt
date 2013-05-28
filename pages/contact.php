<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script>
$(document).ready(function () {
	$(".zapisz").hide();
	$(".edytuj").click(function() {
		$(".edytuj").hide();
		$(".zapisz").show();
		$("#background-image").find(".val").each(function(i) {
			var name = $(this).attr('name'), value = $(this).html();
			$(this).html('<input type="text" value="' + value + '" name="' + name + '" style="width:180px">');
		});
	});
	$(".zapisz").click(function() {
		var osoba = new Object();
		$(this).hide();
		$(".edytuj").show();
		$("#background-image").find(".val").each(function() {
			var value = $(this).find("input").val(), name = $(this).find("input").attr('name');
			osoba[name] = value;
			$(this).html(value);
		});
		$.post('index.php?save&edit&id=<?=$_GET['id']?>', osoba);
	});
});</script>
<div id="content">
	<div class="post">
		<?php
		require('class.inc.php');
		$db = new db();
		$osoba = $db->getOneOsoba(array("_id" => new MongoId($_GET['id'])));
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
													<td class="val" name="userId" style="display:none"><?=$_SESSION['id']; ?></td>
												</tbody>
											</table>
											<p class="submit">  
														<input class="edytuj" type="submit" name="submit" value="Edytuj" />  
														<input class="zapisz" type="submit" name="submit" value="Zapisz" />  
											</p>
											
											
											
											
											
											
											
											
											
									
										
										</div>
								
							
			</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->

<div style="clear: both;">&nbsp;</div>