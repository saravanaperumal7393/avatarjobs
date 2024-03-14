<?php

include('connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Fetch form data
    $iteration_job = $_POST['iteration_job'];
    $iteration_members = $_POST['iteration_members'];
    $iteration_time_picker = $_POST['iteration_time_picker'];
    $iteration_time_picker_end = $_POST['iteration_time_picker_end'];
    $iteration_notes = $_POST['iteration_notes'];

    // Prepare and execute your SQL INSERT statement
    $sql = "INSERT INTO iteration_task (iteration_job, iteration_members, iteration_time_picker, iteration_time_picker_end, iteration_notes)
            VALUES ('$iteration_job', '$iteration_members', '$iteration_time_picker', '$iteration_time_picker_end', '$iteration_notes')";

    $result = mysqli_query($db, $sql);
    $message3 = "Record Added Suucessfully";
        echo "<script type='text/javascript'>alert('$message3'); window.location='iteration.php';</script>";
}



 ?>