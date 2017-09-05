<?php
	require_once "mysql.php";
	

	if(isset($_POST['submit'])) {
		
		//Validation de tous les champs
		if(isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['psw_confirm'])){

			//Sanitisation (pas besoin pour le mdp car il sera hash dans la db)
			$pwd = $_POST['psw'];
			$pwd2 = $_POST['psw_confirm'];		
			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

			if ($pwd == $pwd2) {
		
				//Pour vérifier si le compte existe déjà (si le mail existe alors il ne peut pas l'enregistrer)
				if($user->checkIfEmailExists($email))
				{
					$message_mail = "<p>Ce mail existe déjà!</p>";
				} 
				else 
				{
					try
					{
						$user->register($email, $pwd);

					}	
					catch(Exception $e)
					{
						die('Erreur : '.$e->getMessage());
					}
					$user->redirect('login.php');				
				}
			} else {
				$messagePwdNotMatching = "<p>Vos 2 mots de passes ne correspondent pas, veuillez essayer à nouveau.</p>";
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
	<title>Register</title>
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
	
		<br>
		<label for="password_confirm">Confirm your password:</label>
		<br>
		<input type="password" name="psw_confirm" id="password_confirm">
		
		<?php if(isset($messagePwdNotMatching)) { echo $messagePwdNotMatching; } ?>
		
		<br>
		<input type="submit" name="submit" id="submit" value="Create Account">
		
		<?php if(isset($message_champs)) { echo $message_champs; } ?>
	</form>

	<p><a href="login.php">Home</a></p>


</body>
</html>