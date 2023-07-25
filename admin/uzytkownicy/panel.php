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
		<button id="uzytkownicy_znajdz" class="btn btn-light btn-sm">Przyjęcie</button>
		<button id="uzytkownicy_znajdz" class="btn btn-light btn-sm">Zwolnienie</button>
		<button id="uzytkownicy" class="btn btn-light btn-sm">Pokaż</button>
	</div>

	<div id="PANEL-DANE"></div>



<script>
$(document).one("click", '#szukaj', function() {
	$.ajax({
		type: "POST",
		url: URL+'/admin/uzytkownicy/core/szukaj_uzytkownika_core.php',
		dataType:'text',
		success: function(msg){
			$("#PANEL-DANE").html(msg);
		},
	})	
	
});


</script>

