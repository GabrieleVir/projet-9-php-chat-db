<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chat box</title>

  <!--css links-->
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div class='chatbox__login'>
      <p><a href="assets/php/login.php">Login</a></p>
      <p><a href="assets/php/register.php">Register</a></p>
    </div>
    <div class='container' ng-cloak ng-app="chatApp">
      <h1>TChat</h1>
    <div class='chatbox' ng-controller="MessageCtrl as chatMessage">
      <div class='chatbox__user-list'>
        <h1>User list</h1>
        <p>Not using it yet !</p>
      </div>
      <div class="chatbox__messages" ng-repeat="message in messages">
        <div class="chatbox__messages__user-message">
         
            <?php include 'assets/php/message_db.php'; ?>

        </div>
      </div>
    </div>

    <script src="assets/js/chat-js.js"></script>
</body>
</html>