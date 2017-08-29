<?php
if(isset($_POST['add_team'])){
  require('./config.php');
  $controller = new TeamsController($connection);

  $params = array(
    'name'       =>   $_POST['add_name'],
    'leader'     =>   $_POST['add_leader'],
  );

  $controller->create($params);
  // prewrap($controller);
  // prewrap($Team);
}else{
    // header('Location: ./index.php');
}
// $value = "Gwen's Group";
// echo (addcslashes($value, "'"));
 ?>
