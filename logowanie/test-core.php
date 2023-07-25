<?php 
		require_once ('../database/db.php');
		
		$z1 = $_POST['z1'];
		$zadanie = $db_PDO->prepare('SELECT * FROM `users` WHERE `EAN`= :name LIMIT 1');
		$zadanie->execute([ ':name' => $z1 ]);
		
		$i = $zadanie->rowCount();
		if($i === 1){
			$wiersz = $zadanie->fetch();					
			echo $wiersz['user'];
			session_start();
		
			$_SESSION['zalogowany'] 	= true;
			$_SESSION['ready'] 			= "ready";
			$_SESSION['id'] 			= $wiersz['id'];
			$_SESSION['user'] 			= $wiersz['user'];
			$_SESSION['imie'] 			= $wiersz['imie'];
			$_SESSION['nazwisko'] 		= $wiersz['nazwisko'];
			$_SESSION['uprawnienia'] 	= $wiersz['uprawnienia'];
			$_SESSION['pkt'] 			= $wiersz['pkt'];
			$_SESSION['logo'] 			= $wiersz['logo'];
			
			$logowania 					= $wiersz['logowania'];
			$user 						= $wiersz['user'];
			$log 						= $logowania + 1;
			
			$zadanie = $db_PDO->prepare('UPDATE `users` SET `logowania`= :log  WHERE user = :user');
			$zadanie->bindParam(':log', $log, PDO::PARAM_INT);
			$zadanie->bindParam(':user', $user, PDO::PARAM_STR);
			$zadanie->execute();
			exit;
		}else{
			echo 'BŁĄD';
			exit;
		}
		
								
		


?>
