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
<div id="content">
	<div class="post">
		<?php
		require('class.inc.php');
		$db = new db();
		$osoby = $db->listOsoby();		?>
			
			<div class="entry">
					<h2 class="title">Lista kontaków</h2>
								
										<div id="listuser">
											<table class="standard">
												<tr>
													<th></th>
													<th>Nazwisko</th>
													<th>Imię</th>
													
													<th colspan="3">Akcje</th>
												</tr>

												<?php $i=1; foreach($osoby as $key => $val) {	
												$osoba = $val; ?>
												<tr style='background-color:<?= ($i++%2==0)?'#eeeeee':'#ffffff'; ?>'>
												<td><img src="User-icon.png"  alt="" /></td>
												<td class="val" name="nazwisko"><?= $osoba->nazwisko; ?></td>
												<td class="val" name="imie"><?= $osoba->imie; ?></td>
												<td><a href="save.php?remove=<?=$key?>">Usuń</td>
												<td><a href="#" class="edytuj">Edytuj inline</a></td>
												<td><a href="#" key="<?=$key?>" class="zapisz">Zapisz</a></td>
												
												
												</tr>
												<?php }  ?>
							
											</table>
										
										</div>
								
							
			</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->

<div style="clear: both;">&nbsp;</div>