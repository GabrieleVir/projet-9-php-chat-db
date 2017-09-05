<?php
	require_once 'assets/php/mysql.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Octochat Becodien</title>

	<!-- css links-->
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<article>
		<div class="messages">
			<iframe src="assets/php/messages.php" class="iframes" frameborder="0"></iframe>	
		</div>

		<div class="login_position ecrireMess">
			<?php 
				if(isset($_SESSION)):
			?>
				<iframe src="assets/php/ecrireMess.php" class="iframes" frameborder="0"></iframe>	
			<?php
				else:
			?>
				<iframe src="assets/php/login.php" class="iframes" frameborder="0"></iframe>
			<?php
				endif;
			?>
		</div>
	</article>
	
		
</body>
</html>