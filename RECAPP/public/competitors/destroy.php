<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new CompetitorsController($connection);
  $competitor = $controller->delete($id);
  // prewrap($controller);
  // prewrap($Competitors);
}else{
  header('Location: ./index.php');
}
 ?>
