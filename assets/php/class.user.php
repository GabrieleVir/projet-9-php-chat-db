<?php
	class USER 
	{
		private $db;


		function __construct($DB_con) 
		{
			$this->db = $DB_con;
		}
		
		public function register($email, $password) {
			try 
			{
				$password_hashed = password_hash($password, PASSWORD_DEFAULT);

				$req = $this->db->prepare("INSERT INTO users(email,password) VALUES (?,?) ");
				$req->execute([$email, $password_hashed]);

				return $req;
			} 
			catch(PDOException $e) 
			{
				echo $e->getMessage();
			}
		}

	        public function login($email,$pass)
		    {
		       try
		       {
		          $req = $this->db->prepare("SELECT * FROM users WHERE email =:email LIMIT 1");
		          $req->execute([':email'=>$email]);
		          $userRow=$req->fetch(PDO::FETCH_ASSOC);
		          if($req->rowCount() > 0)
		          {
		             if(password_verify($pass, $userRow['password']))
		             {
		                $_SESSION['user_id'] = $userRow['pk_id'];
		                return true;
		             }
		             else
		             {
		                return false;
		             }
		          }
		       }
		       catch(PDOException $e)
		       {
		           echo $e->getMessage();
		       }
		    }


	    public function is_loggedin()
	    {
	       // if(isset($_SESSION['user_id']))
	       // {
	       //    return true;
	       // }
	       // //Si return true le code s'arrête donc cette ligne ne s'active pas 
	       // return false;

	    	//Ceci return true or false en une ligne.
	       return isset($_SESSION['user_id']);
	    }

		public function redirect($url) {
			header("Location: $url");
		}
		
		public function logout() {
			session_destroy();
			// unset($_SESSION['user_id']);
			//Fait la même chose mais efface toutes les variables sessions.
			$_SESSION = [];
			$this->redirect('login.php');
			return true;
		}
		
		public function checkIfEmailExists($email) {
			$req = $this->db->prepare("SELECT * FROM users WHERE email =:email LIMIT 1");
		    $req->execute([':email'=>$email]);
		    $userRow = $req->fetch(PDO::FETCH_ASSOC);
		
		    if($userRow > 0) {
		    	return true;
		    } else {
		    	return false;
		    }
		}

		public function writeMessage($message, $pseudo = "Anonymous") 
		{
			try
			{
				$req = $this->db->prepare("INSERT INTO messages(fk_user_id, message_content, time_when_sent) VALUES (?,?,NOW())");
				$req->execute([$_SESSION['user_id'], $message]);
				$req->closeCursor();
				$req = $this->db->prepare("UPDATE `users` SET pseudo ='" . $pseudo . "' WHERE users.pk_id = $_SESSION[user_id]" );
				$req->execute([$pseudo]);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}



		public function fetchMessageFromDb($show) {
			try
			{
				$req = $this->db->query('SELECT messages.message_content, users.pseudo FROM `messages` INNER JOIN `users` ON messages.fk_user_id = users.pk_id');
				$fetch_messages = $req->fetchAll(PDO::FETCH_ASSOC);
				if($show == true) 
				{
					$this->show($fetch_messages);
				}

			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}


		public function show($content){
			foreach($content as $rows):
			
		?>
		<div class="border_messages">
			<p><?= $rows['pseudo']; ?> </p>
			<p><?= $rows['message_content']; ?> </p>	
		</div>
		
		<?php
		endforeach;

		}

	}
?>