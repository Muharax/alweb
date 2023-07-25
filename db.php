<?php

try
   {
      $db = new PDO('mysql:host=localhost;dbname=skynet', 'root', '', [
	  PDO::ATTR_EMULATE_PREPARES => false, 
	  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		
	]);
	  
   }
   catch(PDOException $e)
   {
      echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
   }
	

	
?>
