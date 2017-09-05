<?php
	require_once 'mysql.php';

	if(isset($_GET['message'])) {
		$message = filter_var($_GET['message'], FILTER_SANITIZE_STRING);
		if(isset($_GET['pseudo'])) 
		{
			$pseudo = filter_var($_GET['pseudo'], FILTER_SANITIZE_STRING);
		}
	

		if(isset($_GET['submit'])) {
			$user->writeMessage($message, $pseudo);
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ecrire Mess</title>
</head>
<body>
	<form action="">
		<label for="pseudo">Votre pseudo:</label>
		<br>
		<input type="text" id="pseudo" name="pseudo">
	
		<br>
		<label for="message">Votre message:</label>
		<br>
		<textarea id="message" name="message"></textarea>
		<br>
		<input type="submit" name="submit">
	</form>
	<p><a href="logout.php">Logout</a></p>

</body>
</html>