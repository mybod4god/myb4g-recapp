<?php
if(isset($_POST['edit_competitor'])){
  require('./config.php');
  $controller = new CompetitorsController($connection);
  $params = array(
    'id'          =>   $_POST['edit_id'],
    'email'       =>   $_POST['edit_email'],
    'firstname'   =>   $_POST['edit_firstname'],
    'lastname'    =>   $_POST['edit_lastname'],
    'phone'       =>   $_POST['edit_phone']
  );

  $controller->update($params);
  // prewrap($controller);

}
 ?>
