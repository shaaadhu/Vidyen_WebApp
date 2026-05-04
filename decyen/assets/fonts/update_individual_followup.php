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
$db=$conn;

$query = "SELECT a.id as individual_id, a.individual_education as individual_education, a.individual_occupation as individual_occupation,a.individual_age as individual_age, b.individual_id as followup_individual_id, a.individual_student as individual_student, a.underfive_yes_no as underfive_yes_no, a.immunization as immunization, b.individual_height as individual_height, b.individual_weight as individual_weight, b.individual_bmi as individual_bmi, a.individual_alcohol_usage as individual_alcohol_usage, a.individual_tobacco_usage as individual_tobacco_usage, b.family_id as family_id, b.individual_systolic_value as individual_systolic_value, b.individual_diastolic_value as individual_diastolic_value, a.known_hypertension as known_hypertension, b.individual_sugar as individual_sugar, a.known_dm as known_dm, b.individual_urine_sugar_value as individual_urine_sugar_value, b.individual_urine_protien as individual_urine_protien, b.individual_oral_cavity as individual_oral_cavity, b.individual_oral_ulcer as individual_oral_ulcer, b.individual_oral_hygine as individual_oral_hygine, b.individual_heamoglobin as individual_heamoglobin, a.individual_diet as individual_diet, a.individual_chronic_illness as individual_chronic_illness, a.individual_acute_illness as individual_acute_illness, a.individual_flu_illness as individual_flu_illness, a.individual_maleria as individual_maleria, a.individual_dengue as individual_dengue, a.individual_tuberculosis as individual_tuberculosis, a.individual_clean_teeth as individual_clean_teeth, a.individual_teeth_other as individual_teeth_other, a.individual_clean_day as individual_clean_day, a.individual_material_for_clean as individual_material_for_clean, a.individual_paste_kind as individual_paste_kind, a.individual_change_brush as individual_change_brush, a.individual_oral_hygine_aids as individual_oral_hygine_aids, a.individual_mouth_problem as individual_mouth_problem, a.individual_mouth_check as individual_mouth_check, a.individual_transport_dental as individual_transport_dental, a.individual_major_factor as individual_major_factor, a.individual_health_needs as individual_health_needs, a.individual_action_required as individual_action_required, b.individual_health_needs as individual_followup_health_needs, b.individual_action_required as individual_followup_action_required FROM `individual` a, `individual_followup` b WHERE b.id='$id' AND a.id = b.individual_id";
   $rowcon = mysqli_query($db, $query);
  
  while($rows = mysqli_fetch_assoc($rowcon)) {

?>

      <div class="content-wrapper ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-title pt-3 ps-3 text-primary">
            <h3>Enroll Individual Followup</h3>
          </div>
          <div class="card-body">
            <form class="form-sample" id="update_individual_followup">
              <p class="card-description">
                Individual information
              </p>
              <input type="hidden" id="individual_id" name="individual_id" value="<?php echo $id;?>">
              <input type="hidden" name="family_id" value="<?php echo $family_id;?>">
              <?php $age=$rows['individual_age'];?>
             
              <div class="row mt-3">
                <div class="col-md-6">
                  <label class="form-label"><b>Height</b><span id="mandatory">&nbsp;*</span> </label>
                  <input type="number" class="form-control form-control-sm" placeholder="Enter Height(mts)" name="individual_height" id="individual_height" value="<?php echo $rows['individual_height'] ?>" required>
                  <br>
                  <div id="iheightcheck"></div>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><b>Weight</b><span id="mandatory">&nbsp;*</span> </label>
                  <input type="number" class="form-control form-control-sm" placeholder="Enter Weight(kg)" name="individual_weight" id="individual_weight" value="<?php echo $rows['individual_weight'] ?>" required>
                  <div id="iweightcheck"></div>
                </div>
              </div>
              <?php if ($age >17) { ?>
              <div id="bmidiv">
                  <label class="form-label"><b>BMI</b><span id="mandatory">&nbsp;*</span> </label>
                  <input type="text" class="form-control form-control-sm" placeholder="BMI" name="individual_bmi" id="individual_bmi" value="<?php echo $rows['individual_bmi'] ?>" readonly>
              </div>
              <?php }?>
            

              <div class="row mt-3">
                <label class="form-label"><b>Blood Pressure</b><span id="mandatory">&nbsp;*</span> </label>
                <div class="col-md-6">
                  <label class="form-label"><b>Systolic Value</b><span id="mandatory">&nbsp;*</span> </label>
                  <input type="text" class="form-control form-control-sm" placeholder="Enter Systolic Value" name="individual_systolic_value" id="individual_systolic_value" value="<?php echo $rows['individual_systolic_value'] ?>" required>
                  <br>
                  <div id="isysvcheck"></div>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><b>Diastolic Value</b><span id="mandatory">&nbsp;*</span> </label>
                  <input type="text" class="form-control form-control-sm" placeholder="Enter Diastolic Value" name="individual_diastolic_value" id="individual_diastolic_value" value="<?php echo $rows['individual_diastolic_value'] ?>" required>
                  <div id="idiacheck"></div>
                </div>
              </div>
  
              
              <div class="mt-3">
                <label class="form-label"><b>Blood Sugar (RBS)</b></label>
                <input type="text" class="form-control form-control-sm" placeholder="Enter Random Blood Sugar" name="individual_sugar" id="individual_sugar" value="<?php echo $rows['individual_sugar'] ?>" >
                <div id="isugarcheck"></div>
              </div>
              
              <div class="row mt-3">
                <div class="col-md-6">
                  <label class="form-label"><b>Urine Sugar</b></label>
                  <select class="form-control form-control-sm" name="individual_urine_sugar_value" id="individual_urine_sugar_value">
                                    <option value="">Choose</option>
                                    <option value="Present"<?php if($rows['individual_urine_sugar_value'] == 'Present') echo 'selected';?>>Present</option>
                                    <option value="Absent"<?php if($rows['individual_urine_sugar_value'] == 'Absent') echo 'selected';?>>Absent</option>
                              </select> 
                              <br>
                              <div id="iusugarcheck"></div>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><b>Urine Proteins</b></label>
                  <select class="form-control form-control-sm" name="individual_urine_protien" id="individual_urine_protien">
                                    <option value="">Choose</option>
                                    <option value="Present"<?php if($rows['individual_urine_protien'] == 'Present') echo 'selected';?>>Present</option>
                                    <option value="Absent"<?php if($rows['individual_urine_protien'] == 'Absent') echo 'selected';?>>Absent</option>
                              </select> 
                              <div id="iuprocheck"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-4">
                  <label class="form-label"><b>Oral cavity (Dental caries)</b><span id="mandatory">&nbsp;*</span> </label>
                  <select class="form-control form-control-sm" name="individual_oral_cavity" id="individual_oral_cavity"required>
                                    <option value="">Choose</option>
                                    <option value="Yes"<?php if($rows['individual_oral_cavity'] == 'Yes') echo 'selected';?>>Yes</option>
                                    <option value="No"<?php if($rows['individual_oral_cavity'] == 'No') echo 'selected';?>>No</option>
                              </select> 
                              <br>
                              <div id="iocavcheck"></div>
                </div>
                <div class="col-md-4">
                  <label class="form-label"><b>Oral Ulcer/lesions</b><span id="mandatory">&nbsp;*</span> </label>
                  <select class="form-control form-control-sm" name="individual_oral_ulcer" id="individual_oral_ulcer"required>
                                    <option value="">Choose</option>
                                    <option value="Yes"<?php if($rows['individual_oral_ulcer'] == 'Yes') echo 'selected';?>>Yes</option>
                                    <option value="No"<?php if($rows['individual_oral_ulcer'] == 'No') echo 'selected';?>>No</option>
                              </select> 
                              <br>
                              <div id="ioulccheck"></div>
                </div>
                <div class="col-md-4">
                  <label class="form-label"><b>Oral Hygine</b><span id="mandatory">&nbsp;*</span> </label>
                  <select class="form-control form-control-sm" name="individual_oral_hygine" id="individual_oral_hygine"required>
                                    <option value="">Choose</option>
                                    <option value="Poor"<?php if($rows['individual_oral_hygine'] == 'Poor') echo 'selected';?>>Poor</option>
                                    <option value="Good"<?php if($rows['individual_oral_hygine'] == 'Good') echo 'selected';?>>Good</option>
                              </select> 
                              <div id="iohygcheck"></div>
                </div>
              </div>
              <div class="mt-3">
                <label class="form-label"><b>Heamoglobin</b></label>
                <input type="text" class="form-control form-control-sm" placeholder="Enter Heamoglobin" name="individual_heamoglobin" id="individual_heamoglobin" value="<?php echo $rows['individual_heamoglobin'] ?>">
                <div id="iheamocheck"></div>
              </div>
              
              

              <div class="mt-3">
                <label class="form-label"><b>Health Needs</b><span id="mandatory">&nbsp;*</span></label>
                <textarea  class="form-control form-control-sm" name="individual_health_needs" id="individual_health_needs"  required><?php echo $rows['individual_health_needs'] ?></textarea>
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
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                 </div>
            </form>
          </div>
        </div>
      </div>
    </div>




<?php
}
} 
include('footer.php');
?>
<script type="text/javascript" src="ajax/individual.js"></script>
<script type="text/javascript">
  // BMI Calculator
  $("#individual_height,#individual_weight").keyup(function(){
        var heig=$('#individual_height').val();
        var weig=$('#individual_weight').val();
        if(heig!="" && weig!=""){
          var bmi = weig/(Math.pow(heig , 2));
        // var bmi = weig/(heig * heig);
         $('#individual_bmi').val(bmi);
        }
              
        });
</script>