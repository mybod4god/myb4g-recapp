<?php
require('./config.php');
$controller = new CompetitorsController($connection);
$Competitors = $controller->index();
// prewrap($controller);
// prewrap($Competitors);
require('../../assets/includes/header.php');
 ?>
 <div class="container">
   <h1>Competitors</h1>
   <table class="table table-bordered table-condensed">
     <thead>
       <tr>
         <th>ID</th>
         <th>Name</th>
       </tr>
     </thead>
     <tbody>
       <?php foreach ($Competitors as $competitor) {
         $id = $competitor['id'];
         ?>
         <tr>
           <td><?php echo($competitor['id']); ?></td>
           <td><?php echo($competitor['firstname'].' '.$competitor['lastname']); ?></td>
           <td><a href="./show.php?id=<?php echo($id); ?>">View Detail</a></td>
         </tr>
       <?php } ?>
     </tbody>
   </table>
   <p>
     <a href="./new.php">Add Competitor</a>
   </p>
 </div>
<?php require('../../assets/includes/footer.php'); ?>
