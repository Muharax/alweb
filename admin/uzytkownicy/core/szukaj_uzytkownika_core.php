<?php
	$startTime = microtime(true);
?>
<style>
	.pagina{
    	margin: 0px 5px 0px 0px;
	}
</style>


<script>
$(document).one("click", '.pagina', function() {
	var t2 = $('#mySelect').val();
	console.log(t2);
	var t1 = $(this).attr('id');
	$.ajax({
		type: "POST",
		data: {"nr":t1},
		url: URL+'/admin/uzytkownicy/core/szukaj_uzytkownika_core.php',
		dataType:'text',
		success: function(msg){
			$("#PANEL-DANE").html(msg);
		},
	})	
});

$("#mySelect").change(function() {
    var t1 = $(this).val();
	$.ajax({
		type: "POST",
		data: {"ile":t1},
		url: URL+'/admin/uzytkownicy/core/szukaj_uzytkownika_core.php',
		dataType:'text',
		success: function(msg){
			$("#PANEL-DANE").html(msg);
		},
	})
});


// let table = new DataTable('#example');
$('#example').dataTable({
	searching: true,
	paging: false,
	ordering: false,
	info:false,
});


</script>

<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
	require('../../../session.php');
	if(isset($_POST['ile'])){
		$limit = $_POST['ile'];
		$_SESSION['ile'] = $limit;
	}else{
		if(!isset($_SESSION['ile'])){
			$limit = 10;	
		}else{
			$limit = $_SESSION['ile'];
		}
		
	}
	
	if (!isset($_POST['nr'])) {
		$page = 1;
	} else{
		$page = $_POST['nr'];
		// $limit = $_POST['ile'];
	}
	$query = "SELECT count(*) FROM `users`";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);


echo '<div class="OPEN">';
	if($page == 1){
		echo '<button class="pagina" href="#" id='.$page.' disabled><</button>';
	}else{
		echo '<button class="pagina" href="#" id='.($page-1).'><</button>';
	}
	echo '<button class="pagina" href="#" id='.$page.'>'.$page.'</button>';
	echo '<button class="pagina" href="#" id='.$total_pages.'>'.$total_pages.'</button>';
	if($page == $total_pages){
		echo '<button class="pagina" href="#" id='.$page.' disabled>></button>';
	}else{
		echo '<button class="pagina" href="#" id='.($page+1).'>></button>';
	}
		echo'<select name="mySelect" id="mySelect">
		  <option value='.$limit.'>'.$limit.'</option>
		  <option value="10">10</option>
		  <option value="25">25</option>
		  <option value="50">50</option>
		  <option value="100">100</option>
		  <option value="200">200</option>
		</select>';
echo '</div>';

$starting_limit = ($page-1)*$limit;
$show  = "SELECT * FROM users ORDER BY `id` ASC LIMIT ?,?";
$r = $db->prepare($show);
$r->execute([$starting_limit, $limit]);
echo '<div id="white">

	<table id="example">
	<thead>
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Nazwa</th>
			<th>Pkt</th>
			<th>Uprawnienia</th>
			<th>Logowania</th>
			<th>Opcje</th>
		</tr>
		</thead>
		<tbody>';
$i = 1;
while($res = $r->fetch(PDO::FETCH_ASSOC)):
echo '<tr>				
		<td>' . $i++ . '</td>
		<td>' . $res['id'] . '</td>
		<td>' . $res['user'] . '</td>
		<td>' . $res['pkt'] . '</td>
		<td>' . $res['uprawnienia'] . '</td>
		<td>' . $res['logowania'] . '</td>
		<td>
			<button class="btn btn-warning btn-sm">Edytuj</button>
			<button class="btn btn-danger btn-sm">Usuń</button>
			<select id="fruits" name="fruits">
				<option value="apple">Zwolnij</option>
				<option value="banana">Przyjmij</option>
				<option value="orange">Opinia</option>
				<option value="mango">Iteams</option>
			</select>
					<input type="submit" value="Zatwierdź">
		</td>
	</tr>';

endwhile;

echo '</tbody>
</table>
</div>';

$totalTime = microtime(true) - $startTime;
echo $totalTime;
exit;
}

?>
