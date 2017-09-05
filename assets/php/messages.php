<?php
	require_once 'mysql.php';	

	$page = $_SERVER['PHP_SELF'];
	$sec = "3";
	header("Refresh: $sec; url=$page");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Messages</title>

	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<article>
<?php
	//The paramater true or false will indicate if it shows the content or not
	$user->fetchMessageFromDb(true);

?>	
</article>	
</body>
</html>