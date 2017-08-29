<?php
require('./config.php');
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $controller = new CompetitorsController($connection);
  $competitor = $controller->show($id);

  $current = $id;
  $prev = $controller->get_prev($current);
  $next = $controller->get_next($current);

  $firstname    = $competitor['firstname'];
  $lastname     = $competitor['lastname'];
  $fullname     = $firstname.' '.$lastname;
  $email        = $competitor['email'];
  $phone        = $competitor['phone'];
  $team_ID      = $competitor['team_ID'];
  $date_entered = $competitor['date_entered'];

}else{
  header('Location: ./index.php');
}
 ?>
    <div class="container">
      <h1>Competitors</h1>
      <ul>
        <li>ID: <?php echo($id); ?></li>
        <li>Name: <?php echo($fullname); ?></li>
        <li>Email Address: <?php echo($email); ?></li>
        <li>Phone Number: <?php echo($phone); ?></li>
        <li>Team ID: <?php echo($team_ID); ?></li>
        <li>Date Entered: <?php echo($date_entered); ?></li>
      </ul>
      <p>
        <a href="./show.php?id=<?php echo($prev); ?>"><< Prev</a> | <a href="./show.php?id=<?php echo($next); ?>">Next >></a>
      </p>
      <p>
        <a href="./index.php">View Competitors List</a> | <a href="./edit.php?id=<?php echo($id); ?>">Update Competitor</a> | <a href="./delete.php?id=<?php echo($id); ?>">Delete Competitor</a>
      </p>

    </div>
<?php require('../../assets/includes/footer.php'); ?>
