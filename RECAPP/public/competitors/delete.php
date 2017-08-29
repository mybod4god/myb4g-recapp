<?php
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new CompetitorsController($connection);
  $competitor = $controller->show($id);
  $competitor_name = $competitor['firstname'].' '.$competitor['lastname'];
  // prewrap($controller);
  // prewrap($Competitors);
}else{
  header('Location: ./index.php');
}
 ?>
 <div class="container">
   <h1>Delete Competitor</h1>
   <p>Are you sure you want to delete <span class="del-em"><?php echo($competitor_name); ?></span>???</p>
   <p><a href="./index.php">Cancel Delete</a> | <a href="./destroy.php?id=<?php echo($id); ?>">Confirm Delete</a></p>
 </div>
<?php require('../../assets/includes/footer.php'); ?>
