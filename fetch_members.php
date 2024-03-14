<?php
include('connection.php');
$output = '';
$query = "SELECT * FROM members";
$result = mysqli_query($db, $query);
while ($row = mysqli_fetch_array($result)) {
    $output .= '<option value="'.$row["id"].'">'.$row["fname"].'</option>';
}
echo $output;
?>
