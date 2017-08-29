<?php
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new TeamsController($connection);
  $team = $controller->show($id);
  $team_name = $team['name'];
  // prewrap($controller);
  // prewrap($Teams);
}else{
  header('Location: ./index.php');
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delete Team</title>
  </head>
  <body>
    <div class="container">
      <h1>Delete Team</h1>
      <p>Are you sure you want to delete <span class="del-em"><?php echo($team_name); ?></span>???</p>
      <p><a href="./index.php">Cancel Delete</a> | <a href="./destroy.php?id=<?php echo($id); ?>">Confirm Delete</a></p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
