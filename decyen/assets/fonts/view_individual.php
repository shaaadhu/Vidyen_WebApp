<?php 
session_start();
include('header.php');
include('config.php');
$db=$conn;


if(!isset($_GET['id']))
{
	echo"not connecting";
}
else{

    //global $db;

	echo $id=$_GET['id'];

	$rowdata="SELECT * FROM individual WHERE id=$id";
	$rowcon=mysqli_query($db,$rowdata);

	while($rows=mysqli_fetch_assoc($rowcon))
	{
		?>


		<div class="content-wrapper ">
			<div class="col-12 grid-margin">
				<div class="card">
					<div class="card-title pt-3 ps-3 text-primary">
						<h3>View Member</h3>
					</div>
					<div class="card-body">
						<form class="form-sample">
							<p class="card-description">
								Individual information
							</p>
							<div class="text-end ">
								<a href="individual_followup.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Followup</a>
							</div>
							<div>
								<label class="form-label form-label"><b>Name</b> </label>
								<input type="text" class="form-control form-control-sm"  value="<?php echo $rows['individual_name'];?>" disabled>
								
							</div>
							
							<div class="mt-3">
								<label class="form-label"><b>Gender</b></label>
								<input type="text" class="form-control form-control-sm"  value="<?php echo $rows['individual_gender'];?>" disabled>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Mobile Number</b></label>
								<input type="number" class="form-control form-control-sm"  value="<?php echo $rows['individual_mobile'];?>" disabled>
								<div id="imobilecheck" class="err_check"></div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Adhaar Number</b></label>
								<input type="text" class="form-control form-control-sm" name="iadhaar" value="<?php echo $rows['individual_adhaar'];?>" disabled>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label class="form-label"><b>Date Of Birth</b></label>
									<input type="date" class="form-control form-control-sm" name="idob" id="idob" value="<?php echo $rows['individual_date_of_birth'];?>" disabled>
									<div id="idobcheck" class="err_check"required></div>
									<br>
								</div>
								<div class="col-md-6">
									<label class="form-label"><b>Age</b></label>
									<input type="number" class="form-control form-control-sm" name="iage" id="iage" value="<?php echo $rows['individual_age'];?>" disabled >
								</div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Blood Group</b><span id="mandatory">&nbsp;*</span> </label>
								<input type="text" class="form-control form-control-sm" name="iadhaar" value="<?php echo $rows['individual_bloodgroup'];?>" disabled>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Education</b></label>
								<input type="text" class="form-control form-control-sm" name="iadhaar" value="<?php echo $rows['individual_education'];?>" disabled>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Occupation</b></label>
								<input type="text" class="form-control form-control-sm" name="iadhaar" value="<?php echo $rows['individual_occupation'];?>" disabled>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Relation with Head Of Family</b></label>
								<input type="text" class="form-control form-control-sm" name="iadhaar" value="<?php echo $rows['individual_relation_with_head'];?>" disabled>
							</div>
							
							<div class="row mt-3">
								<?php if ($rows['individual_student'] == 'no') { ?>
									<div class="col-md-4">
										<label class="form-label"><b>Are You Student?</b></label>
										<input type="text" id="stud" class="form-control" value="<?php echo $rows['individual_student'] ?>" disabled>
									</div>
								<?php } else if ($rows['individual_student'] == 'yes') {
									$sql1 = "SELECT * FROM `study_history` WHERE `individual_id` = '$id'";
									$rowcon1 = mysqli_query($db, $sql1);
									while ($rows1 = mysqli_fetch_assoc($rowcon1)) {
										?>
										<div class="col-md-4">
											<label class="form-label"><b>Are You Student?</b></label>
											<input type="text" id="stud" class="form-control" value="<?php echo $rows['individual_student'] ?>" disabled>
										</div>
										<div class="col-md-4 colname">
											<label class="form-label"><b>Name Of The School/College</b></label>
											<input type="text" class="form-control " value="<?php echo $rows1['insitution_name'] ?>" disabled>
											<br>
										</div>
										<div class="col-md-4 colname">
											<label class="form-label"><b>Which Standard?</b></label>
											<input type="text" class="form-control" value="<?php echo $rows1['standard_semester'] ?>" disabled>
										</div>
									<?php }
								} ?>
							</div>

							<div class="row mt-4 align-items-center">
								<div class="col-md-4">
									<label class="form-label"><b>Underfive child?</b></label>
									<input type="text" id="child" class="form-control" value="<?php echo $rows['underfive_yes_no'] ?>" disabled>
								</div>
							</div>
							<?php if ($rows['underfive_yes_no'] == 'yes') { ?>
								<div class="table-responsive mt-3" id="vacc_table">
									<table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
										<thead class="text-center bg-primary text-white">
											<tr>
												<th>Sl.No</th>
												<th>Vaccination Name</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											//echo $id;
											 $rowdata_query="SELECT * FROM `vaccination_history` WHERE individual_id='$id'";
											 $row_vaccine=mysqli_query($db,$rowdata_query);
											 if($row_vaccine){

											 	 $i=1;
											 	while($rows_vaccine=mysqli_fetch_array($row_vaccine)){
											 		?>
											 		<tr>
													<td><?php echo $i; ?></td>
													<?php 
													$query_name="SELECT * FROM vaccination WHERE id=$i";
													$sql_vaccine_name=mysqli_query($db,$query_name);
													while($row_vaccine_name=mysqli_fetch_assoc($sql_vaccine_name)){
													?>
													<td><?php echo $row_vaccine_name['vaccination_name']; ?></td>
												<?php
													}
												?>
													<td><?php echo $rows_vaccine['vaccination_value']; ?></td>
												</tr>
												<?php 
												$i++;

											 	}

											 }
											
											?>
										</tbody>
									</table>
								</div>

								<div class="mt-3">
									<label class="form-label"><b>Immunization Status</b></label>
									<input type="text" class="form-control" value="<?php echo $rows['immunization'] ?>" disabled>
								</div>
							<?php
							 }
							  ?>

							  <?php
									if ($rows['individual_age'] > 18) { ?>
							<div class="mt-3">
								<label class="form-label"><b>Alcohol Use</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_alcohol_usage'] ?>" disabled>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Tobacco Use</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_tobacco_usage'] ?>" disabled>
							</div>
						<?php }?>
							<div class=" mt-3">
								<label class="form-label"><b>Diet</b></label>
								<input type="text" class="form-control" value="<?php echo $rows['individual_diet'] ?>" disabled>
							</div>

							<div class="mt-3">
								<label class="form-label"><b>Health Status </b></label>
								<div class="row">
									<?php
									if ($rows['individual_chronic_illness'] == '') { ?>
										<div class="col-md-4">
											<label class="form-label">1.&nbsp;Chronic Illness</label>
											<input type="text" class="form-control" value="no" disabled>
										</div>
									<?php } else { ?>
										<div class="col-md-4">
											<label class="form-label">1.&nbsp;Chronic Illness</label>
											<input type="text" class="form-control" value="<?php echo $rows['individual_chronic_illness'] ?>" disabled>
										</div>
									<?php } ?>
									<?php
									if ($rows['individual_acute_illness'] == '') { ?>
										<div class="col-md-4">
											<label class="form-label">2.&nbsp;Acute Illness (two weeks)</label>
											<input type="text" class="form-control" value="" disabled>
										</div>
									<?php } else { ?>
										<div class="col-md-4">
											<label class="form-label">2.&nbsp;Acute Illness (two weeks)</label>
											<input type="text" class="form-control" value="<?php echo $rows['individual_acute_illness'] ?>" disabled>
										</div>
									<?php } ?>
									<div class="col-md-4">
										<label class="form-label">3.&nbsp;Flu like illness</label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_flu_illness'] ?>" disabled>
									</div>
								</div>

								<div class="row  mt-3">
									<div class="col-md-4">
										<label class="form-label">4.&nbsp;Maleria</label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_maleria'] ?>" disabled>
									</div>
									<div class="col-md-4">
										<label class="form-label">5.&nbsp;Dengue</label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_dengue'] ?>" disabled>
									</div>
									<div class="col-md-4">
										<label class="form-label">6.&nbsp;Tuberculosis</label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_tuberculosis'] ?>" disabled>
									</div>
								</div>

								<div class="row mt-3">
									<div class="col-md-4">
										<label class="form-label">7.&nbsp;Known case of HT</label>
										<input type="text" class="form-control" value="<?php echo $rows['known_hypertension'] ?>" disabled>
									</div>
									<div class="col-md-4">
										<label class="form-label">6.&nbsp;Known Case of DM</label>
										<input type="text" class="form-control" value="<?php echo $rows['known_dm'] ?>" disabled>
									</div>
								</div>

								<?php if ($rows['teeth_related_questions'] == 'applicable'){ ?>
									<div class="row mt-3">
										<div class="col-md-6">
											<label class="form-label"><b>How do you generally clean your teeth?</b></label>
											<input type="text" id="teeth_clean" class="form-control" value="<?php echo $rows['individual_clean_teeth'] ?>" disabled>
										</div>
										<?php if ($rows['individual_clean_teeth'] == 'others'){ ?>
											<div class="col-md-6" id="ifbrush">
												<label class="form-label"><b>If Others Specify</b></label>
												<input type="text" class="form-control" value="<?php echo $rows['individual_teeth_other'] ?>" disabled>
											</div>
										<?php } ?>	
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<label class="form-label"><b>How often do you clean your teeth in a day?</b></label>
											<input type="text" class="form-control" value="<?php echo $rows['individual_clean_day'] ?>" disabled>
											<br>
										</div>
										<div class="col-md-6">
											<label class="form-label"><b>What material generally you use to clean your teeth?</b></label>
											<input type="text" class="form-control" value="<?php echo $rows['individual_material_for_clean'] ?>" disabled>
										</div>
									</div>
									<div class="mt-3">
										<label class="form-label"><b>Check toothpaste/tooth powder used and record whether it is fluoridated or not?</b></label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_paste_kind'] ?>" disabled>
									</div>
									<div class=" mt-3">
										<label class="form-label"><b>How often do you change your toothbrush?</b></label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_change_brush'] ?>" disabled>
									</div>
									<div class="mt-3">
										<label class="form-label"><b>Do you use any of these oral hygine aids? (Tick as many as reported)</b></label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_oral_hygine_aids'] ?>" disabled>
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<label class="form-label"><b>Have you suffered from any mouth or teeth problems in the last one year?</b></label>
											<input type="text" class="form-control" value="<?php echo $rows['individual_mouth_problem'] ?>" disabled>
										</div>
										<?php if ($rows['individual_mouth_problem'] == 'yes'){ ?>
											<div class="col-md-6">
												<label class="form-label"><b>What were or was the problems?</b></label>
												<input type="text" class="form-control" value="<?php echo $rows['individual_mouth_check'] ?>" disabled>
											</div>
										<?php } ?>
									</div>
									<div class=" mt-3">
										<label class="form-label"><b>How accessible are the dental facilities for treatment with avialable transport?</b></label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_transport_dental'] ?>" disabled>
									</div>
									<div class="mt-3">
										<label class="form-label"><b>What in your opinion are the major factors which causes dental problems?</b></label>
										<input type="text" class="form-control" value="<?php echo $rows['individual_major_factor'] ?>" disabled>
									</div>

								<?php } ?>

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
							
						</form>
					</div>
				</div>
			</div>
			<div class="col-12 grid-margin">

				<div class="card">
					<div class="card-title pt-3 ps-3 text-primary">
						<h3>Member Follow View</h3>

					</div>

					<div class="card-body">

						<div class="table-responsive mt-3">
							<table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
								<thead class="text-center bg-primary text-white">
									<tr>
										<th>Sl.No</th>
										<th>Individual Id</th>
										<th>Indiviual Name</th>
										<th>Mobile Number</th>
										<th>Health Needs</th>
										<th>Action Required</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php 
									$sql_individual_follow_view = "SELECT b.id as individual_followup_id, a.id as individual_id, a.individual_name as individual_name, a.individual_mobile as individual_mobile, b.individual_health_needs as individual_health_needs, b.individual_action_required as individual_action_required FROM individual a, individual_followup b  WHERE a.id = '$id' AND b.individual_id = '$id' AND a.id = b.individual_id";
									$result_individual_follow_view = mysqli_query($conn, $sql_individual_follow_view);
									$i=1;
									while($rows_individual_follow_view = mysqli_fetch_assoc($result_individual_follow_view)){
										$id_follow=$rows_individual_follow_view['individual_followup_id'];
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $rows_individual_follow_view['individual_id'];?></td>
											<td><?php echo $rows_individual_follow_view['individual_name'];?></td>
											<td><a href="tel:<?php echo $rows_individual_follow_view['individual_mobile'];?>"><?php echo $rows_individual_follow_view['individual_mobile'];?></a></td>
											<td><?php echo $rows_individual_follow_view['individual_health_needs'];?></td>
											<td><?php echo $rows_individual_follow_view['individual_action_required'];?></td>
											<td><a class="btn btn-outline-primary" href="view_individual_followup.php?id=<?php echo $id_follow; ?>"><i class="fa fa-eye"></i></a>
												<a  class="btn btn-outline-primary" href="update_individual_followup.php?id=<?php echo $id_follow; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" ><i class="fa-solid fa-pen-to-square"></i></a>
											 <a href="#" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="PDF Download"><i class="fa-solid fa-file-pdf"></i></a></td>
										</tr>
										
										<?php $i++; } ?>  
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
           // echo "success";


		}
	}


	?>
	<?php include('footer.php');?>

