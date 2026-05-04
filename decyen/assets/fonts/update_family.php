<?php 
session_start();
if (isset($_SESSION['user_id'] ) && ($_SESSION['usertype'] == '') || ( $_SESSION['usertype'] == '') ){
  header('location:login.php');

}
else{
include('header.php');
include ('config.php');

$id=$_GET['id'];
echo $id;

$query ="SELECT * FROM family WHERE id='$id'";
$results=mysqli_query($conn, $query);

while ($rows=mysqli_fetch_array($results,MYSQLI_ASSOC)) {

?>



 <div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-title pt-3 ps-3 text-primary">
                  <h3>Update Family</h3>
                </div>
                <div class="card-body">
                  <form class="form-sample" id="family_update" method="POST">
                    <p class="card-description">
                      Family information
                    </p>
                   
                    <div class="row">
                      <div class="col-md-6">
                             <input type="hidden" name="id" value="<?php echo $id;?>"> 

                          <label class="form-label"><b>Name Of Head Of The Family</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="head_of_family_name" id="head_of_family_name" placeholder="Enter Name Of Head Of The Family" value="<?php echo $rows['head_of_family_name'];?>"required />
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>House Number</b></label>
                        <input type="text" class="form-control" name="house_number" id="house_number" placeholder="Enter House Number" value="<?php echo $rows['house_number'];?>" />
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Village Name</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="village_name" id="village_name" placeholder="Enter Village Name" value="<?php echo $rows['village_name'];?>" required />
                          <br>
                      </div>
                      <div class="col-md-6">  
                        <label class="form-label"><b>Full Address With Landmarks</b><span id="mandatory">&nbsp;*</span></label>
                        <input type="text" class="form-control" name="full_address" id="full_address" placeholder="Enter Full Address" value="<?php echo $rows['full_address'];?>" required />   
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-6">
                            <label class="form-label"><b>Date Of Birth</b></label>
                            <input type="date" class="form-control form-control" name="date_of_birth" id="date_of_birth" value="<?php echo $rows['date_of_birth'];?>">
                            <div id="dobcheck" class="err_check"></div>
                            <br>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label"><b>Age</b> </label>
                            <input type="number" class="form-control form-control" name="age" id="age" placeholder="Age" value="<?php echo $rows['age'];?>" >
                            <div id="agecheck" class="err_check"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Gender</b><span id="mandatory">&nbsp;*</span></label>
                        <select class="form-control" name="gender" id="gender" required>
                              <option value="">Choose Gender</option>
                              <option value="Male" <?php if($rows['gender'] == 'Male') echo 'selected';?>>Male</option>
                              <option value="Female" <?php if($rows['gender'] == 'Female') echo 'selected';?>>Female</option>
                              <option value="Others" <?php if($rows['gender'] == 'Others') echo 'selected';?>>Others</option>
                        </select> 
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Mobile Number</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Mobile Number" value="<?php echo $rows['phone_number'];?>" required>
                          <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Number Of Living Rooms</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="number" class="form-control" name="number_of_living_room" id="number_of_living_room" placeholder="Enter Number Of Living Rooms" value="<?php echo $rows['number_of_living_room'];?>"required>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label"><b>Living Room Area In Sq.ft</b></label>
                        <input type="text" class="form-control" name="living_room_area" id="living_room_area" placeholder="Enter Living Room Area(Sq.ft) " value="<?php echo $rows['living_room_area'];?>" />
                        <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Number of Family members</b><span id="mandatory">&nbsp;*</span></label>
                             <input type="text" class="form-control" name="number_of_family_members" id="number_of_family_members" placeholder="Enter Number Of Family Members" value="<?php echo $rows['number_of_family_members'];?>" required/>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label"><b>Overcrowding</b><span id="mandatory">&nbsp;*</span></label>
                        <select class="form-control" name="overcrowding" id="overcrowding" required>
                              <option value="">Choose </option>
                              <option value="Yes" <?php if($rows['overcrowding'] == 'Yes') echo 'selected';?>>Yes</option>
                              <option value="No" <?php if($rows['overcrowding'] == 'No') echo 'selected';?>>No</option>
                        </select> 
                        <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Aadhar Number</b>(Optional)</label>
                             <input type="text" class="form-control" name="adhaar_number" id="adhaar_number" placeholder="Enter Adhaar Number" value="<?php echo $rows['adhaar_number'];?>" />
                      </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label"><b>Type of Ration Card</b><span id="mandatory">&nbsp;*</span></label>
                       <select class="form-control" name="ration_card_type" id="ration_card_type" required>
                              <option value="">Choose </option>
                              <option value="BPL" <?php if($rows['ration_card_type'] == 'BPL') echo 'selected';?>>BPL</option>
                              <option value="APL"  <?php if($rows['ration_card_type'] == 'APL') echo 'selected';?>>APL</option>
                              <option value="Anthodaya Anna Yojana"  <?php if($rows['ration_card_type'] == 'Anthodaya Anna Yojana') echo 'selected';?>>Anthodaya Anna Yojana</option>
                              <option value="No Card">No Card</option>
                        </select> 
                        <br>
                    </div>

                    
                      
                      <!-- <div class="mt-3">
                          <label class="form-label"><b>Longitude & Lattitude</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="longtitude_and_latitude" id="longtitude_and_latitude" placeholder="Enter Longitude And Lattitude" value="<?php echo $rows['longtitude_and_latitude'];?>" required />
                    </div> -->

                    <div class="row mt-3">
                        <div class="col-md-6">
                          <label class="form-label"><b>Longitude & Lattitude</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="longtitude_and_latitude" id="longtitude_and_latitude" placeholder="Enter Longitude And Lattitude" value="<?php echo $rows['longtitude_and_latitude'];?>" required />
                        </div>
                      <!-- <div class="col-md-6">
                          <label class="form-label"><b>Mobile Number Of Student</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="number" class="form-control" name="mobile_number_student" id="mobile_number_student" placeholder="Enter Mobile Number Of Student" value="<?php echo $rows['mobile_number_student'];?>" required />
                          <br>
                      </div> -->
                      <div class="col-md-6">
                        <label class="form-label"><b>Next follow up visit</b><span id="mandatory">&nbsp;*</span></label>
                        <input type="date" class="form-control" name="follow_up_date" id="follow_up_date" value="<?php echo $rows['follow_up_date'];?>" readonly />
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

          <?php }
        }
	?>
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