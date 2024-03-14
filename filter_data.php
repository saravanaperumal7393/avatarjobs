<?php
include ("connection.php");

// Get the selected date from the AJAX request
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Assuming your date column in the jobcreate table is 'completion'
    $query = "SELECT * FROM jobcreate WHERE completion = '$selectedDate'";
    
    // Perform the query
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch associative array of the result set
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        // Output JSON formatted data
        header('Content-Type: application/json');
        echo json_encode($rows);
    } else {
        echo "No data found";
    }
} else {
    echo "No date received";
}

// Close the database connection
$conn->close();
?>
