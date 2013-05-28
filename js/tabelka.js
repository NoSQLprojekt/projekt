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