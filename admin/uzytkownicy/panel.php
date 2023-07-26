<style>
	#PANEL-DANE{
		margin-bottom: 20px;
		margin-top:8px;
	}
</style>
<?php
	// require ('../session.php');
?>
	<div id="PANEL">
		<button id="szukaj" class="btn btn-info btn-sm">Szukaj</button>
		<button id="dodajUzytkownika" class="btn btn-light btn-sm">Przyjęcie</button>
		<button id="zwolnienie" class="btn btn-light btn-sm">Zwolnienie</button>
		<button id="pokaz" class="btn btn-light btn-sm">Pokaż</button>
	</div>

	<div id="PANEL-DANE"></div>



<script>

$(document).on({
	ajaxStart: function() {  $(".overlay").addClass('animation');},
	ajaxStop: function() {	$(".overlay").removeClass('animation'); 
}    
});


$(document).on("click", '#szukaj', function() {
	$('#PANEL button').removeAttr('disabled');
	$.ajax({
		type: "POST",
		url: URL+'/admin/uzytkownicy/core/szukaj_uzytkownika_core.php',
		dataType:'text',
		success: function(msg){
			$("#PANEL-DANE").html(msg);
			$("#example").addClass('table table-dark');
			$('#szukaj').attr('disabled', true);
		},
	})
});

$(document).on("click", '#dodajUzytkownika', function() {
	$('#PANEL button').removeAttr('disabled');
	$.ajax({
		type: "POST",
		url: URL+'/admin/uzytkownicy/core/szukaj_uzytkownika_core.php',
		dataType:'text',
		success: function(msg){
			$("#PANEL-DANE").html(msg);
			$('#dodajUzytkownika').attr('disabled', true);
		},
	})
});

$(document).on("click", '#zwolnienie', function() {
	$('#PANEL button').removeAttr('disabled');
	$.ajax({
		type: "POST",
		url: URL+'/admin/uzytkownicy/core/szukaj_uzytkownika_core.php',
		dataType:'text',
		success: function(msg){
			$("#PANEL-DANE").html(msg);
			$('#zwolnienie').attr('disabled', true);
		},
	})
});

$(document).on("click", '#pokaz', function() {
	$('#PANEL button').removeAttr('disabled');
	$.ajax({
		type: "POST",
		url: URL+'/admin/uzytkownicy/core/szukaj_uzytkownika_core.php',
		dataType:'text',
		success: function(msg){
			$("#PANEL-DANE").html(msg);
			$('#pokaz').attr('disabled', true);
		},
	})
});


</script>

