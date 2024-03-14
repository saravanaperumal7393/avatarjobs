 <?php
include('top.php');
// include('connection.php');
$job_submit=1;
// / Check if the form is submitted
$success = false;
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Assuming you have a database connection in $db
    date_default_timezone_set('Asia/Kolkata');
    // Retrieve form data
    // $selectedMember = $_POST['member_complete'];
    $jobStatus = $_POST['job_status'];
    $close_time= date('Y-m-d H:i:s');
    $recordId = $_POST['record_id']; 
    $filelink= $_POST['filelink'];
    $cus_date=date("Y-m-d");
    
    // echo $selectedMember ;
    // echo $jobStatus ;
    // echo $close_time ;
    // echo $filelink ;
    // die;

    // Update the database
    $query = "UPDATE jobcreate SET job_status = '$jobStatus', close_time = '$close_time', cus_date = '$cus_date'  WHERE id = $recordId";

    $stmt = mysqli_query($db, $query);


// ... (previous code remains the same)

// if ($stmt) {
    
//     $jobDetailsQuery = "SELECT * FROM jobcreate WHERE id = $recordId";
//     $jobDetailsResult = mysqli_query($db, $jobDetailsQuery);
//     $jobData = mysqli_fetch_assoc($jobDetailsResult);

    
//     $mail_enquiry = "SELECT * FROM clients";
//     $result_enquiry = mysqli_query($db, $mail_enquiry);

    
//     $job = $jobData['job'];

//     $subject = 'Job Status Update';
//     $message = "Dear Client, 
//                 This is to inform you that the job status for '$job' has been updated.\n" .
//                 "File Link: $filelink\n" .
//                 // Include other relevant job details here...
//                 "Thank you.";

//     // Loop through clients and send emails
//     while ($row = mysqli_fetch_assoc($result_enquiry)) {
//         $to = $row['email'];
//         $from = "business@avatarprints.com"; // Set the sender's email address
        
//         // Additional headers
//         $headers = "From: $from\r\n";
        
//         // Send email
//         if (mail($to, $subject, $message, $headers)) {
            
//             $message3 = "Mail send to Client ID";
//             echo "<script type='text/javascript'>alert('$message3'); window.location.href = 'job_submission.php';</script>";
//         } else {
//             $message4 = "Please check there is a error in message";
//             echo "<script type='text/javascript'>alert('$message4'); window.location.href = 'index.php';</script>";
//         }
//     }

//     // Flag success after sending emails
//     $success = true;
// }



    
   
}
// else{
//     echo"Submit Form Properly";
// }
?>
<style>
    input[type="text"] {
    font-size: 17px;
    /* text-align: center;
     */
    width: 190px;
}
 </style>   
 
 <div class="wrapper">
 <?php
include('left.php');
include('nav.php');
 ?>  
       
      <div class="content-page">
