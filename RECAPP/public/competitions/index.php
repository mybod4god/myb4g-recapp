<?php
require('./config.php');
$controller = new CompetitionsController($connection);
$Competitions = $controller->index();
require('../../assets/includes/header.php');
// prewrap($controller);
// prewrap($Competitions);
 ?>
    <div class="container">
      <h1>Competitions</h1>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Competitions as $competition) {
            $id = $competition['id'];
            ?>
            <tr>
              <td><?php echo($competition['name']); ?></td>
              <td><?php echo($competition['location']); ?></td>
              <td><a href="./show.php?id=<?php echo($id); ?>">View Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <p>
        <a href="./new.php">Add Competition</a>
      </p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
