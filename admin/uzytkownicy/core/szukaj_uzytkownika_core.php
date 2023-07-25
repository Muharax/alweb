<style>
	.pagina{
		padding:5px;
		width: 2%;
    	margin: 0px 5px 0px 0px;
	}
</style>


<script>
$(document).on("click", '.pagina', function() {
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

// let table = new DataTable('#example');
$('#example').dataTable({
	searching: false,
	paging: false,
	ordering: false,
	info:false,
});

</script>

<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
	require('../../../session.php');
	$limit = 10;
	$query = "SELECT count(*) FROM `users`";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);
if (!isset($_POST['nr'])) {
	$page = 1;
} else{
    $page = $_POST['nr'];
}
$starting_limit = ($page-1)*$limit;
$show  = "SELECT * FROM users ORDER BY `id` ASC LIMIT ?,?";
$r = $db->prepare($show);
$r->execute([$starting_limit, $limit]);
echo '<button class="pagina" href="#" id='.($page-1).'><</button>';
// for ($page=1; $page <= $total_pages ; $page++):
echo '<button class="pagina" href="#" id='.$page.'>'.$page.'</button>';
// endfor;
echo '<button class="pagina" href="#" id='.($page+1).'>></button>';
echo '<div id="white">

	<table id="example">
	<thead>
		<tr>
			<th>Nazwa</th>
			<th>Pkt</th>
			<th>Uprawnienia</th>
			<th>Logowania</th>
			<th>Opcje</th>
		</tr>
		</thead>
		<tbody>';

while($res = $r->fetch(PDO::FETCH_ASSOC)):

echo '<tr>				
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


exit;
}

?>
