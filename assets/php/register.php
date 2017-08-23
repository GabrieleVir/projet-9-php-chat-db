<?php 
	require 'mysql.php';

	$options = array(
		'email' => FILTER_SANITIZE_EMAIL,
		'pseudo' => FILTER_SANITIZE_STRING
		);
	$arr_sani = filter_input_array(INPUT_POST ,$options);



	if(isset($_POST['submit'])) {
		$pwd1 = $_POST['password1'];
		$pwd2 = $_POST['password2'];

		if ($pwd1 == $pwd2) {
			//Pour vérifier si le compte existe déjà 
			$sql_mail = "";
			$req_mail = $db->query("SELECT * FROM `users` WHERE email='".$arr_sani['email']."'");
			$req_mail_fetch = $req_mail->fetch(PDO::FETCH_ASSOC);

			if($req_mail_fetch) {			
				$message_mail = 'Ce mail existe déjà!';
			} else {
				try
				{
					$sql = "INSERT INTO users(pseudo, email, password) VALUES(?,?,?)";
					$req = $db->prepare($sql);
					$req->execute(array($arr_sani['pseudo'], $arr_sani['email'], password_hash($pwd1, PASSWORD_DEFAULT)));
					$req->closeCursor();
				}	
				catch(Exception $e)
				{
					die('Erreur : '.$e->getMessage());
				}
				header('Location: login.php');
								
			}

		} else {
			$messagePwdNotMatching = 'Vos 2 mots de passes ne correspondent pas, veuillez essayer à nouveau.';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>

	<!--css links-->
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class='chatbox__login'>
      <p><a href="login.php">Login</a></p>
      <p><a href="../../index.php">Home</a></p>
    </div>
	<div class="container container_resize">
		<h1>Register</h1>
		<div class="chatbox__user-list position_register">
			<form method="POST" action="">
				<label for="email">Votre e-mail:</label>
				<br/>
				<input type="text" id="email" name="email" class="long_inputs">
				<br/>
				
				<label for="pseudo">Pseudo:</label>
				<br/>
				<input type="text" id="pseudo" name="pseudo" class="long_inputs">
				<br/>

				<label for="password1">Mot de passe:</label>
				<br/>
				<input type="password" name="password1" class="long_inputs">
				<br/>

				<label for="email">Confirmer votre mot de passe:</label>
				<br/>
				<input type="password" name="password2" class="long_inputs">
				<br/>
				
				<input type="submit" name="submit" class="long_inputs">
				<?php if(isset($messagePwdNotMatching)): ?>
					<p class="alert"><?= $messagePwdNotMatching; ?></p> 
				<?php endif; ?>
				<?php if(isset($message_mail)): ?>
					<p class="alert"><?= $message_mail; ?></p>
				<?php endif; ?> 

			</form>
		</div>
	</div>
</body>
</html>