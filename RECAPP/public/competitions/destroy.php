<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new CompetitionsController($connection);
  $competitor = $controller->delete($id);
  // prewrap($controller);
  // prewrap($Competitions);
}else{
  header('Location: ./index.php');
}
 ?>
