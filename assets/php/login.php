<?php
	require_once "mysql.php";

		if(isset($_POST['submit'])) {
		
		//Validation de tous les champs
		if(isset($_POST['email']) && isset($_POST['psw']))
		{

			//Sanitisation (pas besoin pour le mdp car il sera hash dans la db)
			$pwd = $_POST['psw'];
			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		
				//Pour vérifier si le compte existe déjà (si le mail existe alors il ne peut pas l'enregistrer)
				if($user->checkIfEmailExists($email))
				{
					if($user->login($email, $pwd)) 
					{
						$user->redirect('ecrireMess.php');
					}
					else 
					{
						$message_mdp = "<p>Votre mot de passe est erronée</p>";
					}
				} 
				else 
				{
					$message_mail = "<p>Aucun compte n'est enregistré avec ce mail</p>";		
				}

		}else {
			$message_champs = "<p>Veuillez remplir tous les champs</p>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<form action="" method="POST">
		<label for="email">Your email:</label>
		<br>
		<input type="text" name="email" id="email">
		<?php if(isset($message_mail)) { echo $message_mail; } ?>
		<br>
		
		<label for="password">Your password:</label>
		<br>
		<input type="password" name="psw" id="password">
		<?php if(isset($message_mdp)) { echo $message_mdp; } ?>
		<br>
		<input type="submit" name="submit" id="submit" value="login">
	</form>

	<p>No account? <a href="register.php">Sign up!</a></p>
</body>
</html>