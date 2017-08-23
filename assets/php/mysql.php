<?php 
	try
	{
		//permet d'ouvrir la db et d'afficher les erreurs
		$db = new PDO('mysql:host=localhost;dbname=becode_minichat;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}	
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
?>