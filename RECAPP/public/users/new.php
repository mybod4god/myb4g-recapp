<?php require('../../assets/includes/header.php'); ?>
    <div class="container">
      <h1>Add Team</h1>
      <form class="form-addTeam" action="./create.php" method="post">
        <p>
          <label for="add_name">Name</label><br>
          <input type="text" name="add_name" placeholder="Enter Name Here...">
        </p>
        <p>
          <label for="add_leader">Leader</label><br>
          <input type="text" name="add_leader" placeholder="Enter Leader Here...">
        </p>
        <p>
          <input type="submit" name="add_team" value="Add Team">
        </p>
      </form>
      <p>
        <a href="./index.php">Return To Index</a>
      </p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
