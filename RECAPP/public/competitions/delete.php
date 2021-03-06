<?php
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new CompetitionsController($connection);
  $competition = $controller->show($id);
  $competition_name = $competition['name'];
  // prewrap($controller);
  // prewrap($Competitions);
}else{
  header('Location: ./index.php');
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delete Competition</title>
  </head>
  <body>
    <div class="container">
      <h1>Delete Competition</h1>
      <p>Are you sure you want to delete <span class="del-em"><?php echo($competition_name); ?></span>???</p>
      <p><a href="./index.php">Cancel Delete</a> | <a href="./destroy.php?id=<?php echo($id); ?>">Confirm Delete</a></p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
