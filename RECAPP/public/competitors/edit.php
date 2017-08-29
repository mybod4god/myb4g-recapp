<?php
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  require('./config.php');
  $controller = new CompetitorsController($connection);
  $competitor = $controller->show($id);
  // prewrap($controller);
  // prewrap($Competitors);
}else{
  header('Location: ./index.php');
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit Competitor</title>
  </head>
  <body>
    <div class="container">
      <h1>Edit Competitor</h1>
      <form class="form-editCompetitor" action="./update.php" method="post">
        <p>
          <input type="hidden" name="edit_id" value="<?php echo($id); ?>">
        </p>
        <p>
          <label for="edit_email">Email Address</label><br>
          <input type="email" name="edit_email" value="<?php echo($competitor['email']); ?>">
        </p>
        <p>
          <label for="edit_firstname">First Name</label><br>
          <input type="text" name="edit_firstname" value="<?php echo($competitor['firstname']); ?>">
        </p>
        <p>
          <label for="edit_lastname">Last Name</label><br>
          <input type="text" name="edit_lastname" value="<?php echo($competitor['lastname']); ?>">
        </p>
        <p>
          <label for="edit_phone">Contact Phone</label><br>
          <input type="text" name="edit_phone" value="<?php echo($competitor['phone']); ?>">
        </p>
        <p>
          <input type="submit" name="edit_competitor" value="Edit Competitor">
        </p>
      </form>
      <p>
        <a href="./index.php">Return To Index</a>
      </p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
