$(document).ready(function(){
/***********************************************************/
	$("#menu li").click(function(){
		$(this).children(":hidden").slideToggle();
	}, function(){
		$(this).parent().find("ul").slideToggle();
	});
/***********************************************************/
$('select').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var nameSelected = $(this).attr('name');
    var idSelected = $(this).attr('id');
    console.log(idSelected);
    $.post('includes/ajax.php',
			{value_selected:valueSelected, name_selected:nameSelected, id_selected:idSelected}, function(data){
				console.log(data);
			});
});
/***********************************************************/
});