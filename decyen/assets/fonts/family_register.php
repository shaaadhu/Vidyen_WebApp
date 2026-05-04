<?php 
session_start();
include('header.php');
include ('config.php');
$db=$conn;
$student_id="";
echo $id=$_GET['id'];

$query="SELECT * FROM student WHERE id='$id'";
$sqlstudent=mysqli_query($db,$query);
while($rows=mysqli_fetch_assoc($sqlstudent)){
   $student_id=$rows['student_id'];
}

?>



        <div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-title pt-3 ps-3 text-primary">
                  <h3>Enroll Family</h3>
                </div>
                <div class="card-body">
                  <form class="form-sample" id="family_register" method="POST">
                    <p class="card-description">
                      Family information
                    </p>
                   
                    <div class="row">
                      <div class="col-md-6">
                            <input type="hidden" name="student_id" value="<?php echo $student_id;?>">

                          <label class="form-label"><b>Name Of Head Of The Family</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="head_of_family_name" id="head_of_family_name" placeholder="Enter Name Of Head Of The Family"required />
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>House Number</b></label>
                        <input type="text" class="form-control" name="house_number" id="house_number" placeholder="Enter House Number" />
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Village Name</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="village_name" id="village_name" placeholder="Enter Village Name" required />
                          <br>
                      </div>
                      <div class="col-md-6">  
                        <label class="form-label"><b>Full Address With Landmarks</b><span id="mandatory">&nbsp;*</span></label>
                        <input type="text" class="form-control" name="full_address" id="full_address" placeholder="Enter Full Address" required />   
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-6">
                            <label class="form-label"><b>Date Of Birth</b></label>
                            <input type="date" class="form-control form-control" name="date_of_birth" id="date_of_birth">
                            <div id="dobcheck" class="err_check"></div>
                            <br>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label"><b>Age</b> </label>
                            <input type="number" class="form-control form-control" name="age" id="age" placeholder="Age" >
                            <div id="agecheck" class="err_check"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Gender</b><span id="mandatory">&nbsp;*</span></label>
                        <select class="form-control" name="gender" id="gender" required>
                              <option value="">Choose Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Others">Others</option>
                        </select> 
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Mobile Number</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Mobile Number"required>
                          <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Number Of Living Rooms</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="number" class="form-control" name="number_of_living_room" id="number_of_living_room" placeholder="Enter Number Of Living Rooms"required>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label"><b>Living Room Area In Sq.ft</b></label>
                        <input type="text" class="form-control" name="living_room_area" id="living_room_area" placeholder="Enter Living Room Area(Sq.ft) " />
                        <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Number of Family members</b><span id="mandatory">&nbsp;*</span></label>
                             <input type="text" class="form-control" name="number_of_family_members" id="number_of_family_members" placeholder="Enter Number Of Family Members" required/>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label"><b>Overcrowding</b><span id="mandatory">&nbsp;*</span></label>
                        <select class="form-control" name="overcrowding" id="overcrowding" required>
                              <option value="">Choose </option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                        </select> 
                        <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Aadhar Number</b>(Optional)</label>
                             <input type="text" class="form-control" name="adhaar_number" id="adhaar_number" placeholder="Enter Adhaar Number" />
                      </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label"><b>Type of Ration Card</b><span id="mandatory">&nbsp;*</span></label>
                       <select class="form-control" name="ration_card_type" id="ration_card_type" required>
                              <option value="">Choose </option>
                              <option value="BPL">BPL</option>
                              <option value="APL">APL</option>
                              <option value="Anthodaya Anna Yojana">Anthodaya Anna Yojana</option>
                              <option value="No Card">No Card</option>
                        </select> 
                        <br>
                    </div>

                    
                      
                      <div class="mt-3">
                          <label class="form-label"><b>Longitude & Lattitude</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="number" class="form-control" name="longtitude_and_latitude" id="longtitude_and_latitude" placeholder="Enter Longitude And Lattitude" required />
                    </div>

                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Mobile Number Of Student</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="number" class="form-control" name="mobile_number_student" id="mobile_number_student" placeholder="Enter Mobile Number Of Student" required />
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Next follow up visit</b><span id="mandatory">&nbsp;*</span></label>
                        <input type="date" class="form-control" name="follow_up_date" id="follow_up_date" disabled />
                      </div>
                    </div>


                    <div class="text-end mt-5">
                      <button type="submit" class="btn btn-primary" id="submit_family" method="post">Submit</button>
                      <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>

            
                  </form>
                </div>
              </div>
            </div>
          </div>

        <?php include('footer.php');?>
        <script type="text/javascript" src="ajax/family_register.js"></script>

        <script type="text/javascript">
         $(document).ready(function() {
          var now = new Date();

          var day = ("0" + now.getDate()).slice(-2);
          var month = ("0" + (now.getMonth() + 1)).slice(-2);
          var today = (now.getFullYear() + 1)+"-"+(month)+"-"+(day) ;

          $('#follow_up_date').val(today);
        });

   
         $('#date_of_birth').change(function(){
         var today = new Date();
          var birthDate = new Date($('#date_of_birth').val());
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age--;
          }
         $('#age').val(age);
              
        });

        </script>



