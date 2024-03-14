<?php
// Assuming you have a database connection established
include("connection.php");

$query = "SELECT * FROM jobcreate";
$result = mysqli_query($db, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['clientname']}</td>";
        echo "<td>{$row['job']}</td>";
        echo "<td>{$row['notes']}</td>";
        echo "<td><button class='editBtn' data-id='{$row['id']}'>Edit</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No records found</td></tr>";
}
?>
