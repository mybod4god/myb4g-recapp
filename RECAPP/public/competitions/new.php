<?php require('../../assets/includes/header.php'); ?>
    <div class="container">
      <h1>Add Competition</h1>
      <form class="form-addCompetitor" action="./create.php" method="post">
        <p>
          <label for="add_name">Name</label><br>
          <input type="text" name="add_name" placeholder="Enter Name Here...">
        </p>
        <p>
          <label for="add_location">Location</label><br>
          <input type="text" name="add_location" placeholder="Enter Location Here...">
        </p>
        <p>
          <label for="add_details">Details</label><br>
          <textarea name="add_details" rows="8" cols="80" placeholder="Enter Details Here..."></textarea>
        </p>
        <p>
          <input type="submit" name="add_competition" value="Add Competition">
        </p>
      </form>
      <p>
        <a href="./index.php">Return To Index</a>
      </p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
