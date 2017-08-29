<?php
require('./config.php');
require('../../assets/includes/header.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $controller = new CompetitionsController($connection);
  $competition = $controller->show($id);

  $current = $id;
  $prev = $controller->get_prev($current);
  $next = $controller->get_next($current);

  $name         = $competition['name'];
  $location     = $competition['location'];
  $details      = $competition['details'];
  $date_entered = $competition['date_entered'];

}else{
  header('Location: ./index.php');
}
 ?>
    <div class="container">
      <h1>Competitions</h1>
      <ul>
        <li>ID: <?php echo($id); ?></li>
        <li>Name: <?php echo($name); ?></li>
        <li>Location: <?php echo($location); ?></li>
        <li>Details: <?php echo($details); ?></li>
        <li>Date Entered: <?php echo($date_entered); ?></li>
      </ul>
      <p>
        <a href="./show.php?id=<?php echo($prev); ?>"><< Prev</a> | <a href="./show.php?id=<?php echo($next); ?>">Next >></a>
      </p>
      <p>
        <a href="./index.php">View Competitions List</a> | <a href="./edit.php?id=<?php echo($id); ?>">Update Competition</a> | <a href="./delete.php?id=<?php echo($id); ?>">Delete Competition</a>
      </p>

    </div>
<?php require('../../assets/includes/footer.php'); ?>
