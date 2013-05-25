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
			$("#lista").tablesorter({
				widgets: ['zebra'],
				sortList:[[1,0]],
				headers:{0:{sorter: false}, 3:{sorter:false}, 4:{sorter:false}, 5:{sorter:false}}
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
											<table id="lista" class="standard tablesorter">
											<thead>
												<tr>
													<th></th>
													<th>Nazwisko</th>
													<th>Imię</th>
													
													<th>Akcje</th>
													<th></th>
													<th></th>
												</tr>
											</thead>
											<tbody>

												<?php foreach($osoby as $key => $val):	
												$osoba = $val; ?>
												<tr>
												<td><img src="User-icon.png"  alt="" /></td>
												<td class="val" name="nazwisko"><?= $osoba->nazwisko; ?></td>
												<td class="val" name="imie"><?= $osoba->imie; ?></td>
												<td><a href="save.php?remove=<?=$key?>">Usuń</td>
												<td><a href="#" class="edytuj">Edytuj inline</a></td>
												<td><a href="#" key="<?=$key?>" class="zapisz">Zapisz</a></td>
												
												
												</tr>
												<?php endforeach;  ?>
											</tbody>
											</table>
										
										</div>
								
							
			</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->

<div style="clear: both;">&nbsp;</div>