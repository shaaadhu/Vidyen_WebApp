<?php include('header.php');
include 'config.php';
$db=$conn;
if(isset($_GET['id'])){
   $id=$_GET['id'];
  $query="SELECT * FROM individual WHERE id='$id'";
  $sqlcon=mysqli_query($db,$query);
  while($rows=mysqli_fetch_assoc($sqlcon)){
  	 $family_id=$rows['family_id'];
  	  $age=$rows['individual_age'];


?>

<style type="text/css">
	.err_check{
		color: red;
	}
	
</style>

		<div class="content-wrapper ">
			<div class="col-12 grid-margin">
				<div class="card">
					<div class="card-title pt-3 ps-3 text-primary">
						<h3>Enroll Individual Followup</h3>
					</div>
					<div class="card-body">
						<form class="form-sample" id="individual_followup">
							<p class="card-description">
								Individual information
							</p>
							<input type="hidden" id="individual_id" name="individual_id" value="<?php echo $id;?>">
							<input type="hidden" name="family_id" value="<?php echo $family_id;?>">
							<input type="hidden"  id="bmi_age" value="<?php echo $age;?>">

							<div class="row mt-3">
								<div class="col-md-6">
									<label class="form-label"><b>Height</b><span id="mandatory">&nbsp;*</span> </label>
									<input type="number" class="form-control form-control-sm" placeholder="Enter Height(mts)" name="individual_height" id="individual_height"required>
									<br>
									<div id="iheightcheck"></div>
								</div>
								<div class="col-md-6">
									<label class="form-label"><b>Weight</b><span id="mandatory">&nbsp;*</span> </label>
									<input type="number" class="form-control form-control-sm" placeholder="Enter Weight(kg)" name="individual_weight" id="individual_weight"required>
									<div id="iweightcheck"></div>
								</div>
							</div>
							<div id="bmidiv" style="display:none;">
									<label class="form-label"><b>BMI</b><span id="mandatory">&nbsp;*</span> </label>
									<input type="text" class="form-control form-control-sm" placeholder="BMI" name="individual_bmi" id="individual_bmi"readonly>
							</div>
						

							<div class="row mt-3">
								<label class="form-label"><b>Blood Pressure</b><span id="mandatory">&nbsp;*</span> </label>
								<div class="col-md-6">
									<label class="form-label"><b>Systolic Value</b><span id="mandatory">&nbsp;*</span> </label>
									<input type="text" class="form-control form-control-sm" placeholder="Enter Systolic Value" name="individual_systolic_value" id="individual_systolic_value"required>
									<br>
									<div id="isysvcheck"></div>
								</div>
								<div class="col-md-6">
									<label class="form-label"><b>Diastolic Value</b><span id="mandatory">&nbsp;*</span> </label>
									<input type="text" class="form-control form-control-sm" placeholder="Enter Diastolic Value" name="individual_diastolic_value" id="individual_diastolic_value"required>
									<div id="idiacheck"></div>
								</div>
							</div>
	
							
							<div class="mt-3">
								<label class="form-label"><b>Blood Sugar (RBS)</b></label>
								<input type="text" class="form-control form-control-sm" placeholder="Enter Random Blood Sugar" name="individual_sugar" id="individual_sugar">
								<div id="isugarcheck"></div>
							</div>
							
							<div class="row mt-3">
								<div class="col-md-6">
									<label class="form-label"><b>Urine Sugar</b></label>
									<select class="form-control form-control-sm" name="individual_urine_sugar_value" id="individual_urine_sugar_value">
	                              		<option value="">Choose</option>
	                              		<option value="Present">Present</option>
	                              		<option value="Absent">Absent</option>
                        			</select> 
                        			<br>
                        			<div id="iusugarcheck"></div>
								</div>
								<div class="col-md-6">
									<label class="form-label"><b>Urine Proteins</b></label>
									<select class="form-control form-control-sm" name="individual_urine_protien" id="individual_urine_protien">
	                              		<option value="">Choose</option>
	                              		<option value="Present">Present</option>
	                              		<option value="Absent">Absent</option>
                        			</select> 
                        			<div id="iuprocheck"></div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-4">
									<label class="form-label"><b>Oral cavity (Dental caries)</b><span id="mandatory">&nbsp;*</span> </label>
									<select class="form-control form-control-sm" name="individual_oral_cavity" id="individual_oral_cavity"required>
	                              		<option value="">Choose</option>
	                              		<option value="Yes">Yes</option>
	                              		<option value="No">No</option>
                        			</select> 
                        			<br>
                        			<div id="iocavcheck"></div>
								</div>
								<div class="col-md-4">
									<label class="form-label"><b>Oral Ulcer/lesions</b><span id="mandatory">&nbsp;*</span> </label>
									<select class="form-control form-control-sm" name="individual_oral_ulcer" id="individual_oral_ulcer"required>
	                              		<option value="">Choose</option>
	                              		<option value="Yes">Yes</option>
	                              		<option value="No">No</option>
                        			</select> 
                        			<br>
                        			<div id="ioulccheck"></div>
								</div>
								<div class="col-md-4">
									<label class="form-label"><b>Oral Hygine</b><span id="mandatory">&nbsp;*</span> </label>
									<select class="form-control form-control-sm" name="individual_oral_hygine" id="individual_oral_hygine"required>
	                              		<option value="">Choose</option>
	                              		<option value="Poor">Poor</option>
	                              		<option value="Good">Good</option>
                        			</select> 
                        			<div id="iohygcheck"></div>
								</div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Heamoglobin</b></label>
								<input type="text" class="form-control form-control-sm" placeholder="Enter Heamoglobin" name="individual_heamoglobin" id="individual_heamoglobin">
								<div id="iheamocheck"></div>
							</div>
							
							

							<div class="mt-3">
								<label class="form-label"><b>Health Needs</b><span id="mandatory">&nbsp;*</span></label>
								<textarea  class="form-control form-control-sm" name="individual_health_needs" id="individual_health_needs" required></textarea>
							</div>
							<div class=" mt-3">
									<label class="form-label"><b>Action Required</b><span id="mandatory">&nbsp;*</span></label>
									<select class="form-control form-control-sm" name="individual_action_required" id="individual_action_required"required>
	                              		<option value="">Choose</option>
	                              		<option value="Referral to tertiary care">Referral to tertiary care</option>
	                              		<option value="Referral to YMCH">Referral to YMCH</option>
	                              		<option value="Referral to YDCH">Referral to YDCH</option>
	                              		<option value="Referral to CHC/PHC">Referral to CHC/PHC</option>
	                              		<option value="Follow up by MSW/ASHA">Follow up by MSW/ASHA</option>
	                              		<option value="Follow up by student">Follow up by student</option>
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
if($("#bmi_age").val() > 17){
             $("#bmidiv").show();
          }
             
        else{
          $("#bmidiv").hide();
        }



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