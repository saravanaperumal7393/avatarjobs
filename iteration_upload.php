<?php
// error_reporting(0);
session_start();
include ("connection.php");

$log_name=$_SESSION["uname"];

$name_member = "SELECT * FROM members WHERE username = '$log_name'";
$result = mysqli_query($db, $name_member);

if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);
        
        // Access the 'name' column from the result
        $name_member = $row['fname'];
        $name_member_id = $row['id'];
        
        // Output the name
        // echo $name_member;
        // die;
    }
}
date_default_timezone_set('Asia/Kolkata');

        
    $from = $_POST['members'];

    $query = "SELECT * FROM members WHERE id = '$from'";
$result = mysqli_query($db, $query);

if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);
        
        // Access the 'name' column from the result
        $from = $row['fname'] . ' ' . $row['lname'];

       
    }
}
      

	$iteration_job=$_POST['iteration_job'];
	$iteration_time_picker = $_POST['iteration_time_picker'];  
	$iteration_time_picker_end=$_POST['iteration_time_picker_end'];
	$iteration_notes=$_POST['iteration_notes'];
    $iteration_members=$_POST['iteration_members'];
    

    $cus_date=date("Y-m-d");


    
        $sql = "INSERT INTO jobcreate (clientname, job, members, notes, job_type, completion, start_time, time_comp, reference, entry_date, assigned_by, cus_date) VALUES ('$client', '$job', '$members', '$notes', '$job_type', '$completion', '$start_time', '$time_picker_end', '$fileLink', '$entry_date', '$assigned_by', '$cus_date')";
        // echo $sql;
        // exit;
        $result = mysqli_query($db, $sql);
        $message3 = "Record Added Suucessfully";
        echo "<script type='text/javascript'>alert('$message3'); window.location='job_creation.php';</script>";
        // header("Location: job_submission.php");
         
  
   
?>
