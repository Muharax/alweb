<?php
	
	include ('init.php');
	session_start();

	if(!isset($_SESSION['zalogowany']) || $_SESSION['user'] == null){
		header('Location: '.URL.'logowanie/logowanie.php');
		exit;
	}
	
	if(isset($_SESSION['alert'])) echo $_SESSION['alert'];
	unset($_SESSION['alert']);
		
	$_SESSION['token'] = md5(microtime(true).mt_Rand());
	include('db.php');	
	

?>
<script>
	var pathname = window.location.pathname; // Returns path only (/path/example.html)
	var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
	var origin   = window.location.origin;   // Returns base URL (https://example.com)
	var URL		 = window.location.origin+'/<?php echo $pageName;?>';   // Returns base URL (https://example.com)
	console.log(URL);
</script>
