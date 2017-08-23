<?php 

  require 'mysql.php';

  print_r($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chat box</title>

  <!--css links-->
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class='chatbox__login'>
      <p><a href="../../index.php">Logout</a></p>
    </div>
    <div class='container' ng-cloak ng-app="chatApp">
    <h1>OctoChat becodien</h1>
    <div class='chatbox' ng-controller="MessageCtrl as chatMessage">
      <div class='chatbox__user-list'>
        <h1>User list</h1>
        <p>Not using it yet !</p>
      </div>
      <div class="chatbox__messages" ng-repeat="message in messages">
        <div class="chatbox__messages__user-message">
          <div class="chatbox__messages__user-message--ind-message">
            
            <?php include 'message_db.php'; ?>
          
          </div>
        </div>
      </div>
      <form method="POST" action="">
        <input type="text" name="message" placeholder="Enter your message">
        <input type="submit" value="Envoyer" id="submit-message" name="submit-message">
      </form>
    </div>

    <script src="../js/chat-js.js"></script>
</body>
</html>