<?php 
	require 'mysql.php';

	//On commence une session pour que avoir une session personnalisé pour chaque utilisateur
	session_start();
	
	//On filtre les variables post
	$options = array(
			'email-pseudo' => FILTER_SANITIZE_EMAIL
		);
	$arr_login_sani = filter_input_array(INPUT_POST, $options);
	if(isset($_POST['login'])) {
		try 
		{
			$sql = "SELECT * FROM `users` WHERE users.email ='".$arr_login_sani['email-pseudo']."' OR users.pseudo ='".$arr_login_sani['email-pseudo']."'" ;
			$req = $db->query($sql);
			$fetch_db_for_comparison = $req->fetchAll(PDO::FETCH_ASSOC);

			//Vérifier si le pseudo ou le mail existe
			if($fetch_db_for_comparison) 
			{
				//Vérifie si l'utilisateur a mis le bon mdp
				if(password_verify($_POST['password'], $fetch_db_for_comparison[0]['password'])) 
				{
					$_SESSION['id'] = $fetch_db_for_comparison[0]['pk_id'];
					$_SESSION['pseudo'] = $fetch_db_for_comparison[0]['pseudo'];
					$_SESSION['email'] = $fetch_db_for_comparison[0]['email'];

					header('Location: logged.php');
				}
				else
				{
					$message_erreur_password = 'Votre mot de passe est erronée, veuillez essayer à nouveau.';
				}
			}
			else
			{
				$message_erreur = "Ce compte n'existe pas. Veuillez vous inscrire si vous n'avez pas encore de compte";
			}
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<!--css links-->
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class='chatbox__login'>
      <p><a href="login.php">Login</a></p>
      <p><a href="../../index.php">Home</a></p>
    </div>
	<div class="container container_resize">
		<h1>Login</h1>
		<div class="chatbox__user-list position_register">
			<form method="POST" action="">
				
				<label for="email-pseudo">Votre e-mail ou pseudo:</label>
				<br/>
				<input type="text" id="email-pseudo" name="email-pseudo" class="long_inputs">
				<br/>
				
				<label for="password">Mot de passe:</label>
				<br/>
				<input type="password" name="password" class="long_inputs">
				<br/>
				
				<input type="submit" name="login" class="long_inputs">
			</form>
		</div>
	</div>
</body>
</html>