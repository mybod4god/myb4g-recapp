<?php
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new CompetitionsController($connection);
  $competition = $controller->show($id);
  // prewrap($controller);
  // prewrap($competition);
}else{
  header('Location: ./index.php');
}
 ?>
 <div class="container">
   <h1>Edit Competition</h1>
   <form class="form-editCompetition" action="./update.php" method="post">
     <p>
       <input type="hidden" name="edit_id" value="<?php echo($id); ?>">
     </p>
     <p>
       <label for="edit_name">Name</label><br>
       <input type="text" name="edit_name" value="<?php echo($competition['name']); ?>">
     </p>
     <p>
       <label for="edit_location">Location</label><br>
       <input type="text" name="edit_location" value="<?php echo($competition['location']); ?>">
     </p>
     <p>
       <label for="edit_details">Details</label><br>
       <textarea name="edit_details" rows="8" cols="80"><?php echo($competition['details']); ?></textarea>
     </p>
     <p>
       <input type="submit" name="edit_competition" value="Edit Competition">
     </p>
   </form>
   <p>
     <a href="./index.php">Return To Index</a>
   </p>
 </div>
<?php require('../../assets/includes/footer.php'); ?>