<div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-12">
                     
                <div class="row">
                    <div class="col-lg-12">
                     <?php  
                    $sql = "SELECT * FROM iteration_task WHERE iteration_members = '$name_member_id'";
                    $job_member_result = mysqli_query($db, $sql);
                    
                    if ($job_member_result && mysqli_num_rows($job_member_result) > 0) {
                        $row = mysqli_fetch_assoc($job_member_result);
        
                        // Access the 'name' column from the result
                        $iteration_job = $row['iteration_job'];
                        $iteration_time_picker = $row['iteration_time_picker'];
                        $iteration_time_picker_end = $row['iteration_time_picker_end'];
                        $iteration_notes = $row['iteration_notes'];
                        ?>
                    <div class="card card-block card-stretch">
                        <div class="card-body p-0">
                        <h5 class="font-weight-bold" style="padding: 15px;">Iteration Job</h5>
                        <table class="table  mb-0">
                        <thead class="table-color-heading">
                        <tr class="">
                                        
                                
                                     <th scope="col">Name of the Job </th>
                                    <th scope="col">Start Time  </th>
                              
                                    <!-- <th>Enter Time</th> -->
                                    <th scope="col">End Time  </th>
                                    <th scope="col">Notes</th>
                                    <!-- <th scope="col">Job Status</th> -->
                                                <!-- <th scope="col" class="text-right"> 
                                                    Action
                                                </th> -->
                                            </tr>
                        </thead>  
                        <tr class="white-space-no-wrap odd" >
        
                                         <td class="sorting_1"><?php echo $iteration_job; ?> </td>
                                         <td><?php echo $iteration_time_picker; ?> </td>
                                         <td><?php echo $iteration_time_picker_end; ?> </td>
                                         <td><?php echo $iteration_notes; ?> </td>
                         </tr>                                              
                        </table>
                        </div>  
                    </div> 
                     <?php } ?>
                        
                        <div class="card card-block card-stretch">
                   
                            <div class="card-body p-0">
                            <div class="d-flex justify-content-between align-items-center p-3">
                                    <h5 class="font-weight-bold">JOB List</h5>
                                    

                                    <?php
                                      if($log_name !== 'Mahendran'){
                                    ?>
                                <a href="export_submission.php">
                                    <button class="btn btn-secondary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Export
                                    </button>
                                </a>
                                <?php } else {?>
                                <a href="export.php">
                                    <button class="btn btn-secondary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Export
                                    </button>
                                </a>
                                <?php } ?>
                                </div>
                                
                                <div class="table-responsive ">
                              <?php
                                      if($log_name == 'Mahendran'){
                                    ?>
                                    <div class="" style="margin: 0px 18px;">
                                    <button type="button" class="btn btn-danger" id="deleteSelected" style="background:red;"> <i class="fa fa-trash-o"></i>&nbsp; Delete Selected</button>
                                    </div>
                                    <label class="filter_assigned_label"> Filter Assigned To : </label>
                                    <select id="assignedToFilter"  class="filter_assigned">
                                    <?php
        
                                            $category2 = mysqli_query($db,"SELECT * FROM members ");
                                            // foreach ($category as $cat) {
                                        // $tat = $cat['name'];
                                        // echo $tat;
                                        while($cat2 = mysqli_fetch_array($category2))
                                    {
                                        
                                        ?>
                                       
                                        <option value="<?php echo $cat2['id'] ?>" ><?php echo $cat2['fname'] ?></option>
                                            
                                        
                                        <?php  }?>
                                    <?php } ?> 
                                   
                                  
                                    <!-- <option value="member_id_1">Member Name 1</option> -->
                                    
                                    </select>


                                    <!-- <input type="text" class="right_corner"  id="searchInput" placeholder="Search..."> -->
                                    <table class="table data-table mb-0">
                                        <thead class="table-color-heading">
                                            <tr class="">
                                                <!-- <th scope="col" class="pr-0 w-01">
                                                    <div class="d-flex justify-content-start align-items-end mb-1 ">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input m-0" id="customChecked">
                                                            <label class="custom-control-label" for="customChecked"></label>
                                                        </div>
                                                    </div>
                                                </th> -->
                                
                                   <?php
                                  
                                  if($log_name== 'Mahendran'){
                                    ?>
                                       <th></th>
                                       <th scope="col">Client Name/<br> Name of the Job /<br>Job Type / <br>D.O.C </th>
                                   <?php } else{ ?>
                                    <th scope="col">Client Name/<br> Name of the Job /<br>Job Type /<br>D.O.C </th>
                                    <?php }  ?>
                                    <?php
                                      if($log_name == 'Mahendran'){
                                    ?>
                                    <th scope="col">Assigned To</th>
                                    <?php } ?>
                                    <th scope="col">Reference </th>
                              
                                    <!-- <th>Enter Time</th> -->
                                    <th scope="col">Assigned By</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Job Status</th>
                                                <!-- <th scope="col" class="text-right"> 
                                                    Action
                                                </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                  
                                  if($log_name== 'Mahendran'){
                                    // echo'1111';
                                    $sql2 = "SELECT * FROM jobcreate WHERE job_status = '' ORDER BY completion ASC, start_time ASC";

                                    $result2=mysqli_query($db,$sql2);
                                    $num=1;
                                    while ($db_field2 = mysqli_fetch_array($result2)) {
                                        $members_id_no =$db_field2["members"];
                                        $time_comp  =$db_field2["time_comp"];
                                             // Check for completion date nearing today's date
                                    $completionDate = strtotime($db_field2['completion']); // Convert completion date to a timestamp
                                    $today = strtotime(date('Y-m-d')); // Today's date as a timestamp
                                    $fileLinks = explode("\n", $db_field2["reference"]);
                                    // Calculate the difference in days
                                    $dateDifference = floor(($completionDate - $today) / (60 * 60 * 24));
                                        
                                        ?>  
                                        
                                            <tr class="white-space-no-wrap">
                                            <form method="POST">
                                            <td class="pr-0 ">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <!-- Use the record ID as the checkbox value -->
                                                    <input type="checkbox" class="custom-control-input m-0" id="customCheck<?php echo $db_field2["id"] ?>" value="<?php echo $db_field2["id"] ?>">
                                                    <label class="custom-control-label" for="customCheck<?php echo $db_field2["id"] ?>"></label>
                                                </div>
                                            </td>
                                                <!-- <td><?php echo $db_field2["clientname"]?></td> -->
                                                <td> 
                                                <?php
                                                  if ($dateDifference < 0) {
                                                    // Past date
                                                    echo '<span style="color: red;">'. $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] .'<br>' . $db_field2['completion'] . '<br>' . $db_field2['start_time'].' - '  . $db_field2['time_comp']. '</span>';
                                                } elseif ($dateDifference == 0) {
                                                    // Today's date
                                                    echo '<span style="color: red;">'. $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] .'<br>' . $db_field2['completion'] . '<br>'. $db_field2['start_time'].' - ' . $db_field2['time_comp']. '</span>';
                                                } else {
                                                    // Future date
                                                    echo $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] . '<br>' . $db_field2['completion'] . '<br>' . $db_field2['start_time']. ' - ' . $db_field2['time_comp'];
                                                }
                                                    ?>
                                                </td>

                                                <td class="assignedToColumn" data-member-id="<?php echo $members_id_no ?>">
                                                    <div class="active-project-1 d-flex align-items-center mt-0 ">
                                                        <div class="h-avatar is-medium">
                                                            <?php
                                                        $members_name_query = "SELECT * FROM members WHERE id='$members_id_no'";
                                                                $result_members = mysqli_query($db, $members_name_query);

                                                                if ($result_members) {
                                                                    $member_data = mysqli_fetch_assoc($result_members);

                                                                    if ($member_data) {
                                                                        // Assuming 'members' is a column in your 'members' table
                                                                        
                                                                        $profile_picture = $member_data['profile_picture'];
                                                                        // $lname = $member_data['lname'];
                                                                        if (!empty($profile_picture)) {
                                                                        ?>
                                                            <img class="avatar rounded-circle" alt="user-icon" src="<?php echo $profile_picture ?>">
                                                            <?php } else {?>
                                                                <img class="avatar rounded-circle" alt="user-icon" src="members_img/no_img.jpg">

                                                            <?php }}}?>
                                                            <!-- assets/images/user/1.jpg -->
                                                        </div>
                                                        <div class="data-content">
                                                            <div>
                                                            <span class="font-weight-bold">                                                           <?php
                                                                $members_name_query = "SELECT * FROM members WHERE id='$members_id_no'";
                                                                $result_members = mysqli_query($db, $members_name_query);

                                                                if ($result_members) {
                                                                    $member_data = mysqli_fetch_assoc($result_members);

                                                                    if ($member_data) {
                                                                        // Assuming 'members' is a column in your 'members' table
                                                                        $member_name = $member_data['fname'];
                                                                        $lname = $member_data['lname'];
                                                                        // Displaying the member's name within the <span> tag
                                                                        echo '<div>';
                                                                        echo '<span class="font-weight-bold">' . $member_name . ' ' . $lname . '</span>';
                                                                        echo '</div>';
                                                                    } else {
                                                                        echo "No member found with that ID.";
                                                                    }
                                                                } else {
                                                                    echo "Error executing the query: " . mysqli_error($db);
                                                                }
                                                                ?></span>                           
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </td>
                                               
                                                <td>
                                        <?php if (empty($db_field2["reference"]) && empty($db_field2["reference_link"])) { ?>
                                            <p style="color:red;">No Data</p>
                                            <?php } elseif(!empty($db_field2["reference"]) && !empty($db_field2["reference_link"])) { ?>
                                                 <a href="<?php echo $db_field2["reference_link"]; ?>" target="_blank">Reference Link</a> /<br>
                                                 <?php
                                                // $count = 1; 
                                                foreach ($fileLinks as $fileLink) { ?>
                                                 <a href="<?php echo $fileLink; ?>" target="_blank">Reference</a><br>
                                                 <?php
                                    //  $count++;

                                             }  ?>
                                        <?php } else {      if (empty($db_field2["reference"])) {?>
                                            <a href="<?php echo $db_field2["reference_link"]; ?>" target="_blank">Reference Link</a>
                                            <?php } else {
                                                // $count = 1; 
                                                foreach ($fileLinks as $fileLink) { ?>
                                             <a href="<?php echo $fileLink; ?>" target="_blank">File Link 
                                             <!-- <?php echo $count; ?> -->
                                            </a><br>
                                        <?php
                                    // $count++;

                                    } } }  ?>
                                           
                                    </td>
                                       
                                       
                                       <td class>   
                                        <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        $selectedMember = $row['assigned_by'];
                                                        $job_status = $row['job_status'];
                        
                                        ?>
                                        <?php echo $selectedMember ?>
                                        <?php } ?>
                                       
                                    </td>
                                    <td>
                                            <?php
                                            if (empty($db_field2["notes"])) {
                                                ?> 
                                                <p style="color:red;"> No Data </p>
                                            <?php } else {
                                                $notes = $db_field2["notes"];
                                                $words = explode(' ', $notes);

                                                $currentLength = 0;
                                                $maxRowLength = 25;

                                                foreach ($words as $word) {
                                                    if ($currentLength + strlen($word) <= $maxRowLength) {
                                                        echo $word . ' ';
                                                        $currentLength += strlen($word) + 1; // 1 is for space between words
                                                    } else {
                                                        echo '<br>' . $word . ' ';
                                                        $currentLength = strlen($word) + 1;
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>


                                    
                                    <td style="display:none;"> <input type="hidden" name="record_id" value="<?php echo $db_field2["id"]?>"></td>
                                       <td style="display:none;"><input type="hidden" id="" name="time_picker" value="<?php echo date('H:i');?>"></td>
                                    <td style="display:none;">
                                        <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        $selectedMember = $row['selectedMember'];
                                                        $filelink = $row['filelink'];
                                                        

                                                     if (empty($filelink) ) { ?>
                                        <input type="text" id="" class="select_member " name="filelink" >
                                        <?php } else { ?>
                                            <!-- <input type="text" id="filelink" name="filelink" onClick="copyToClipboard()" value="<?php echo $filelink; ?>"> -->
                                            <div class="clipboard">
                                            
                                            <input class="copy-input" value="<?php echo htmlspecialchars($filelink); ?>" id="copyClipboard" >
                                            <button class="copy-btn" onclick="copyToClipboard('<?php echo ($filelink); ?>')"><i class="fa fa-copy"></i></button>
                                            </div>
                                                        <?php }
                                                    } ?>
                                                     <!-- <input type="text" id="" name="filelink"> -->
                                    </td>                                       
                                    <td> 
                                          <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        $selectedMember = $row['assigned_by'];
                                                        $job_status = $row['job_status'];
                                                        

                                                     if (empty($job_status) || ($job_status === 'Open Pending')) { ?>
                                                            <div class="selectdiv">
                                                                <label>
                                                                    <select name="job_status">
                                                                        <option value="Open Pending">Open - Pending</option>
                                                                        <option value="Closed Completed">Closed - Completed</option>
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        <?php } else { ?>
                                                            <input type="text" id="" class="select_member " name="" value="<?php echo $job_status; ?>" readonly>
                                                        <?php }
                                                    } ?>

                                        
                                        </td>
                                            <td> 
                                            <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        
                                                        $job_status = $row['job_status'];
                                            
                                                        if ( empty($job_status) || ($job_status === 'Open Pending')) { ?>
                                                            <td style="border:none!important;padding:5px;">
                                                                <input class="button_submit" name="submit" style="margin-top:15px;" type="submit" value="Submit">
                                                            </td>
                                                        <?php }
                                                    } ?>
                                        </form>

                                            
                                            </tr>
                                            <?php } 
                                  }
                                  else{
                                    $sql2 = "SELECT * FROM jobcreate WHERE job_status='' AND members = '$name_member_id' ORDER BY completion ASC, start_time ASC";

                                    $result2=mysqli_query($db,$sql2);
                                    $num=1;
                                    while ($db_field2 = mysqli_fetch_array($result2)) {

                                        $twentyFourHourTime_start = $db_field2["start_time"];
                                        $twelveHourTime_starttime = date("h:i A", strtotime($twentyFourHourTime_start));

                                        $twentyFourHourTime_end = $db_field2["time_comp"];
                                        $twelveHourTime_endtime = date("h:i A", strtotime($twentyFourHourTime_end));

                                        $members_id_no =$db_field2["members"];
                                        $time_comp = $db_field2['time_comp']; 
                                        $fileLinks = explode("\n", $db_field2["reference"]);
                                             // Check for completion date nearing today's date
                                    $completionDate = strtotime($db_field2['completion']); // Convert completion date to a timestamp
                                   
                                    $today = strtotime(date('Y-m-d')); // Today's date as a timestamp

                                    // Calculate the difference in days
                                    $dateDifference = floor(($completionDate - $today) / (60 * 60 * 24));
                                        
                                        ?>  
                                        
                                            <tr class="white-space-no-wrap">
                                            <form method="POST">
                                            <!-- <td class="pr-0 ">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    
                                                    <input type="checkbox" class="custom-control-input m-0" id="customCheck<?php echo $db_field2["id"] ?>" value="<?php echo $db_field2["id"] ?>">
                                                    <label class="custom-control-label" for="customCheck<?php echo $db_field2["id"] ?>"></label>
                                                </div>
                                            </td> -->
                                                <!-- <td><?php echo $db_field2["clientname"]?></td> -->
                                                <td> 
                                                <?php
                                                if (!empty($db_field2["start_time"]) && !empty($db_field2["time_comp"])) {
                                                    // Convert start time to 12-hour format
                                                    $twelveHourTime_starttime = date("h:i A", strtotime($db_field2["start_time"]));

                                                    // Convert end time to 12-hour format
                                                    $twelveHourTime_endtime = date("h:i A", strtotime($db_field2["time_comp"]));

                                                    if ($dateDifference < 0) {
                                                        // Past date
                                                        echo '<span style="color: red;">'. $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] .'<br>' . $db_field2['completion'] . '<br>' .  $twelveHourTime_starttime .' - '  . $twelveHourTime_endtime. '</span>';
                                                    } elseif ($dateDifference == 0) {
                                                        // Today's date
                                                        echo '<span style="color: red;">'. $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] .'<br>' . $db_field2['completion'] . '<br>'.  $twelveHourTime_starttime .' - ' . $twelveHourTime_endtime. '</span>';
                                                    } else {
                                                        // Future date
                                                        echo $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] . '<br>' . $db_field2['completion'] . '<br>' .  $twelveHourTime_starttime . ' - ' . $twelveHourTime_endtime;
                                                    }
                                                } else {
                                                    if ($dateDifference < 0) {
                                                        // Past date
                                                         echo '<span style="color: red;">'. $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] . '<br>' . $db_field2['completion'] . '<br>' . ' Time Not Mentioned </span>' ;
                                                    } elseif ($dateDifference == 0) {
                                                        // Today's date
                                                        echo '<span style="color: red;">'. $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] . '<br>' . $db_field2['completion'] . '<br>' . ' TIme Not Mentioned </span>' ;
                                                    } else {
                                                        // Future date
                                                        echo  $db_field2['clientname'] . '<br>'  . $db_field2['job'] . '<br>' . $db_field2['job_type'] . '<br>' . $db_field2['completion'] . '<br>' . ' TIme Not Mentioned ' ;
                                                    }
                                                }
                                                ?>

                                                </td>

                                                <!-- <td class="">
                                                    <div class="active-project-1 d-flex align-items-center mt-0 ">
                                                        <div class="h-avatar is-medium">
                                                            <?php
                                                        $members_name_query = "SELECT * FROM members WHERE id='$members_id_no'";
                                                                $result_members = mysqli_query($db, $members_name_query);

                                                                if ($result_members) {
                                                                    $member_data = mysqli_fetch_assoc($result_members);

                                                                    if ($member_data) {
                                                                        
                                                                        
                                                                        $profile_picture = $member_data['profile_picture'];
                                                                        
                                                                        if (!empty($profile_picture)) {
                                                                        ?>
                                                            <img class="avatar rounded-circle" alt="user-icon" src="<?php echo $profile_picture ?>">
                                                            <?php } else {?>
                                                                <img class="avatar rounded-circle" alt="user-icon" src="members_img/no_img.jpg">

                                                            <?php }}}?>
                                                            
                                                        </div>
                                                        <div class="data-content">
                                                            <div>
                                                            <span class="font-weight-bold">                                                           <?php
                                                                $members_name_query = "SELECT * FROM members WHERE id='$members_id_no'";
                                                                $result_members = mysqli_query($db, $members_name_query);

                                                                if ($result_members) {
                                                                    $member_data = mysqli_fetch_assoc($result_members);

                                                                    if ($member_data) {
                                                                        
                                                                        $member_name = $member_data['fname'];
                                                                        $lname = $member_data['lname'];
                                                                        
                                                                        echo '<div>';
                                                                        echo '<span class="font-weight-bold">' . $member_name . ' ' . $lname . '</span>';
                                                                        echo '</div>';
                                                                    } else {
                                                                        echo "No member found with that ID.";
                                                                    }
                                                                } else {
                                                                    echo "Error executing the query: " . mysqli_error($db);
                                                                }
                                                                ?></span>                           
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </td> -->
                                                <td>
                                        <?php if (empty($db_field2["reference"]) && empty($db_field2["reference_link"])) { ?>
                                            <p style="color:red;">No Data</p>
                                            <?php } elseif(!empty($db_field2["reference"]) && !empty($db_field2["reference_link"])) { ?>
                                                 <a href="<?php echo $db_field2["reference_link"]; ?>" target="_blank">Reference Link</a> /<br>
                                                 <?php
                                                // $count = 1; 
                                                foreach ($fileLinks as $fileLink) { ?>
                                                 <a href="<?php echo $fileLink; ?>" target="_blank">Reference</a><br>
                                                 <?php
                                    //  $count++;

                                             }  ?>
                                        <?php } else {      if (empty($db_field2["reference"])) {?>
                                            <a href="<?php echo $db_field2["reference_link"]; ?>" target="_blank">Reference Link</a>
                                            <?php } else {
                                                // $count = 1; 
                                                foreach ($fileLinks as $fileLink) { ?>
                                             <a href="<?php echo $fileLink; ?>" target="_blank">File Link 
                                             <!-- <?php echo $count; ?> -->
                                            </a><br>
                                        <?php
                                    // $count++;

                                    } } }  ?>
                                           
                                    </td>
                                       

                                     <td class>   
                                        <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        $selectedMember = $row['assigned_by'];
                                                        $job_status = $row['job_status'];
                        
                                        ?>
                                        <?php echo $selectedMember ?>
                                        <?php } ?>
                                       
                                    </td>
                                    <td>
                                            <?php
                                            if (empty($db_field2["notes"])) {
                                                ?> 
                                                <p style="color:red;"> No Data </p>
                                            <?php } else {
                                                $notes = $db_field2["notes"];
                                                $words = explode(' ', $notes);

                                                $currentLength = 0;
                                                $maxRowLength = 25;

                                                foreach ($words as $word) {
                                                    if ($currentLength + strlen($word) <= $maxRowLength) {
                                                        echo $word . ' ';
                                                        $currentLength += strlen($word) + 1; // 1 is for space between words
                                                    } else {
                                                        echo '<br>' . $word . ' ';
                                                        $currentLength = strlen($word) + 1;
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>


                                    <td style="display:none;"> <input type="hidden" name="record_id" value="<?php echo $db_field2["id"]?>"></td>
                                       <td style="display:none;"><input type="hidden" id="" name="time_picker" value="<?php echo date('H:i');?>"></td>
                                    <td style="display:none;">
                                        <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        $selectedMember = $row['member_complete'];
                                                        $filelink = $row['filelink'];
                                                        

                                                     if (empty($filelink) ) { ?>
                                        <input type="text" id="" class="select_member " name="filelink" >
                                        <?php } else { ?>
                                            <!-- <input type="text" id="filelink" name="filelink" onClick="copyToClipboard()" value="<?php echo $filelink; ?>"> -->
                                            <div class="clipboard">
                                            
                                            <input class="copy-input" value="<?php echo htmlspecialchars($filelink); ?>" id="copyClipboard" >
                                            <button class="copy-btn" onclick="copyToClipboard('<?php echo ($filelink); ?>')"><i class="fa fa-copy"></i></button>
                                            </div>
                                                        <?php }
                                                    } ?>
                                                     <!-- <input type="text" id="" name="filelink"> -->
                                    </td>                                       
                                    <td> 
                                          <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        $selectedMember = $row['assigned_by'];
                                                        $job_status = $row['job_status'];
                                                        

                                                     if (empty($job_status) || ($job_status === 'Open Pending')) { ?>
                                                            <div class="selectdiv">
                                                                <label>
                                                                    <select name="job_status">
                                                                        <option value="Open Pending">Open - Pending</option>
                                                                        <option value="Closed Completed">Closed - Completed</option>
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        <?php } else { ?>
                                                            <input type="text" id="" class="select_member " name="" value="<?php echo $job_status; ?>" readonly>
                                                        <?php }
                                                    } ?>

                                        
                                        </td>
                                            <td> 
                                            <?php
                                          $recordId = $db_field2["id"];
                                          $sqlUpdated = "SELECT * FROM jobcreate WHERE id = '$recordId'";
                                                    $resultUpdated = mysqli_query($db, $sqlUpdated);

                                                    while ($row = mysqli_fetch_assoc($resultUpdated)) {
                                                        $selectedMember = $row['assigned_by'];
                                                        $job_status = $row['job_status'];
                                            
                                                        if (empty($job_status) || ($job_status === 'Open Pending')) { ?>
                                                            <td style="border:none!important;padding:5px;">
                                                                <input class="button_submit" name="submit" style="margin-top:15px;" type="submit" value="Submit">
                                                            </td>
                                                        <?php }
                                                    } ?>
                                        </form>

                                            
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
    </div>
    <!-- Wrapper End-->

    <?php
include('footer.php');
    ?>