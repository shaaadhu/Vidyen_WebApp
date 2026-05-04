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

$query ="SELECT * FROM individual WHERE id='$id'";
$results=mysqli_query($conn, $query);

while ($rows=mysqli_fetch_array($results,MYSQLI_ASSOC)) {

?>


<div class="content-wrapper">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-title pt-3 ps-3 text-primary">
            <h3>Enroll Individual</h3>
          </div>
          <div class="card-body">
            <form class="form-sample" id="update_individual" method="POST">
              <p class="card-description">
                Individual information
              </p>
              <input type="hidden" name="individual_id" value="<?php echo $id;?>">
              <div>
                <label class="form-label form-label"><b>Name</b><span id="mandatory">&nbsp;*</span> </label>
                <input type="text" class="form-control form-control-sm" id="individual_name" placeholder="Enter Name" name="individual_name" value="<?php echo $rows['individual_name'];?>" autocomplete="off" required>
                <div id="inamecheck" class="err_check"></div>
              </div>
              <!-- <div class="mt-3">
                
              </div> -->
              <div class="mt-3">
                <label class="form-label"><b>Gender</b><span id="mandatory">&nbsp;*</span> </label>
                            <select class="form-control form-control-sm" name="individual_gender" id="individual_gender"required>
                                  <option value="">Choose Gender</option>
                                  <option value="Male"<?php if($rows['individual_gender'] == 'Male') echo 'selected';?>>Male</option>
                                  <option value="Female"<?php if($rows['individual_gender'] == 'Female') echo 'selected';?>>Female</option>
                                  <option value="Others"<?php if($rows['individual_gender'] == 'Others') echo 'selected';?>>Others</option>
                            </select> 
                            <div id="igendercheck" class="err_check"></div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Mobile Number</b><span id="mandatory">&nbsp;*</span>  </label>
                <input type="number" class="form-control form-control-sm" placeholder="Enter Mobile Number" name="individual_mobile" id="individual_mobile" value="<?php echo $rows['individual_mobile'];?>"required>
                <div id="imobilecheck" class="err_check"></div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Adhaar Number</b>&nbsp;<span>(Optional)</span> </label>
                <input type="text" class="form-control form-control-sm" name="individual_adhaar" id="individual_adhaar" value="<?php echo $rows['individual_adhaar'];?>" placeholder="Enter Adhaar Number">
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  <label class="form-label"><b>Date Of Birth</b></label>
                  <input type="date" class="form-control form-control-sm" name="individual_date_of_birth" id="individual_date_of_birth" value="<?php echo $rows['individual_date_of_birth'];?>">
                  <div id="idobcheck" class="err_check"></div>
                  <br>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><b>Age</b> </label>
                  <input type="number" class="form-control form-control-sm" name="individual_age" id="individual_age" placeholder="Age" value="<?php echo $rows['individual_age'];?>">
                  <!-- <div id="iagecheck" class="err_check"></div> -->
                </div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Blood Group</b><span id="mandatory">&nbsp;*</span> </label>
                <select class="form-control form-control-sm" name="individual_bloodgroup" id="individual_bloodgroup"required>
                                  <option value="">Choose</option>
                                  <option value="A+"<?php if($rows['individual_bloodgroup'] == 'A+') echo 'selected';?>>A+</option>
                                  <option value="A-"<?php if($rows['individual_bloodgroup'] == 'A-') echo 'selected';?>>A-</option>
                                  <option value="AB+"<?php if($rows['individual_bloodgroup'] == 'AB+') echo 'selected';?>>AB+</option>
                                  <option value="AB-"<?php if($rows['individual_bloodgroup'] == 'AB-') echo 'selected';?>>AB-</option>
                                  <option value="B+"<?php if($rows['individual_bloodgroup'] == 'B+') echo 'selected';?>>B+</option>
                                  <option value="B-"<?php if($rows['individual_bloodgroup'] == 'B-') echo 'selected';?>>B-</option>
                                  <option value="O+"<?php if($rows['individual_bloodgroup'] == 'O+') echo 'selected';?>>O+</option>
                                  <option value="O-"<?php if($rows['individual_bloodgroup'] == 'O-') echo 'selected';?>>O-</option>
                            </select> 
                            <div id="ibgcheck"></div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Education</b><span id="mandatory">&nbsp;*</span> </label>
                            <select class="form-control form-control-sm" name="individual_education" id="individual_education"required>
                                  <option value="">Choose Education</option>
                                  <option value="Illiterate"<?php if($rows['individual_education'] == 'Illiterate') echo 'selected';?>>Illiterate</option>
                                  <option value="Primary"<?php if($rows['individual_education'] == 'Primary') echo 'selected';?>>Primary</option>
                                  <option value="Secondary"<?php if($rows['individual_education'] == 'Secondary') echo 'selected';?>>Secondary</option>
                                  <option value="Higher Secondary"<?php if($rows['individual_education'] == 'Higher Secondary') echo 'selected';?>>Higher Secondary</option>
                                  <option value="PUC"<?php if($rows['individual_education'] == 'PUC') echo 'selected';?>>PUC</option>
                                  <option value="Diploma"<?php if($rows['individual_education'] == 'Diploma') echo 'selected';?>>Diploma</option>
                                  <option value="Degree"<?php if($rows['individual_education'] == 'Degree') echo 'selected';?>>Degree</option>
                                  <option value="Postgraduate"<?php if($rows['individual_education'] == 'Postgraduate') echo 'selected';?>>Postgraduate</option>
                            </select> 
                            <div id="ieducheck"></div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Occupation</b><span id="mandatory">&nbsp;*</span> </label>
                            <select class="form-control form-control-sm" name="individual_occupation" id="individual_occupation"required>
                                  <option value="">Choose Occupation</option>
                                  <option value="Housewife"<?php if($rows['individual_occupation'] == 'Housewife') echo 'selected';?>>Housewife</option>
                                  <option value="Farmer"<?php if($rows['individual_occupation'] == 'Farmer') echo 'selected';?>>Farmer</option>
                                  <option value="Unskilled"<?php if($rows['individual_occupation'] == 'Unskilled') echo 'selected';?>>Unskilled</option>
                                  <option value="Skilled"<?php if($rows['individual_occupation'] == 'Skilled') echo 'selected';?>>Skilled</option>
                                  <option value="Petty Business"<?php if($rows['individual_occupation'] == 'Petty Business') echo 'selected';?>>Petty Business</option>
                                  <option value="Contactor"<?php if($rows['individual_occupation'] == 'Contactor') echo 'selected';?>>Contactor</option>
                                  <option value="Political Leader"<?php if($rows['individual_occupation'] == 'Political Leader') echo 'selected';?>>Political Leader</option>
                                  <option value="Teacher"<?php if($rows['individual_occupation'] == 'Teacher') echo 'selected';?>>Teacher</option>
                                  <option value="Doctor"<?php if($rows['individual_occupation'] == 'Doctor') echo 'selected';?>>Doctor</option>
                                  <option value="Health worker"<?php if($rows['individual_occupation'] == 'Health worker') echo 'selected';?>>Health worker</option>
                                  <option value="Lawyer"<?php if($rows['individual_occupation'] == 'Lawyer') echo 'selected';?>>Lawyer</option>
                                  <option value="Engineer"<?php if($rows['individual_occupation'] == 'Engineer') echo 'selected';?>>Engineer</option>
                                  <option value="Driver"<?php if($rows['individual_occupation'] == 'Driver') echo 'selected';?>>Driver</option>
                                  <option value="Retired"<?php if($rows['individual_occupation'] == 'Retired') echo 'selected';?>>Retired</option>
                                  <option value="Priest"<?php if($rows['individual_occupation'] == 'Priest') echo 'selected';?>>Priest</option>
                                  <option value="Student"<?php if($rows['individual_occupation'] == 'Student') echo 'selected';?>>Student</option>
                                  <option value="Others"<?php if($rows['individual_occupation'] == 'Others') echo 'selected';?>>Others</option>
                            </select> 
                            <div id="iocccheck"></div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Relation with Head Of Family</b><span id="mandatory">&nbsp;*</span> </label>
                            <select class="form-control form-control-sm" name="individual_relation_with_head" id="individual_relation_with_head"required>
                                  <option value="">Choose Relation</option>
                                  <option value="Self"<?php if($rows['individual_relation_with_head'] == 'Self') echo 'selected';?>>Self</option>
                                  <option value="Spouse"<?php if($rows['individual_relation_with_head'] == 'Spouse') echo 'selected';?>>Spouse</option>
                                  <option value="Son"<?php if($rows['individual_relation_with_head'] == 'Son') echo 'selected';?>>Son</option>
                                  <option value="Daughter"<?php if($rows['individual_relation_with_head'] == 'Daughter') echo 'selected';?>>Daughter</option>
                                  <option value="Mother"<?php if($rows['individual_relation_with_head'] == 'Mother') echo 'selected';?>>Mother</option>
                                  <option value="Father"<?php if($rows['individual_relation_with_head'] == 'Father') echo 'selected';?>>Father</option>
                                  <option value="Brother"<?php if($rows['individual_relation_with_head'] == 'Brother') echo 'selected';?>>Brother</option>
                                  <option value="Sister"<?php if($rows['individual_relation_with_head'] == 'Sister') echo 'selected';?>>Sister</option>
                                  <option value="Other"<?php if($rows['individual_relation_with_head'] == 'Other') echo 'selected';?>>Other</option>
                            </select> 
                            <div id="irelcheck"></div>
              </div>
          

              <div class="row mt-3">
                <div class="col-md-4">
                  <label class="form-label"><b>Are You Student?</b><span id="mandatory">&nbsp;*</span> </label>
                  <div class="row ">
                    <div class="col-md-6 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_student" id="student1" value="yes" <?php if($rows['individual_student']=='yes') echo 'checked'; ?> required>
                        <label class="form-check-label" for="student1">
                          Yes
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_student" id="student2" value="no" <?php if($rows['individual_student']=='no') echo 'checked'; ?>>
                        <label class="form-check-label" for="student2">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <div id="istudcheck"></div>
                </div>
                <?php if ($rows['individual_student'] == 'yes' ) {  
                  $db= $conn;
                  $sql1 = "SELECT * FROM `study_history` WHERE `individual_id` = '$id'";
                  $rowcon1 = mysqli_query($db, $sql1);
                  while ($rows1 = mysqli_fetch_assoc($rowcon1)) {
                  ?>

                <div class="col-md-4 college" >
                  <label class="form-label"><b>Name Of The School/College</b></label>
                  <input type="text" class="form-control form-control-sm studnull" name="insitution_name" id="insitution_name" placeholder="Enter Institution Name" value="<?php echo $rows1['insitution_name'] ?>">
                  <br>
                </div>
                <div class="col-md-4 college" >
                  <label class="form-label"><b>Which Standard?</b></label>
                  <input type="text" class="form-control form-control-sm studnull"
                  name="standard_semester" id="standard_semester" placeholder="Enter Standard" value="<?php echo $rows1['standard_semester'] ?>">
                </div>
                 <?php 
               }
               } ?>
              </div>
              <?php if ($rows['individual_age'] < 5 ) {  ?>
              <div class="row mt-4 align-items-center" id="ud5">
                <div class="col-md-4">
                  <label class="form-label"><b>Underfive child?</b><span id="mandatory">&nbsp;*</span> </label>
                  <div class="row ">
                    <div class="col-md-6 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="underfive_yes_no" id="underfive1" value="yes" <?php if($rows['underfive_yes_no']=='yes') echo 'checked'; ?>>
                        <label class="form-check-label" for="underfive1">
                          Yes
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="underfive_yes_no" id="underfive2" value="no"<?php if($rows['underfive_yes_no']=='no') echo 'checked'; ?>>
                        <label class="form-check-label" for="underfive2">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <div id="iufivecheck"></div>
                </div>
              </div>
               



               <?php if ($rows['underfive_yes_no'] == 'yes' ) {  ?>
              <div class="mt-3" id="ifvac" >
                
                <label class="form-label"><b>If Yes What Vaccines Taken So Far?</b></label>
                <table class="table table-sm table-responsive-lg dt " width="100%" cellspacing="0">
                   <?php 
                      //echo $id;
                        $rowdata_query="SELECT a.vaccination_id as vaccination_id, a.vaccination_value as vaccination_value, b.vaccination_name as vaccination_name FROM `vaccination_history` a, `vaccination` b WHERE a.vaccination_id= b.id and a.individual_id='$id'";
                      
                        $row_vaccine=mysqli_query($conn,$rowdata_query);
                       
                         while($rows_vaccine=mysqli_fetch_array($row_vaccine)){
                          $SQ1 = $rows_vaccine['vaccination_name'];
$sq = str_replace(" ","_","$SQ1");
                          ?>
                  <tr>
                    <td><b><?php echo $rows_vaccine['vaccination_name']; ?></b></td>
                    <td><div class="form-check">
                        <input type="radio" class="form-check-input" name="<?php echo $sq; ?>" id="<?php echo $rows_vaccine['vaccination_name']; ?>" value="yes" 
                        <?php if($rows_vaccine['vaccination_value'] == 'yes' ){echo 'checked';
                        } 
                          ?>> 
                        <label class="form-check-label">Yes</label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check">
                      <input type="radio" class="form-check-input" name="<?php echo $sq; ?>" id="<?php echo $rows_vaccine['vaccination_name']; ?>" value="no" <?php if($rows_vaccine['vaccination_value'] == 'no'){ echo 'checked'; } ?>>
                        <label class="form-check-label">  No </label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check">
                        <?php if($rows_vaccine['vaccination_name']!= 'BCG' && $rows_vaccine['vaccination_name']!= 'Hepatitis B Birth Dose' && $rows_vaccine['vaccination_name']!= 'OPV Zero Dose'){ ?>
                      <input type="radio" class="form-check-input" name="<?php echo $sq; ?>" id="<?php echo $rows_vaccine['vaccination_name']; ?>" value="na" <?php if($rows_vaccine['vaccination_value'] == 'na'){ echo 'checked'; } ?>>
                        <label class="form-check-label">  NA </label>
                      </div>
                    </td>
                  </tr>
                <?php }} ?>
                  
                </table>
              
              </div>
              

              <div class="mt-3" id="immusatate" >
                <label class="form-label"><b>Immunization Status</b><span id="mandatory">&nbsp;*</span> </label>
                            <select class="form-control form-control-sm" name="immunization" id="immunization" >
                                  <option value="">Choose Status</option>
                                  <option value="Unimmunised"<?php if($rows['immunization'] == 'Unimmunised') echo 'selected';?>>Unimmunised</option>
                                  <option value="Partially Immunised"<?php if($rows['immunization'] == 'Partially Immunised') echo 'selected';?>>Partially Immunised</option>
                                  <option value="Fully Immunised"<?php if($rows['immunization'] == 'Fully Immunised') echo 'selected';?>>Fully Immunised</option>
                                  <option value="Immunised Till Date"<?php if($rows['immunization'] == 'Immunised Till Date') echo 'selected';?>>Immunised Till Date </option>
                            </select> 
                            <div id="immucheck"></div>
              </div>
              <?php } ?>
              <?php } ?>

              
              <div class="mt-3" >
                <?php if($rows['individual_age'] > 17){ ?>
              <input type="button" class="btn btn-primary" onclick="myFunction()" value="Get Alcohol And Tobacco Usage" id="AT">
              <?php } ?>
              <div class ="mt-3" id="alcohol_div" style="display:none;">
                
                <label class="form-label"><b>Alcohol Use</b><span id="mandatory">&nbsp;*</span> </label>
                <select class="form-control form-control-sm" name="individual_alcohol_usage" id="individual_alcohol_usage"required>
                                  <option value="">Choose</option>
                                  <option value="No alcohol use"<?php if($rows['individual_alcohol_usage'] == 'No alcohol use') echo 'selected';?>>No alcohol use</option>
                                  <option value="Daily use"<?php if($rows['individual_alcohol_usage'] == 'Daily use') echo 'selected';?>>Daily use</option>
                                  <option value="1-4 days a week"<?php if($rows['individual_alcohol_usage'] == '1-4 days a week') echo 'selected';?>>1-4 days a week</option>
                                  <option value="1-3 days a month"<?php if($rows['individual_alcohol_usage'] == '1-3 days a month') echo 'selected';?>>1-3 days a month</option>
                                  <option value="less than once a month"<?php if($rows['individual_alcohol_usage'] == 'less than once a month') echo 'selected';?>>less than once a month</option>
                            </select>
                            <div id="ialcocheck"></div> 
                           
              </div>
              <div class="mt-3" id="tobacco_div" style="display:none;">
                <label class="form-label"><b>Tobacco Use</b><span id="mandatory">&nbsp;*</span> </label>
                <select class="form-control form-control-sm" name="individual_tobacco_usage" id="individual_tobacco_usage"required>
                                  <option value="">Choose</option>
                                  <option value="no tobacco use"<?php if($rows['individual_tobacco_usage'] == 'no tobacco use') echo 'selected';?>>No tobacco use</option>
                                  <option value="smokeless"<?php if($rows['individual_tobacco_usage'] == 'Smokeless form') echo 'selected';?>>Smokeless form</option>
                                  <option value="Smoking form"<?php if($rows['individual_tobacco_usage'] == 'Smoking form') echo 'selected';?>>Smoking form</option>
                                  <option value="Both"<?php if($rows['individual_tobacco_usage'] == 'Both') echo 'selected';?>>Both</option>
                            </select>
                            <div id="itobaccocheck"></div> 
              </div>
              
</div>
              <div class=" mt-3">
                  <label class="form-label"><b>Diet</b><span id="mandatory">&nbsp;*</span> </label>
                  <select class="form-control form-control-sm" name="individual_diet" id="individual_diet"required>
                                    <option value="">Choose</option>
                                    <option value="Veg"<?php if($rows['individual_diet'] == 'Veg') echo 'selected';?>>Veg</option>
                                    <option value="Mixed diet"<?php if($rows['individual_diet'] == 'Mixed diet') echo 'selected';?>>Mixed diet</option>
                          </select> 
                          <div id="idietcheck"></div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Health Status </b>(Multiple options)<span id="mandatory">&nbsp;*</span> </label>
                <div>
                  <label class="form-label">1.&nbsp;Chronic Illness<span id="mandatory">&nbsp;*</span></label>
                  <div class="row">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="ichronic" id="chronic1" value="yes" <?php if($rows['individual_chronic_illness']!='') echo 'checked'; ?> required >
                        <label class="form-check-label" for="chronic1">Yes
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="ichronic" id="chronic2" value="no"<?php if($rows['individual_chronic_illness']=='no') echo 'checked'; ?> >
                        <label class="form-check-label" for="chronic2">No</label>
                      </div>
                    </div>
                  </div>
                  <div id="chronicso" >
                    <?php if ($rows['individual_chronic_illness'] != '' ) {  ?>
                    <label class="form-label">If Yes</label>
                    <textarea  class="form-control form-control-sm" rows="4" name="individual_chronic_illness" id="individual_chronic_illness" value=""><?php echo $rows['individual_chronic_illness'];?></textarea>
                  </div>
                  <?php } ?>
                </div>

                <div class="mt-2">
                  <label class="form-label">2.&nbsp;Acute Illness (two weeks)<span id="mandatory">&nbsp;*</span></label>
                  <div class="row">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="iacute" id="acute1" value="yes"<?php if($rows['individual_acute_illness']!='') echo 'checked'; ?> required >
                        <label class="form-check-label" for="acute1">Yes
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="iacute" id="acute2" value="no"<?php if($rows['individual_acute_illness']=='no') echo 'checked'; ?> >
                        <label class="form-check-label" for="acute2">No</label>
                      </div>
                    </div>
                  </div>
                  <?php if ($rows['individual_acute_illness'] != '' ) {  ?>
                  <div id="acuteso" >
                    <label class="form-label">If Yes</label>
                    <textarea class="form-control form-control-sm" rows="4" name="individual_acute_illness" id="individual_acute_illness" value=""><?php echo $rows['individual_acute_illness'];?></textarea>
                  </div>
                  <?php } ?>
                </div>

                <div class="mt-2">
                  <label class="form-label">3.&nbsp;Flu like illness<span id="mandatory">&nbsp;*</span></label>
                  <div class="row">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_flu_illness" id="flu1" value="yes"<?php if($rows['individual_flu_illness']=='yes') echo 'checked'; ?> required >
                        <label class="form-check-label" for="flu1">Yes
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_flu_illness" id="flu2" value="no"<?php if($rows['individual_flu_illness']=='no') echo 'checked'; ?> >
                        <label class="form-check-label" for="flu2">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-2">
                  <label class="form-label">4.&nbsp;Maleria<span id="mandatory">&nbsp;*</span></label>
                  <div class="row">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_maleria" id="maleria1" value="yes" <?php if($rows['individual_maleria']=='yes') echo 'checked'; ?> required>
                        <label class="form-check-label" for="maleria1">Yes
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_maleria" id="maleria2" value="no" <?php if($rows['individual_maleria']=='no') echo 'checked'; ?> >
                        <label class="form-check-label" for="maleria2">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-2">
                  <label class="form-label">5.&nbsp;Dengue<span id="mandatory">&nbsp;*</span></label>
                  <div class="row">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_dengue" id="dengue1" value="yes" <?php if($rows['individual_dengue']=='yes') echo 'checked'; ?> required>
                        <label class="form-check-label" for="dengue1">Yes
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_dengue" id="dengue2" value="no" <?php if($rows['individual_dengue']=='no') echo 'checked'; ?> >
                        <label class="form-check-label" for="dengue2">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-2">
                  <label class="form-label">6.&nbsp;Tuberculosis<span id="mandatory">&nbsp;*</span></label>
                  <div class="row">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_tuberculosis" id="tuber1" value="yes" <?php if($rows['individual_tuberculosis']=='yes') echo 'checked'; ?> required>
                        <label class="form-check-label" for="tuber1">Yes
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_tuberculosis" id="tuber2" value="no" <?php if($rows['individual_tuberculosis']=='no') echo 'checked'; ?> >
                        <label class="form-check-label" for="tuber2">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-3">
                <label class="form-label">7.&nbsp;Known case of HT?<span id="mandatory">&nbsp;*</span> </label>
                <div class="row ">
                  <div class="col-md-3 ps-5">
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="known_hypertension" id="ht1" value="yes" <?php if($rows['known_hypertension']=='yes') echo 'checked'; ?> required>
                      <label class="form-check-label" for="ht1">Yes</label>
                    </div>
                  </div>
                  <div class="col-md-3 ps-5">
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="known_hypertension" id="ht2" value="no" <?php if($rows['known_hypertension']=='no') echo 'checked'; ?> required>
                      <label class="form-check-label" for="ht2">No</label>
                    </div>
                  </div>
                  <div class="col-md-3 ps-5">
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="known_hypertension" id="ht3" value="do not know" <?php if($rows['known_hypertension']=='do not know') echo 'checked'; ?> required >
                      <label class="form-check-label" for="ht3">Do Not Know</label>
                    </div>
                  </div>
                  <div class="col-md-3 ps-5">
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="known_hypertension" id="ht4" value="na" <?php if($rows['known_hypertension']=='na') echo 'checked'; ?> required >
                      <label class="form-check-label" for="ht4">NA</label>
                    </div>
                  </div>
                </div>
                <div id="ikchcheck"></div>
              </div>
                <div class="mt-3">
                  <label class="form-label">8.&nbsp;Known Case of DM?<span id="mandatory">&nbsp;*</span> </label>
                  <div class="row ">
                    <div class="col-md-3 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="known_dm" id="dm1" value="yes" <?php if($rows['known_dm']=='yes') echo 'checked'; ?>  required>
                        <label class="form-check-label" for="dm1">Yes</label>
                      </div>
                    </div>
                    <div class="col-md-3 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="known_dm" id="dm2" value="no" <?php if($rows['known_dm']=='no') echo 'checked'; ?> > 
                        <label class="form-check-label" for="dm2">No</label>
                      </div>
                    </div>
                    <div class="col-md-3 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="known_dm" id="dm3" value="do not know" <?php if($rows['known_dm']=='do not know') echo 'checked'; ?>  >
                        <label class="form-check-label" for="dm3">Do Not Know</label>
                      </div>
                    </div>
                    <div class="col-md-3 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="known_dm" id="dm4" value="na" <?php if($rows['known_dm']=='na') echo 'checked'; ?>  >
                        <label class="form-check-label" for="dm4">NA</label>
                      </div>
                    </div>
                  </div>
                  <div id="ikcdcheck"></div>
                </div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Teeth Related Questions?</b><span id="mandatory">&nbsp;*</span></label>
                <div class="row ">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="teeth_related_questions" id="teeth_related_questions1" value="applicable"<?php if($rows['teeth_related_questions']=='applicable') echo 'checked'; ?> >
                        <label class="form-check-label" for="teeth_related_questions1">Applicable
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="teeth_related_questions" id="teeth_related_questions2" value="not applicable" <?php if($rows['teeth_related_questions']=='not applicable') echo 'checked'; ?> >
                        <label class="form-check-label" for="teeth_related_questions2">Not Applicable</label>
                      </div>
                    </div>
                </div>
              </div>

              <?php if ($rows['teeth_related_questions'] == 'applicable' ) {  ?>
              <div class="row mt-3 teeth_ques" >
                <div class="col-md-6">
                  <label class="form-label"><b>How do you generally clean your teeth?</b><span id="mandatory">&nbsp;*</span></label>
                  <div class="row ">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_clean_teeth" id="teeth1" value="fingers" <?php if($rows['individual_clean_teeth']=='fingers') echo 'checked'; ?> >
                        <label class="form-check-label" for="teeth1">Fingers
                        </label>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_clean_teeth" id="teeth2" value="tooth brush" <?php if($rows['individual_clean_teeth']=='tooth brush') echo 'checked'; ?> >
                        <label class="form-check-label" for="teeth2">Tooth brush</label>
                      </div>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_clean_teeth" id="teeth3" value="others" <?php if($rows['individual_clean_teeth']=='others') echo 'checked'; ?> >
                        <label class="form-check-label" for="teeth3">Others</label>
                      </div>
                    </div>
                  </div>
                  <div id="ibrushcheck"></div>
                </div>
                <?php //if ($rows['individual_clean_teeth'] == 'others' ) {  ?>
                <div class="col-md-6" id="ifbrush" style="display:none;">
                  <label class="form-label"><b>If Others Specify</b></label>
                  <input type="text" class="form-control form-control-sm" name="individual_teeth_other" id="individual_teeth_other" value="<?php echo $rows['individual_teeth_other'];?>" >
                </div>
                <?php// } ?>
              </div>
              <div class="row mt-3 teeth_ques" >
                <div class="col-md-6">
                  <label class="form-label"><b>How often do you clean your teeth in a day?</b><span id="mandatory">&nbsp;*</span></label>
                  <select class="form-control form-control-sm" name="individual_clean_day" id="individual_clean_day">
                                    <option value="">Choose</option>
                                    <option value="Once"<?php if($rows['individual_clean_day'] == 'Once') echo 'selected';?>>Once</option>
                                    <option value="Twice"<?php if($rows['individual_clean_day'] == 'Twice') echo 'selected';?>>Twice</option>
                                    <option value="Thrice"<?php if($rows['individual_clean_day'] == 'Thrice') echo 'selected';?>>Thrice</option>
                                    <option value="After every meal"<?php if($rows['individual_clean_day'] == 'After every meal') echo 'selected';?>>After every meal</option>
                                    <option value="Dont clean everyday"<?php if($rows['individual_clean_day'] == 'Dont clean everyday') echo 'selected';?>>Don't clean everyday</option>
                              </select> 
                              <div id="icleancheck"></div>
                              <br>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><b>What material generally you use to clean your teeth?</b><span id="mandatory">&nbsp;*</span></label>
                  <select class="form-control form-control-sm" name="individual_material_for_clean" id="individual_material_for_clean">
                                    <option value="">Choose</option>
                                    <option value="Toothpaste"<?php if($rows['individual_material_for_clean'] == 'Toothpaste') echo 'selected';?>>Toothpaste</option>
                                    <option value="Tooth powder"<?php if($rows['individual_material_for_clean'] == 'Tooth powder') echo 'selected';?>>Tooth powder</option>
                                    <option value="Other"<?php if($rows['individual_material_for_clean'] == 'Other') echo 'selected';?>>Other</option>
                              </select> 
                              <div id="imatcheck"></div>
                </div>
              </div>
              <div class="mt-3 teeth_ques" >
                <label class="form-label"><b>Check toothpaste/tooth powder used and record whether it is fluoridated or not?</b><span id="mandatory">&nbsp;*</span></label>
                <select class="form-control form-control-sm" name="individual_paste_kind" id="individual_paste_kind">
                                  <option value="">Choose</option>
                                  <option value="Yes"<?php if($rows['individual_paste_kind'] == 'Yes') echo 'selected';?>>Yes</option>
                                  <option value="No"<?php if($rows['individual_paste_kind'] == 'No') echo 'selected';?>>No</option>
                                  <option value="Cant say"<?php if($rows['individual_paste_kind'] == 'Cant say') echo 'selected';?>>Can't say</option>
                            </select> 
                            <div id="ipastecheck"></div>
              </div>
              <div class=" mt-3 teeth_ques" >
                  <label class="form-label"><b>How often do you change your toothbrush?</b><span id="mandatory">&nbsp;*</span></label>
                  <select class="form-control form-control-sm" name="individual_change_brush" id="individual_change_brush">
                                    <option value="">Choose</option>
                                    <option value="1-3 months"<?php if($rows['individual_change_brush'] == '1-3 months') echo 'selected';?>>1-3 months</option>
                                    <option value="4-6 months"<?php if($rows['individual_change_brush'] == '4-6 months') echo 'selected';?>>4-6 months</option>
                                    <option value=">6 months"<?php if($rows['individual_change_brush'] == '>6 months') echo 'selected';?>>>6 months</option>
                                    <option value="Not using toothbrush"<?php if($rows['individual_change_brush'] == 'Not using toothbrush') echo 'selected';?>>Not using toothbrush</option>
                              </select> 
                              <div id="ichangebcheck"></div>
              </div>
              <div class="mt-3 teeth_ques" >
               <?php $oral_hygine=explode("," ,$rows['individual_oral_hygine_aids']);?>
                <label class="form-label"><b>Do you use any of these oral hygine aids? (Tick as many as reported)</b><span id="mandatory">&nbsp;*</span></label>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" <?php echo (in_array("Dental floss", $oral_hygine)?'checked':''); ?> id="oralhygine1" value="Dental floss">
                    <label class="form-check-label" for="oralhygine1">Dental floss</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine2" <?php echo (in_array("Interdental brush", $oral_hygine)?'checked':''); ?> value="Interdental brush">
                    <label class="form-check-label" for="oralhygine2">Interdental brush</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine3" <?php echo (in_array("Toothpick", $oral_hygine)?'checked':''); ?> value="Toothpick">
                    <label class="form-check-label" for="oralhygine3">Toothpick</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine4" <?php echo (in_array("Mouthrinse", $oral_hygine)?'checked':''); ?> value="Mouthrinse">
                    <label class="form-check-label" for="oralhygine4">Mouthrinse</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine5" <?php echo (in_array("Others", $oral_hygine)?'checked':''); ?> value="Others">
                    <label class="form-check-label" for="oralhygine5">Others</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine6" <?php echo (in_array("None", $oral_hygine)?'checked':''); ?> value="None">
                    <label class="form-check-label" for="oralhygine6">None</label>
                  </div>
                  <div id="iohygcheck"></div>
              </div>
              <div class="row mt-3 teeth_ques" >
                <div class="col-md-6">
                  <label class="form-label"><b>Have you suffered from any mouth or teeth problems in the last one year?</b><span id="mandatory">&nbsp;*</span></label>
                  <div class="row ">
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_mouth_problem" id="mouth1" value="yes" <?php if($rows['individual_mouth_problem']=='yes') echo 'checked'; ?> >
                        <label class="form-check-label" for="mouth1">Yes
                        </label>
                      </div>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_mouth_problem" id="mouth2" value="no"<?php if($rows['individual_mouth_problem']=='no') echo 'checked'; ?>  >
                        <label class="form-check-label" for="mouth2">No</label>
                      </div>
                    </div>
                    <div class="col-md-4 ps-5">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="individual_mouth_problem" id="mouth3" value="cant say"<?php if($rows['individual_mouth_problem']=='cant say') echo 'checked'; ?>  >
                        <label class="form-check-label" for="mouth3">Can't say</label>
                      </div>
                    </div>
                  </div>
                  <div id="itprobcheck"></div>
                </div>
                <?php if ($rows['individual_mouth_problem'] == 'yes' ) {  ?>

                <div class="col-md-6" id="one_year_prob">
                  <?php $mouth_check=explode("," ,$rows['individual_mouth_check']);?>
                  <label class="form-label"><b>What were or was the problems?</b><span id="mandatory">&nbsp;*</span></label>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck1" value="Tooth decay"  <?php echo (in_array("Tooth decay", $mouth_check)?'checked':''); ?>>
                    <label class="form-check-label" for="mcheck1">Tooth decay</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck2" value="Foul breath/bleeding gums/ Gum disease" <?php echo (in_array("Foul breath/bleeding gums/ Gum disease", $mouth_check)?'checked':''); ?>>
                    <label class="form-check-label" for="mcheck2">Foul breath/bleeding gums/ Gum disease</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck3" value="Broken teeth/Trauma" <?php echo (in_array("Broken teeth/Trauma", $mouth_check)?'checked':''); ?>>
                    <label class="form-check-label" for="mcheck3">Broken teeth/Trauma</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck4" value="Abscess" <?php echo (in_array("Abscess", $mouth_check)?'checked':''); ?>>
                    <label class="form-check-label" for="mcheck4">Abscess</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck5" value="Crooked teeth" <?php echo (in_array("Crooked teeth", $mouth_check)?'checked':''); ?>>
                    <label class="form-check-label" for="mcheck5">Crooked teeth</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck6" value="Ulcer" <?php echo (in_array("Ulcer", $mouth_check)?'checked':''); ?>>
                    <label class="form-check-label" for="mcheck6">Ulcer</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck7" value="Other" <?php echo (in_array("Other", $mouth_check)?'checked':''); ?>>
                    <label class="form-check-label" for="mcheck7">Other</label>
                  </div>
                  <div id="iprobcheck"></div>
                </div>
              <?php } ?>
              </div>
              <div class=" mt-3 teeth_ques" >
                  <label class="form-label"><b>How accessible are the dental facilities for treatment with avialable transport?</b><span id="mandatory">&nbsp;*</span></label>
                  <select class="form-control form-control-sm" name="individual_transport_dental" id="individual_transport_dental">
                                    <option value="">Choose</option>
                                    <option value="> half an hour"<?php if($rows['individual_transport_dental'] == '> half an hour') echo 'selected';?>>> half an hour</option>
                                    <option value="Half an hour to 1 hour"<?php if($rows['individual_transport_dental'] == 'Half an hour to 1 hour') echo 'selected';?>>Half an hour to 1 hour</option>
                                    <option value=">1 hour"<?php if($rows['individual_transport_dental'] == '>1 hour') echo 'selected';?>>>1 hour</option>
                                    <option value="Cant say"<?php if($rows['individual_transport_dental'] == 'Cant say') echo 'selected';?>>Can't say</option>
                              </select> 
                              <div id="iaccesscheck"></div>
              </div>
              <div class="mt-3 teeth_ques" >
                <?php $major_factor=explode("," ,$rows['individual_major_factor']);?>
                <label class="form-label"><b>What in your opinion are the major factors which causes dental problems?</b> (Tick as many as reported)<span id="mandatory">&nbsp;*</span></label>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor1" value="Eating sweets such as icecreams/chocolate" <?php echo (in_array("Eating sweets such as icecreams/chocolate", $major_factor)?'checked':''); ?>>
                    <label class="form-check-label" for="factor1">Eating sweets such as icecreams/chocolate</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor2" value="Not brushing regularly" <?php echo (in_array("Not brushing regularly", $major_factor)?'checked':''); ?>>
                    <label class="form-check-label" for="factor2">Not brushing regularly</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor3" value="Not rinsing regularly" <?php echo (in_array("Not rinsing regularly", $major_factor)?'checked':''); ?>>
                    <label class="form-check-label" for="factor3">Not rinsing regularly</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor4" value="Consuming tobacco products" <?php echo (in_array("Consuming tobacco products", $major_factor)?'checked':''); ?>>
                    <label class="form-check-label" for="factor4">Consuming tobacco products</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor5" value="Other specify" <?php echo (in_array("Other specify", $major_factor)?'checked':''); ?>>
                    <label class="form-check-label" for="factor5">Other specify</label>
                  </div>
                  <div class="form-check ps-5">
                    <input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor6" value="Dont know" <?php echo (in_array("Dont know", $major_factor)?'checked':''); ?>>
                    <label class="form-check-label" for="factor6">Don't know</label>
                  </div>
                  <div id="icdentcheck"></div>
              </div>
              <?php } ?>
              <div class="mt-3">
                <label class="form-label"><b>Health Needs</b><span id="mandatory">&nbsp;*</span></label>
                <textarea  class="form-control form-control-sm" name="individual_health_needs" id="individual_health_needs" required><?php echo $rows['individual_health_needs'];?></textarea>
              </div>
              <div class=" mt-3">
                  <label class="form-label"><b>Action Required</b><span id="mandatory">&nbsp;*</span></label>
                  <select class="form-control form-control-sm" name="individual_action_required" id="individual_action_required"required>
                                    <option value="">Choose</option>
                                    <option value="Referral to tertiary care"<?php if($rows['individual_action_required'] == 'Referral to tertiary care') echo 'selected';?>>Referral to tertiary care</option>
                                    <option value="Referral to YMCH"<?php if($rows['individual_action_required'] == 'Referral to YMCH') echo 'selected';?>>Referral to YMCH</option>
                                    <option value="Referral to YDCH"<?php if($rows['individual_action_required'] == 'Referral to YDCH') echo 'selected';?>>Referral to YDCH</option>
                                    <option value="Referral to CHC/PHC"<?php if($rows['individual_action_required'] == 'Referral to CHC/PHC') echo 'selected';?>>Referral to CHC/PHC</option>
                                    <option value="Follow up by MSW/ASHA"<?php if($rows['individual_action_required'] == 'Follow up by MSW/ASHA') echo 'selected';?>>Follow up by MSW/ASHA</option>
                                    <option value="Follow up by student"<?php if($rows['individual_action_required'] == 'Follow up by student') echo 'selected';?>>Follow up by student</option>
                              </select> 
                              <div id="iactioncheck"></div>
              </div>
              
              
              <div class="text-center mt-5">
                  <button type="submit" class="btn btn-primary" id="submit_individual">Submit</button>
                            
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
  <script type="text/javascript" src="ajax/individual.js"></script>
  <script type="text/javascript">
    $( document ).ready(function() {

// student check
    $("#student1").click(function() {
    if($(this).is(":checked"))    
            $(".college").show();
        else{
            $(".college").hide();
            $(".studnull").val('');
           
        }
    });
  $("#student2").click(function() {
    if($(this).is(":checked")) {   
            $(".college").hide();
        $(".studnull").val('') ;
    }
        else{
            $(".college").hide();
        $(".studnull").val('') ;
       
    }
    });

// underfive check
  $('#individual_date_of_birth').change(function(){
         var today = new Date();
          var birthDate = new Date($('#individual_date_of_birth').val());
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age--;
          }
         $('#individual_age').val(age);
            if(age < 5)
                {
                    $('#underfive1').prop('checked',true);
                    $("#ud5").show();
                    $("#ifvac").show();
                    $("#immusatate").show();
                

                 }
            else{
                $('#underfive2').prop('checked',true);
                $("#ud5").hide();
                $("#ifvac").hide();
                $("#immusatate").hide();
                

            }
              
        });


  $("#individual_age").change(function() {
     var age = $("#individual_age").val();
    
   if(age <5)
    {
      $('#underfive1').prop('checked',true);
      $("#ud5").show();
      $("#ifvac").show();
      $("#immusatate").show(); 
    }
    else{
      
       $('#underfive2').prop('checked',true);
      $("#ud5").hide();
      $("#ifvac").hide();
      $("#immusatate").hide();
     
    }
});

  $("#underfive1").click(function() {
    if($(this).is(":checked")){    
            $("#ifvac").show();
            $("#immusatate").show();
        }
        else{
            $("#ifvac").hide();
            $("#immusatate").hide();
        }
    });
  $("#underfive2").click(function() {
    if($(this).is(":checked")){    
            $("#ifvac").hide();
            $("#immusatate").hide();
        }
        else{
            $("#ifvac").hide();
            $("#immusatate").hide();
        }
    });


// alcohol and tobacco check
$('#individual_date_of_birth').change(function(){
         var today = new Date();
          var birthDate = new Date($('#individual_date_of_birth').val());
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age--;
          }
         $('#individual_age').val(age);
            if(age > 17)
                {
                    
                    $("#alcohol_div").show();
                    $("#tobacco_div").show();
                
                 }
            else{
                $("#alcohol_div").hide();
                    $("#tobacco_div").hide();
                

            }
              
        });

  $("#individual_age").change(function() {
    var age = $("#individual_age").val();
    
   if(age > 17)
    {
      
      $("#alcohol_div").show();
      $("#tobacco_div").show();
     
    }
    else{
      
      $("#alcohol_div").hide();
      $("#tobacco_div").hide();
  
    }
});



// chronicilness check
    $("#chronic1").click(function() {
    if($(this).is(":checked"))    
            $("#chronicso").show();
        else
            $("#chronicso").hide();
    });
  $("#chronic2").click(function() {
    if($(this).is(":checked")){
            $("#chronicval").val('') ;
            $("#chronicso").hide();
            }
        else
            $("#chronicso").hide();
    });
 
 // acuteillness check
 $("#acute1").click(function() {
    if($(this).is(":checked"))    
            $("#acuteso").show();

        else
            $("#acuteso").hide();
    });
  $("#acute2").click(function() {
    if($(this).is(":checked")){
            $("#acuteval").val('') ;
            $("#acuteso").hide();
            }
        else
            $("#acuteso").hide();
    });

  $("#teeth_related_questions1").click(function() {
    if($(this).is(":checked"))    
            $(".teeth_ques").show();
        else
            $(".teeth_ques").hide();
    });
  $("#teeth_related_questions2").click(function() {
    if($(this).is(":checked")){
            $(".teeth_ques").hide();
            }
        else
            $(".teeth_ques").hide();
    });

  $("#mouth1").click(function() {
    if($(this).is(":checked"))    
            $("#one_year_prob").show();
        else
            $("#one_year_prob").hide();
    });
  $("#mouth2").click(function() {
    if($(this).is(":checked"))    
            $("#one_year_prob").hide();
        else
            $("#one_year_prob").hide();
    });
  $("#mouth3").click(function() {
    if($(this).is(":checked"))    
            $("#one_year_prob").hide();
        else
            $("#one_year_prob").hide();
    });



  
  $("#teeth3").click(function() {
    if($(this).is(":checked")) {
            
             $("#ifbrush").show();
    }   
           
        else
            $("#ifbrush").hide();
    });


  });

  </script>
  <script>
function myFunction() {
    var age = $("#individual_age").val();
  
   if(age > 17)
    {
    
      $("#alcohol_div").show();
      $("#tobacco_div").show();
      $("#AT").hide();
    }
    else{
  
      $("#alcohol_div").hide();
      $("#tobacco_div").hide();
      $("#AT").hide();
    }
}
</script>