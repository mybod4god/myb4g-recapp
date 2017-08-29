<?php
if(isset($_POST['add_competition'])){
  require('./config.php');
  $controller = new CompetitionsController($connection);

  $params = array(
    'name'       =>   $_POST['add_name'],
    'location'   =>   $_POST['add_location'],
    'details'    =>   $_POST['add_details']
  );

  $controller->create($params);
  // prewrap($controller);
  // prewrap($Competition);
}else{
    header('Location: ./index.php');
}
// $value = "Gwen's Group";
// echo (addcslashes($value, "'"));
 ?>
