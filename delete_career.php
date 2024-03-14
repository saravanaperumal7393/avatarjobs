<?php
include('connection.php');

if (isset($_POST['delete_job'])) {
    $job_id = $_POST['job_id'];
    

    // Perform deletion query based on the job ID
    $delete_query = "DELETE FROM careers WHERE id = $job_id";
    $result = mysqli_query($db, $delete_query);
// echo $delete_query;
// exit;
    if ($result) {
        // Deletion successful
        echo '<script>alert("Record deleted successfully");</script>';
        
            echo '<script>window.location.href = "career.php";</script>'; // Redirect to created_me.php if admin
    
           
        
    } else {
        // Deletion failed
        echo '<script>alert("Failed to delete job");</script>';
        // Redirect to an error page or handle the failure accordingly
    }
}
?>
