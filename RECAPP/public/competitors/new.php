<?php require('../../assets/includes/header.php'); ?>
    <div class="container">
      <h1>Add Competitor</h1>
      <form class="form-addCompetitor" action="./create.php" method="post">
        <p>
          <label for="add_email">Email Address</label><br>
          <input type="email" name="add_email" placeholder="Email Address">
        </p>
        <p>
          <label for="add_firstname">First Name</label><br>
          <input type="text" name="add_firstname" placeholder="First Name">
        </p>
        <p>
          <label for="add_lastname">Last Name</label><br>
          <input type="text" name="add_lastname" placeholder="Last Name">
        </p>
        <p>
          <label for="add_phone">Contact Phone</label><br>
          <input type="text" name="add_phone" placeholder="Contact Phone">
        </p>
        <p>
          <input type="submit" name="add_competitor" value="Add Competitor">
        </p>
      </form>
      <p>
        <a href="./index.php">Return To Index</a>
      </p>
    </div>
<?php require('../../assets/includes/footer.php'); ?>
