<?php
session_start();
 include('header.php');
include('config.php');
$db = $conn;
?>
<?php
if (!isset($_GET['id'])) {
	echo "not connecting";
} else {
	  $id = $_GET['id'];
	

	 $query = "SELECT a.id as individual_id, a.individual_education as individual_education, a.individual_occupation as individual_occupation,a.individual_age as individual_age, b.individual_id as followup_individual_id, a.individual_student as individual_student, a.underfive_yes_no as underfive_yes_no, a.immunization as immunization, b.individual_height as individual_height, b.individual_weight as individual_weight, b.individual_bmi as individual_bmi, a.individual_alcohol_usage as individual_alcohol_usage, a.individual_tobacco_usage as individual_tobacco_usage, b.family_id as family_id, b.individual_systolic_value as individual_systolic_value, b.individual_diastolic_value as individual_diastolic_value, a.known_hypertension as known_hypertension, b.individual_sugar as individual_sugar, a.known_dm as known_dm, b.individual_urine_sugar_value as individual_urine_sugar_value, b.individual_urine_protien as individual_urine_protien, b.individual_oral_cavity as individual_oral_cavity, b.individual_oral_ulcer as individual_oral_ulcer, b.individual_oral_hygine as individual_oral_hygine, b.individual_heamoglobin as individual_heamoglobin, a.individual_diet as individual_diet, a.individual_chronic_illness as individual_chronic_illness, a.individual_acute_illness as individual_acute_illness, a.individual_flu_illness as individual_flu_illness, a.individual_maleria as individual_maleria, a.individual_dengue as individual_dengue, a.individual_tuberculosis as individual_tuberculosis, a.individual_clean_teeth as individual_clean_teeth, a.individual_teeth_other as individual_teeth_other, a.individual_clean_day as individual_clean_day, a.individual_material_for_clean as individual_material_for_clean, a.individual_paste_kind as individual_paste_kind, a.individual_change_brush as individual_change_brush, a.individual_oral_hygine_aids as individual_oral_hygine_aids, a.individual_mouth_problem as individual_mouth_problem, a.individual_mouth_check as individual_mouth_check, a.individual_transport_dental as individual_transport_dental, a.individual_major_factor as individual_major_factor, a.individual_health_needs as individual_health_needs, a.individual_action_required as individual_action_required, b.individual_health_needs as individual_followup_health_needs, b.individual_action_required as individual_followup_action_required FROM `individual` a, `individual_followup` b WHERE b.id='$id' AND a.id = b.individual_id";
	 $rowcon = mysqli_query($db, $query);
	
	while($rows = mysqli_fetch_assoc($rowcon)) {
		 $follow_up = $rows['followup_individual_id'];
?>
		<div class="content-wrapper ">
			<div class="col-12 grid-margin">
				<div class="card">
					<div class="card-title pt-3 ps-3 text-primary">
						<h3>Individual Followup View</h3>
					</div>
					<div class="card-body">
						<p class="card-description">
							Individual information
						</p>

						
						<div class="row mt-3">
							<div class="col-md-6">
								<label class="form-label"><b>Height</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_height'] ?>" disabled>
								<br>
							</div>
							<div class="col-md-6">
								<label class="form-label"><b>Weight</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_weight'] ?>" disabled>
							</div>
						</div>
						<?php if ($rows['individual_age'] > 17 ) { ?>
						<div  >
							<label class="form-label"><b>BMI</b></label>
							<input type="text" class="form-control" value="<?php echo $rows['individual_bmi'] ?>" disabled>
						</div>
						<?php } ?>

						<div class="row mt-3">
							<label class="form-label"><b>Blood Pressure</b></label>
							<div class="col-md-6">
								<label class="form-label"><b>Systolic Value</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_systolic_value'] ?>" disabled>
								<br>
							</div>
							<div class="col-md-6">
								<label class="form-label"><b>Diastolic Value</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_diastolic_value'] ?>" disabled>
							</div>
						</div>

				
						<div class="mt-3">
							<label class="form-label"><b>Blood Sugar (RBS)</b></label>
							<input type="text" class="form-control" value="<?php echo $rows['individual_sugar'] ?>" disabled>
						</div>
					
						<div class="row mt-3">
							<div class="col-md-6">
								<label class="form-label"><b>Urine Sugar</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_urine_sugar_value'] ?>" disabled>
								<br>
							</div>
							<div class="col-md-6">
								<label class="form-label"><b>Urine Proteins</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_urine_protien'] ?>" disabled>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-4">
								<label class="form-label"><b>Oral cavity (Dental caries)</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_oral_cavity'] ?>" disabled>
								<br>
							</div>
							<div class="col-md-4">
								<label class="form-label"><b>Oral Ulcer/lesions</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_oral_ulcer'] ?>" disabled>
								<br>
							</div>
							<div class="col-md-4">
								<label class="form-label"><b>Oral Hygine</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_oral_hygine'] ?>" disabled>
							</div>
						</div>
						<div class="mt-3">
							<label class="form-label"><b>Heamoglobin</b></label>
							<input type="text" class="form-control" value="<?php echo $rows['individual_heamoglobin'] ?>" disabled>
						</div>

					
						<div class="mt-3">
							<label class="form-label"><b>Health Needs</b></label>
							<textarea class="form-control " disabled><?php echo $rows['individual_health_needs'] ?></textarea>
						</div>
						<div class=" mt-3">
							<label class="form-label"><b>Action Required</b></label>
							<input type="text" class="form-control" value="<?php echo $rows['individual_action_required'] ?>" disabled>
						</div>
						<div class="mt-3 text-end">
                         
                      <a href="#" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="PDF Download"><i class="fa-solid fa-file-pdf"></i></a>
                    </div>
					</div>
				</div>
			</div>
		</div>

<?php 
}
} ?>



<?php include('footer.php'); ?>
<script type="text/javascript">
	if ($("#stud").val() == 'yes') {
		$(".colname").show();
	} else {
		$(".colname").hide();
	}

	if ($("#child").val() == 'yes') {
		$("#vacc_table").show();
	} else {
		$("#vacc_table").hide();
	}

	if ($("#teeth_clean").val() == 'others') {
		$("#ifbrush").show();
	} else {
		$("#ifbrush").hide();
	}
</script>