<?php 

	include ('../init.php');

	session_start();
	
	if(isset($_SESSION['zalogowany']) && $_SESSION['user'] !== null){
		header('Location: ../index.php');
		exit;
	}
	
	$L777 					= md5(microtime(true).mt_Rand());
	$_SESSION['token'] 		= password_hash($L777, PASSWORD_DEFAULT);

	include('../header.php');
	
?>




<div id="LOGOWANIE">
<?php if(isset($_SESSION['alert'])) echo $_SESSION['alert']; 
		unset($_SESSION['alert']);
?>
<div class="LG">
	<div class="logos">
		<img src="<?php echo URL;?>img/skynet.png" alt="" class="logos-SWG">
	</div>
	
	<div id="logowanie-s">
		<form action="zaloguj.php" method="POST">

			<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">

			<div id="name">
				<i class="material-icons prefix cwhite">apps</i>
				<input type="text" id="first" autocomplete="off" autofocus="On" name="user" placeholder="Login" value="ADMIN11" class="w100" required>
			</div>
					
			<div id="pass">
				<i class="material-icons prefix cwhite">lock</i>
				<input type="password" id="second" autocomplete="off" name="pass" placeholder="Hasło" value="admin"  class="w100" required>
			</div>
			
			<div id="btn-log-in">
				<div class="wrapper">
					<div class="box">
						<button type="submit" class="log-in" id="sub">Sign In</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>

<!-- <div class="reg"><a href="<?php echo URL;?>logowanie/rejestracja.php">Rejestracja</a></div> -->


	
<?php require('../footer.php');?>

<script>

</script>