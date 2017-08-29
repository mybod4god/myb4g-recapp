<?php
if(isset($_POST['add_competitor'])){
  require('./config.php');
  $controller = new CompetitorsController($connection);

  $params = array(
    'email'       =>   $_POST['add_email'],
    'firstname'   =>   $_POST['add_firstname'],
    'lastname'    =>   $_POST['add_lastname'],
    'phone'       =>   $_POST['add_phone']
  );

  $controller->create($params);
  // prewrap($controller);
  // prewrap($Competitors);
}else{
  header('Location: ./index.php');
}
 ?>
