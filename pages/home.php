<?php 
session_start();
getAccess();
mysqli_select_db($conn, $c_dbname);
 ?>
<!DOCTYPE html>
<html>
<body>
<a href="/pages/logout.php" class="btn btn-info pull-right" role="button">Logout</a>
<!-- Table Rows Start -->
<div class="container">     
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Guid</th>
        <th>Name</th>
        <th>Ticket Type</th>
        <th>Completed</th>
        <th>View</th>
      </tr>
    </thead>
<!-- Table Data Starts -->
    <tbody>
    <?php
	$stmt = $conn->prepare("SELECT id, playerguid, name, type, completed, closedBy FROM gm_ticket");
	$stmt->execute();
	$stmt->bind_result($id, $guid, $name, $type, $completed, $closedBy);
	$stmt->store_result();
	if($stmt->num_rows > 0) {
		while($stmt->fetch()) {
      if ($closedBy == 0 ){
      if ($completed == 0) {
      	echo "<tr>";
        echo "<td>$id</td>";
     	  echo "<td>$guid</td>";
        echo "<td>$name</td>";
        echo "<td>$type</td>";
        echo "<td>$completed</td>";
        echo "<td><a href=\"?ticket=$id\" class=\"btn btn-info\" role=\"button\">View</a></td>";
        echo "</tr>";
    		} else {
          // Show no tickets if completed == 1 or higher. 
        } 
      }else {
        // Show no tickets if closedBy == 1 or higher.
      }
	}
}
	?>
	</tbody>
  </table>
</div>
</body>
</html>
