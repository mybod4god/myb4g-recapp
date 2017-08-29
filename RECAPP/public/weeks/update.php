<?php
if(isset($_POST['edit_team'])){
  require('./config.php');
  $controller = new TeamsController($connection);
  $params = array(
    'id'            =>   $_POST['edit_id'],
    'name'          =>   $_POST['edit_name'],
    'leader'        =>   $_POST['edit_leader']
  );

  $controller->update($params);
  // prewrap($controller);

}
 ?>
