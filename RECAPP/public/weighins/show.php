<?php
require('./config.php');
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $controller = new TeamsController($connection);
  $team = $controller->show($id);

  $current = $id;
  $prev = $controller->get_prev($current);
  $next = $controller->get_next($current);

  $name         = $team['name'];
  $leader       = $team['leader'];
  $date_entered = $team['date_entered'];

}else{
  header('Location: ./index.php');
}
 ?>
    <div class="container">
      <h1>Teams</h1>
      <ul>
        <li>ID: <?php echo($id); ?></li>
        <li>Name: <?php echo($name); ?></li>
        <li>Leader: <?php echo($leader); ?></li>
        <li>Date Entered: <?php echo($date_entered); ?></li>
      </ul>
      <p>
        <a href="./show.php?id=<?php echo($prev); ?>"><< Prev</a> | <a href="./show.php?id=<?php echo($next); ?>">Next >></a>
      </p>
      <p>
        <a href="./index.php">View Teams List</a> | <a href="./edit.php?id=<?php echo($id); ?>">Update Team</a> | <a href="./delete.php?id=<?php echo($id); ?>">Delete Team</a>
      </p>

    </div>
<?php require('../../assets/includes/footer.php'); ?>
