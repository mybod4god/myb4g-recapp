<?php
if(isset($_POST['edit_competition'])){
  require('./config.php');
  $controller = new CompetitionsController($connection);
  $params = array(
    'id'            =>   $_POST['edit_id'],
    'name'          =>   $_POST['edit_name'],
    'location'      =>   $_POST['edit_location'],
    'details'       =>   $_POST['edit_details']
  );

  $controller->update($params);
  // prewrap($controller);

}
 ?>
