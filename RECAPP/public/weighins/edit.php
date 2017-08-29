<?php
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new TeamsController($connection);
  $team = $controller->show($id);
  // prewrap($controller);
  // prewrap($team);
}else{
  header('Location: ./index.php');
}
 ?>
 <div class="container">
   <h1>Edit Team</h1>
   <form class="form-editTeam" action="./update.php" method="post">
     <p>
       <input type="hidden" name="edit_id" value="<?php echo($id); ?>">
     </p>
     <p>
       <label for="edit_name">Name</label><br>
       <input type="text" name="edit_name" value="<?php echo($team['name']); ?>">
     </p>
     <p>
       <label for="edit_leader">Leader</label><br>
       <input type="text" name="edit_leader" value="<?php echo($team['leader']); ?>">
     </p>
     <p>
       <input type="submit" name="edit_team" value="Edit Team">
     </p>
   </form>
   <p>
     <a href="./index.php">Return To Index</a>
   </p>
 </div>
<?php require('../../assets/includes/footer.php'); ?>
