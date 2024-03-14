<?php
include('connection.php');

// if  isset($_POST['newCompletion']) {
//     $jobId = $_POST['jobId'];
//     $newDate = $_POST['date'];

//     echo $jobId;
//     echo $newDate;
// } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar Jobs</title>
    <link rel="shortcut icon" href="assets/images/logo/icon.png" />
    <link rel="stylesheet" href="assets/css/style.css?v=1.2"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
    font-family: sans-serif;
    min-height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    
   
    position: relative;
}
.survey-form {
    max-width: 500px;
    min-width: 350px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
}
  
h2 {
    text-align: center;
}
  
.form-group {
    margin-bottom: 20px;
    padding:10px;
}
  
label {
    display: block;
    margin: 10px ;
}
  
input[type="date"],
input[type="time"],
textarea, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
  
input[type="range"] {
    width: 100%;
}
  
button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
  

  
.attribute{
    position: absolute;
    bottom: 10px;
}

.text-center{
    text-align:center;
}
.form_wrapper input[type="submit"] {
    background: #8129d9;
    height: 41px;
    line-height: 35px;
    width: 100%;
    max-width: 150px;
    margin: 0 auto;
    text-align: center;
    border: none;
    outline: none;
    cursor: pointer;
    color: #fff;
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    border-radius: 15px;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
    </style>
</head>
<body>
<div class="form_wrapper">
                        <div class="form_container">
                          <div class="title_container">
                            <h2>Job Creation</h2>
                          </div>
                          <div class="row clearfix">
                            <div class="">
                            <form  action="upload_edit_process.php" method="POST" enctype="multipart/form-data">
                            <?php
                                     $job_id = $_GET['id'];
                                     $log_name = $_GET['logname'];
                                   
                                        $name_member = "SELECT * FROM jobcreate WHERE id = '$job_id'";

                                        $result = mysqli_query($db, $name_member);
                                        
                                        if ($result) {
                                            // Check if any rows were returned
                                            if (mysqli_num_rows($result) > 0) {
                                                // Fetch the result as an associative array
                                                $row = mysqli_fetch_assoc($result);
                                                
                                                // Access the 'name' column from the result
                                                $clientname = $row['clientname'];
                                                $members_id = $row['members'];
                                              
                                                $time_comp = $row['time_comp'];
                                              
                                            }
                                        }
                                        
                                     ?>
                            <div class="input_field select_option">
                               
                              <label> Choose Client </label>
                               
                                        <select name="client" value='<?php echo $clientname; ?>'>
                                        <?php
                                        $category = mysqli_query($db, "SELECT * FROM clients");
                                        while ($cat = mysqli_fetch_array($category)) {
                                            $selected = ($cat['name'] == $clientname) ? 'selected' : ''; // Check if this option should be preselected
                                        ?>
                                            <option value="<?php echo $cat['name']; ?>" <?php echo $selected; ?>><?php echo $cat['name']; ?></option>
                                        <?php } ?>
                                       
                                        </select>
                                        <!-- <div class="select_arrow"></div> -->
                                  </div>
                                  <label> Name of the Job </label>  
                                  <div class="input_field">
                                  
                                  <span><i aria-hidden="true" class="fa fa-tasks"></i></span>
                                  <input type="text" name="job" placeholder="Name Of The Job"  value="<?php echo $row['job']; ?>" />
                                 </div>
                                 <label> Assigned To </label>
          
                                 <div class="input_field select_option">
                                
                            <select name="members" id="membersSelect">
                                <?php
                                $category = mysqli_query($db, "SELECT * FROM members");
                                
                                while ($cat = mysqli_fetch_array($category)) {
                                    $selected = ($cat['id'] == $members_id) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $cat['id']; ?>" <?php echo $selected; ?>><?php echo $cat['fname']; ?></option>
                                <?php } ?>
                            </select>

                                        <div class="select_arrow"></div>
                                        <!-- <input type="text" name="memberIdHidden" id="memberIdHidden" value=""> -->
                              
                                  </div>
                            
                                
                                
                                <label> Date of Completion </label> 
                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-calendar"></i></span>
                                
                                <input placeholder=" Date of Completion" type="text" name="completion" value="<?php echo $row['completion']; ?>" onfocus="(this.type = 'date')"  id="completion">
                                </div>
                              
                                
                                    <!-- <span><i aria-hidden="true" class="fa fa-clock"></i></span>
                                
                                <input type="time" id="timeInput" name="time_picker"> -->
                                <input type="hidden" id="assigned_by" name="assigned_by" value="<?php
                                $sqlquery ="Select * from members Where username='$log_name'";
                                $results=mysqli_query($db,$sqlquery);
                                while($cat2 = mysqli_fetch_array($results)){

                                echo $cat2['fname'];
                                } ?>" >
                                <input type="hidden" id="jobId" name="jobId" value="<?php echo $job_id; ?>">

                               
                                <div class="row"> 
                                      <div class="col-md-6 col-lg-6">
                                            <label> Start Time </label> 
                                            
                                            
                                            <div class="input_field "> 
                                            
                                            <input type="time" id="timeInput" name="time_picker" min="9:00" max="19:00" value="<?php echo $row['start_time']; ?>" >
                                            

                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <label> End Time </label> 
                                    
                                            <div class="input_field "> 
                                            
                                            <input type="time" id="timeInput" name="time_picker_end"  min="9:00" max="19:00" value="<?php echo $row['time_comp']; ?>" >
                                            
                                            </div>
                                        </div>
                                    </div>

                               

                                <label> JOB TYPE </label> 
                                <div class="input_field select_option"> 
                         
                                <select name="job_type">
                                    <option value="Social Media" <?php echo ($row['job_type'] == 'Social Media') ? 'selected' : ''; ?>>Social Media</option>
                                    <option value="Website" <?php echo ($row['job_type'] == 'Website') ? 'selected' : ''; ?>>Website</option>
                                    <option value="Collateral" <?php echo ($row['job_type'] == 'Collateral') ? 'selected' : ''; ?>>Collateral</option>
                                    <option value="Print File" <?php echo ($row['job_type'] == 'Print File') ? 'selected' : ''; ?>>Print File</option>
                                    <option value="Event/Expo" <?php echo ($row['job_type'] == 'Event/Expo') ? 'selected' : ''; ?>>Event/Expo</option>
                                </select>

                                
                                <div class="input_field"> 
                                 <label class=""> Reference </label> 
                                    <div class="field" align="left">
                                    <h3>Upload your Files</h3>
                                    <input type="file" id="files" name="pdfFiles[]" multiple />
                                    </div>
                                </div>
                                <h3 class="text-center">(OR) </h3>

                                <label> Reference Link </label>  
                                  <div class="input_field">
                                  
                                  
                                  <input type="text" name="reference_link" placeholder="Reference Link"  />
                                 </div>
<!-- 
                                <div class="main-wrapper">
                                            <div class="upload-main-wrapper">
                                                    <div class="upload-wrapper">
                                                            <input type="file" id="upload-file" name="pdfFile">
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet" viewBox="224.3881704980842 176.8527621722847 221.13266283524905 178.8472378277154" width="221.13" height="178.85"><defs><path d="M357.38 176.85C386.18 176.85 409.53 204.24 409.53 238.02C409.53 239.29 409.5 240.56 409.42 241.81C430.23 246.95 445.52 264.16 445.52 284.59C445.52 284.59 445.52 284.59 445.52 284.59C445.52 309.08 423.56 328.94 396.47 328.94C384.17 328.94 285.74 328.94 273.44 328.94C246.35 328.94 224.39 309.08 224.39 284.59C224.39 284.59 224.39 284.59 224.39 284.59C224.39 263.24 241.08 245.41 263.31 241.2C265.3 218.05 281.96 199.98 302.22 199.98C306.67 199.98 310.94 200.85 314.93 202.46C324.4 186.96 339.88 176.85 357.38 176.85Z" id="b1aO7LLtdW"></path><path d="M306.46 297.6L339.79 297.6L373.13 297.6L339.79 255.94L306.46 297.6Z" id="c4SXvvMdYD"></path><path d="M350.79 293.05L328.79 293.05L328.79 355.7L350.79 355.7L350.79 293.05Z" id="b11si2zUk"></path></defs><g><g><g><use xlink:href="#b1aO7LLtdW" opacity="1" fill="#ffffff" fill-opacity="1"></use></g><g><g><use xlink:href="#c4SXvvMdYD" opacity="1" fill="#363535" fill-opacity="1"></use></g><g><use xlink:href="#b11si2zUk" opacity="1" fill="#363535" fill-opacity="1"></use></g></g></g></g></svg>
                                                            <span class="file-upload-text">Upload File</span>
                                                            <div class="file-success-text">
                                                            <svg version="1.1" id="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 100 100"  xml:space="preserve">
                                                    <circle style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-miterlimit:10;" cx="49.799" cy="49.746" r="44.757"/>
                                                    <polyline style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                                        27.114,51 41.402,65.288 72.485,34.205 "/>
                                                    </svg> <span>Successfully</span></div>
                                                        </div>
                                                        <p id="file-upload-name"></p>
                                            </div>
                                  </div> -->
                                <p class="p_upload_file"> Upload Max 15MB Image, Excel, PDF, doc </p>
                                </div>

                                <label> Notes and Other Details </label>  
                                <div class="input_field">
                                    
                                    <textarea id="w3schools" name="notes" rows="4" ><?php echo $row['notes']; ?></textarea>
                                    
                                </div>


                                <div class="text-center" style="margin:0 auto;">
                                <input class="button" type="submit" value="Submit" />
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
     
                      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"> </script>
    <script type="text/javascript">
      $("form").on("change", ".file-upload-field", function(){ 
    $(this).parent(".file-upload-wrapper").attr("data-text",         $(this).val().replace(/.*(\/|\\)/, '') );
});
    </script>
    <script>
  $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + "\" alt=\" File" + (file.name ? file.name : "") +"\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
      console.log(files);
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

     </script>  
    <script>
     $(document).ready(function(){
             $('#upload-file').change(function() {
                var filename = $(this).val();
                $('#file-upload-name').html(filename);
                if(filename!=""){
                    setTimeout(function(){
                        $('.upload-wrapper').addClass("uploaded");
                    }, 600);
                    setTimeout(function(){
                        $('.upload-wrapper').removeClass("uploaded");
                        $('.upload-wrapper').addClass("success");
                    }, 1600);
                }
            });
        });
    </script>
</body>
</html>