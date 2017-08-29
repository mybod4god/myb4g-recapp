<?php
require('./config.php');
$controller = new TeamsController($connection);
$Teams = $controller->index();
require('../../assets/includes/header.php');
// prewrap($controller);
// prewrap($Teams);
 ?>
    <div class="container">
      <h1>Teams</h1>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name</th>
            <th>Leader</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Teams as $team) {
            $id = $team['id'];
            ?>
            <tr>
              <td><?php echo($team['name']); ?></td>
              <td><?php echo($team['leader']); ?></td>
              <td><a href="./show.php?id=<?php echo($id); ?>">View Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <p>
        <a href="./new.php">Add Team</a>
      </p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
