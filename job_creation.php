 <?php
 error_reporting(0);
include('top.php');
// include('connection.php');
$job_create=1;
 ?>
 
 <div class="wrapper">
 <?php
include('left.php');
include('nav.php');
 ?>  
       
      <div class="content-page">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                            <div class="" style="margin-bottom:30px;">
                      <div class="form_wrapper">
                        <div class="form_container">
                          <div class="title_container">
                            <h2>Job Creation</h2>
                          </div>
                          <div class="row clearfix">
                            <div class="">
                            <form  action="upload.php" method="POST" enctype="multipart/form-data">
                              <label> Choose Client </label>
                                    <div class="input_field select_option">
                                     
                                        <select name="client">
                                            <?php
        
                                            $category = mysqli_query($db,"SELECT * FROM clients ");
                                            // foreach ($category as $cat) {
                                        // $tat = $cat['name'];
                                        // echo $tat;
                                        while($cat = mysqli_fetch_array($category))
                                    {
                                        
                                        ?>
                                        
                                        <option value="<?php echo $cat['name'] ?>" ><?php echo $cat['name'] ?></option>
                                            
                                        
                                        <?php  }?>
                                       
                                        </select>
                                        <div class="select_arrow"></div>
                                  </div>
                                  <label> Name of the Job </label>  
                                  <div class="input_field">
                                  
                                  <span><i aria-hidden="true" class="fa fa-tasks"></i></span>
                                  <input type="text" name="job" placeholder="Name Of The Job" required />
                                 </div>
                                 <label> Assigned To </label>
                                 <div class="input_field select_option">
                                
                                        <select name="members" id="membersSelect">
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
                                        </select>
                                        <!-- <input type="text" name="memberIdHidden" id="memberIdHidden" value=""> -->
                                    <div class="select_arrow"></div>
                                    
                                  </div>
                            
                                
                                
                                <label> Date of Completion </label> 
                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-calendar"></i></span>
                                
                                <input placeholder=" Date of Completion" type="text" name="completion" onfocus="(this.type = 'date')"  id="completion">
                                </div>
                                <input type="hidden" id="assigned_by" name="assigned_by" value="<?php
                                $sqlquery ="Select * from members Where username='$log_name'";
                                $results=mysqli_query($db,$sqlquery);
                                while($cat2 = mysqli_fetch_array($results)){

                                echo $cat2['fname'];
                                } ?>" >


                                    <div class="row"> 
                                      <div class="col-md-6 col-lg-6">
                                            <label> Start Time </label> 
                                            
                                            
                                            <div class="input_field "> 
                                            
                                            <input type="time" id="timeInput" name="time_picker" min="9:00" max="19:00" >
                                            <span class="validity"></span>

                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <label> End Time </label> 
                                    
                                            <div class="input_field "> 
                                            
                                            <input type="time" id="timeInput" name="time_picker_end"  min="9:00" max="19:00" >
                                            <span class="validity"></span>
                                            </div>
                                        </div>
                                    </div>
                                <label> JOB TYPE </label> 
                                <div class="input_field select_option"> 
                         


                                <select name="job_type">
                                
                                <option value="Social Media" selected="">Social Media</option>
                                <option value="Website">Website</option>
                                <option value="Collaterals ">Collaterals</option>
                                
                                <option value="Print File">Print File</option>

                                <option value="Event/Expo">Event/Expo</option>
                        
                                </select>
                                        <div class="select_arrow"></div>
                                </div>
                                <div class="input_field"> 
                                  <div class="col-md-12 col-sm-12 booking-frm">
                                    <div class="field-holder">
                                      <label for="schedule_type">
                                        <input type="radio" name="schedule" id="schedule" checked="" value="Urgent">Urgent
                                      </label>
                                      <label for="schedule_type">
                                        <input type="radio" name="schedule" id="schedule" value="Not Urgent">Not Urgent
                                      </label>
                                    
                                    </div>
                                  </div>
                                 </div>

                                 <div class="input_field"> 
                                  <div class="col-md-12 col-sm-12 booking-frm">
                                    <div class="field-holder2">
                                      <label for="schedule_type">
                                        <input type="radio" name="schedule2" id="schedule" checked="" value="Important">Important
                                      </label>
                                      <label for="schedule_type">
                                        <input type="radio" name="schedule2" id="schedule" value="Not Important">Not Important
                                      </label>
                                    
                                    </div>
                                  </div>
                                 </div>

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

                                <label> Notes and Other Details </label>  
                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                  <textarea id="w3review" name="notes" rows="4" cols="50">

                                </textarea>
                                </div>

                                <div class="text-center" style="margin:0 auto;">
                                <input class="button" type="submit" value="Submit" />
                                </div>
                              </form>
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
</div>

    <!-- Wrapper End-->

    <?php
include('footer.php');
    ?>