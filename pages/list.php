<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script src="js/jquery.metadata.js"></script>
<script src="js/jquery.tablesorter.min.js"></script>
<script>
		$(document).ready(function () {
			$(".zapisz").hide();
			$(".edytuj").click(function() {
				$(this).parent().parent().find(".zapisz").show();
				$(this).parent().parent().children(".val").each(function(i) {
					var name = $(this).attr('name'), value = $(this).html();
					$(this).html('<input type="text" size="20" value="' + value + '" name="' + name + '" style="width:120px">');
				});
			});
			$(".zapisz").click(function() {
				var osoba = new Object();
				$(this).hide();
				$(this).parent().parent().children(".val").each(function() {
					var value = $(this).find("input").val(), name = $(this).find("input").attr('name');
					osoba[name] = value;
					$(this).html(value);
				});
				$.post('index.php?save&edit&id=' + $(this).attr('key'), osoba);
				$("#lista").trigger("update"); 
				var sorting = [[1,0]];
				$("#lista").trigger("sorton",[sorting]); 
			});
			$("#lista").tablesorter({
				widgets: ['zebra'],
				sortList:[[1,0]],
				headers:{0:{sorter: false}, 4:{sorter:false}, 5:{sorter:false}, 6:{sorter:false}}
			}); 
		});
</script>
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
												<td><img src="img/User-icon.png"  alt="" /></td>
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