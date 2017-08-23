<?php
	require 'mysql.php';

	$req = $db->query('SELECT messages.message_content , users.pseudo FROM `messages` INNER JOIN `users` ON messages.fk_user_id = users.pk_id');
	$fetch_messages = $req->fetchAll(PDO::FETCH_ASSOC);

	foreach ($fetch_messages as $db_columns) :

?>
	<div class="chatbox__messages__user-message--ind-message">	
		<p class="name"><?= $db_columns['pseudo']; ?></p>
		<br/>
		<p class="message"><?= $db_columns['message_content'];?></p>
	</div>
<?php
	endforeach;
	
	$req->closeCursor();

?>