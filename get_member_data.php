<?php
// Include necessary files and start session if required
include("connection.php");

// Retrieve the member ID from the query string
$member_id = $_REQUEST['id'];

// Perform any necessary validation on $member_id to prevent SQL injection

// Query to fetch member data based on ID
$query = "SELECT * FROM jobcreate WHERE id = '$member_id'";
$result = mysqli_query($db, $query);

// Check if the query was successful and if a row was returned
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the member data as an associative array
    $memberData = mysqli_fetch_assoc($result);
    
    // Output the member data as JSON
    echo json_encode($memberData);
} else {
    // Member not found or query failed
    // You can return an empty JSON object or an error message as needed
    echo json_encode(array("error" => "Member not found"));
}

// Close the database connection if required
mysqli_close($db);
?>
