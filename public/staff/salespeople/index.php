<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Staff: Salespeople'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../index.php">Back to Menu</a><br />

  <h1>Salespeople</h1>

  <a href="./new.php">Add a Salesperson</a><br />
  <br />

  <?php
    $salespeople_result = find_all_salespeople();

    echo "<table id=\"salespeople\" style=\"width: 500px;\">";
    echo "<tr>";
    echo "<th>First name</th>";
    echo "<th>Last name</th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "</tr>";
    while($salesperson = db_fetch_assoc($salespeople_result)) {
      echo "<tr>";
      echo "<td>" . $salesperson['first_name'] . "</td>";
      echo "<td>" . $salesperson['last_name'] . "</td>";
      echo "<td>";
      echo "<a href=\"./show.php?id=". $salesperson['id']."\">Show</a>";
      echo "</td>";
      echo "<td>";
      echo "<a href=\"./edit.php?id=". $salesperson['id'] ."\">Edit</a>";
      echo "</td>";
      echo "</tr>";
    } // end while $salesperson
    db_free_result($salespeople_result);
    echo "</table>"; // #salespeople
  ?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
