<?php
		function alert($info, $color){
			return;
		}

		// function alert($info, $color){
		// if($color === 1){
		// 	$color = '#00ff08';
		// }elseif($color === 2){
		// 	$color = 'orange';
		// }elseif($color === 3){
		// 	$color = 'red';
		// }else{
		// 	$color = 'yellow';
		// }
		
		// $_SESSION['alert'] = '
		
		// <div class="orange">
		// 	<div class="info" style="color:'.$color.'">'.$info.'</div>
		// 	<button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
		// </div>';
		
	// }

	error_reporting(E_ALL);
	
	$startTime = microtime(true);
	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$min_len = 5;
		$max_len = 20;
		if(!empty($_POST['user']) && !empty($_POST['pass'])){
			$login = htmlentities($_POST['user']);
			$pass = htmlentities($_POST['pass']);
			if(strlen($pass) >= $min_len && strlen($pass) <= $max_len){
				if($login !== $pass){
					require_once ('../db.php');
					$zadanie = $db->prepare('SELECT * FROM `users` WHERE `user`=:name LIMIT 1');
					$zadanie->execute([ ':name' => $login ]);
					$ilu = $zadanie->rowCount();
					if($ilu === 1){
						$wiersz = $zadanie->fetch();
						if($login === $wiersz['user']){
							if(password_verify($pass, $wiersz['pass'])){
								session_start();
								$token = htmlentities($_POST['token']);
								if($token === $_SESSION['token']){

									$_SESSION['zalogowany'] 	= true;
									$_SESSION['ready'] 			= "ready";
									$_SESSION['id'] 			= $wiersz['id'];
									$_SESSION['user'] 			= $wiersz['user'];
									$_SESSION['imie'] 			= $wiersz['imie'];
									$_SESSION['nazwisko'] 		= $wiersz['nazwisko'];
									$_SESSION['uprawnienia'] 	= $wiersz['uprawnienia'];
									$_SESSION['pkt'] 			= $wiersz['pkt'];
									$logowania 					= $wiersz['logowania'];
									$user 						= $wiersz['user'];
									$log 						= $logowania + 1;
									
									$zadanie = $db->prepare('UPDATE `users` SET `logowania`= :log  WHERE `user` = :user');
									$zadanie->bindParam(':log', $log, PDO::PARAM_INT);
									$zadanie->bindParam(':user', $user, PDO::PARAM_STR);
									$zadanie->execute();
									$totalTime = microtime(true) - $startTime;
									
									$alert = 'Witaj '.$_SESSION['imie'];
									alert($alert,1);
									header('Location: ../index.php');
									exit;
								}else{
									alert('Token się nie zgadza',2);
									header('Location: ../logowanie/logowanie.php');
									exit;
								}
							}else{
								session_start();
								alert('Hasło nieprawidłowe',2);
								header('Location: ../logowanie/logowanie.php');
								exit;
							}
						}else{
							session_start();
							alert('Login nieprawidłowy',2);
							header('Location: ../logowanie/logowanie.php');
							exit;
						}
					}else{
						session_start();
						alert('Brak użytkownika w bazie',2);
						header('Location: ../logowanie/logowanie.php');
						exit;
					}	
				}else{
					session_start();
					alert('Login i hasło nie może być takie samo',2);
					header('Location: ../logowanie/logowanie.php');
					exit();
				}
			}else{
				session_start();
				alert('Hasło min '.$min_len.' max '.$max_len.' znaków',2);
				header('Location: ../logowanie/logowanie.php');
				exit;
			}
		}else{
			session_start();
			alert('Uzupełnij dane',2);
			header('Location: ../logowanie/logowanie.php');
			exit;
		}
	}else{
		session_start();
		alert('POST is broken',2);
		header('Location: ../logowanie/logowanie.php');
		exit;
	}


?>