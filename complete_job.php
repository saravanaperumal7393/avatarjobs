 <?php

 error_reporting(0);
ob_start();
session_start();
include("connection.php");
$password1=mysqli_real_escape_string($db,stripslashes($_SESSION["hacses156"]));
$ip1=mysqli_real_escape_string($db,stripslashes($_SESSION["hacses157"]));
$ldate1=mysqli_real_escape_string($db,stripslashes($_SESSION["hacses158"]));

  $selquery="select * from logs where pwd1='$password1' and ip1='$ip1' and ldate1='$ldate1'";
//   echo $selquery;
//   die;

  $result=mysqli_query($db,$selquery);
  $count=mysqli_num_rows($result);
  
  if($count==0)   {
  header("location: index.php");
  //mysqli_close();

}
elseif($count==1)
{

$client=1;  
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



include('top.php');

$complete=1;

 ?>
 
 
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
                        <div class="card card-block card-stretch">
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-between align-items-center p-3">
                                    <h5 class="font-weight-bold">JOB List</h5>
                                    <a href="export_complete.php">
                                        <button class="btn btn-secondary btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Export
                                        </button>
                                    </a>
                                </div>
                                
                                <div class="table-responsive">
                                    <div class="" style="margin: 0px 18px;">
                                    <button type="button" class="btn btn-danger" id="deleteSelected" style="background:red;"> <i class="fa fa-trash-o"></i>&nbsp; Delete Selected</button>
                                    </div>
                                    <table class="table data-table mb-0">
                                    <div class="row" style="margin: 10px 18px;">
                                   
                                       <form method ="POST" action="export_selected_date.php">
                                            <div class="col-lg-2 col-md-2 mr_5">
                                                <label class="filter_assigned_label"> Filter start Date : </label>
                                                <input placeholder="From date" class="filter_date" type="date" id="start_date" name="start_date">
                                            </div>
                                            <div class="col-lg-2 col-md-2 mr_5">
                                                <label class="filter_assigned_label"> Filter End Date : </label>
                                                <input placeholder="To date" class="filter_date" type="date" id="end_date" name="end_date">
                                            </div>
                                            <div class="col-lg-12 col-md-12  mr_5">
                                            <div class="center">
                                                 <button  class="btn btn-danger" type="submit">Export Selected</button>
                                                <!-- <a  href="dashboard.php?11"> <button class="btn btn-danger" type="button" >Reset</button> </a> -->
                                            </div>
                                        </form>
                                     

                                    </div>
                                        <thead class="table-color-heading">
                                            <tr class="">
                                                <th scope="col" class="pr-0 w-01">
                                                    <div class="d-flex justify-content-start align-items-end mb-1 ">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input m-0" id="customChecked">
                                                            <label class="custom-control-label" for="customChecked"></label>
                                                        </div>
                                                    </div>
                                                </th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Name of the Job / <br> Date & Time <br>Of Completion  </th>
                                    <th scope="col">Assigned To </th>
                                    
                               
                                    <th scope="col">Reference</th>
                                    <th scope="col">Job Status</th>
                                    <th scope="col">Time Taken </th>
                                
                                                <th scope="col" class="text-right"> 
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                //   WHERE members = '$name_member_id'
                              
                                $sql2 = "SELECT * FROM jobcreate WHERE job_status = 'Closed Completed' ORDER BY completion ASC";


                                //   echo $sql2;
                                //   exit;
                                    $result2=mysqli_query($db,$sql2);
                                    $num=1;
                                    while ($db_field2 = mysqli_fetch_array($result2)) {
                                       $members_id_no =$db_field2["members"];
                                            
                                                   // Check for completion date nearing today's date
                                    $completionDate = strtotime($db_field2['completion']); // Convert completion date to a timestamp
                                    $today = strtotime(date('Y-m-d')); // Today's date as a timestamp

                                    // Calculate the difference in days
                                    $dateDifference = floor(($completionDate - $today) / (60 * 60 * 24)); 
                                        ?>  
                                            <tr class="white-space-no-wrap">
                                            <td class="pr-0 ">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <!-- Use the record ID as the checkbox value -->
                                                    <input type="checkbox" class="custom-control-input m-0" id="customCheck<?php echo $db_field2["id"] ?>" value="<?php echo $db_field2["id"] ?>">
                                                    <label class="custom-control-label" for="customCheck<?php echo $db_field2["id"] ?>"></label>
                                                </div>
                                            </td>
                                                <td><?php echo $db_field2["clientname"]?></td>
                                                <td><?php echo $db_field2["job"]?> / <br>
                                                <?php
                                                    if ($dateDifference >= 0 && $dateDifference <= 1) {
                                                        echo '<span style="color: red;">' . $db_field2['completion'] . '</span>'; // Highlight in red
                                                    } else {
                                                        echo  $db_field2['completion']; // Normal display
                                                    }
                                                    ?> /<br>
                                                    <?php echo $db_field2["time_comp"]?> 
                                                  
                                                </td>
                                                <td class="">
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
                                                        </div>
                                                        <div class="data-content">
                                                            <div>
                                                            <span class="font-weight-bold">

                                                            <?php
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
                                                        ?>
                                                            </span>                           
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </td>
                                               
                                                
                                       
                                                <!-- <td> 
                                                    <?php
                                                    if ($dateDifference >= 0 && $dateDifference <= 1) {
                                                        echo '<span style="color: red;">' . $db_field2['completion'] . '</span>'; // Highlight in red
                                                    } else {
                                                        echo  $db_field2['completion']; // Normal display
                                                    }
                                                    ?>
                                                </td>
                                       <td> <?php echo $db_field2["time_comp"]?>  </td> -->
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
                                    <td>
                                        <?php
                                        if (empty($db_field2["job_status"])) {
                                            echo 'Still Open';
                                        } else {
                                            echo $db_field2["job_status"] . '<br>';
                                            echo date('Y-m-d h:i A', strtotime($db_field2["close_time"]));
                                        }
                                        ?>
                                    </td>



                                     <td>
                                        
                                     <?php 
                                     
                                     // Sample entry and close times (replace these with your actual times)
                                        $entryTime = $db_field2["entry_date"];
                                        $closeTime = $db_field2["close_time"];

                                        // Convert times to Unix timestamps
                                        $entryTimestamp = strtotime($entryTime);
                                        $closeTimestamp = strtotime($closeTime);

                                        // Calculate the duration in seconds
                                        $durationInSeconds = $closeTimestamp - $entryTimestamp;

                                        // Convert duration to hours
                                        $durationInHours = floor($durationInSeconds / 3600); // Hours
                                        $remainingSeconds = $durationInSeconds % 3600; // Remaining seconds after removing hours
                                        $durationInMinutes = floor($remainingSeconds / 60); // Minutes

                                        // Output the duration in hours
                                        echo  $durationInHours . " hrs  " ;

                                     ?></td>                                              
                                               <td>
                                                    <div class="d-flex align-items-center">
                                            
                                                        <form action="delete_job.php" method="post">
                                                        <input type="hidden" name="job_id" value="<?php echo $db_field2['id']; ?>">
                                                        <button type="submit" class="badge bg-danger" style="border:none;"  name="delete_job" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                            </form>
                                                    </div>
                                                </td>
                                            </tr>
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
    <script>
    function openDatePopup(jobId) {
        var screenWidth = window.screen.width;
        var screenHeight = window.screen.height;
        var popupWidth = 800;
        var popupHeight = 500;

        var leftPosition = (screenWidth - popupWidth) / 2;
        var topPosition = (screenHeight - popupHeight) / 2;

        var popup = window.open("edit_completion.php?id=" + jobId, "DateInputWindow", "width=" + popupWidth + ",height=" + popupHeight + ",left=" + leftPosition + ",top=" + topPosition);

        if (popup) {
            popup.focus();
        } else {
            alert('Please allow pop-ups to enter the date.');
        }
    }
</script>

    <?php
include('footer.php');
    ?>
    <?php } ?>