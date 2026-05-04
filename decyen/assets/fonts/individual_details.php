<?php
session_start();
 include('header.php');
include('config.php');

$id=$_GET['id'];
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
						<h3>Enroll Individual</h3>
					</div>
					<div class="card-body">
						<form class="form-sample" id="individual_details" method="POST">
							<p class="card-description">
								Individual information
							</p>
							<input type="hidden" name="family_id" value="<?php echo $id;?>">
							<div>
								<label class="form-label form-label"><b>Name</b><span id="mandatory">&nbsp;*</span> </label>
								<input type="text" class="form-control form-control-sm" id="individual_name" placeholder="Enter Name" name="individual_name" autocomplete="off" required>
								<div id="inamecheck" class="err_check"></div>
							</div>
							<!-- <div class="mt-3">
								
							</div> -->
							<div class="mt-3">
								<label class="form-label"><b>Gender</b><span id="mandatory">&nbsp;*</span> </label>
                        		<select class="form-control form-control-sm" name="individual_gender" id="individual_gender"required>
                              		<option value="">Choose Gender</option>
                              		<option value="Male">Male</option>
                              		<option value="Female">Female</option>
                              		<option value="Others">Others</option>
                        		</select> 
                        		<div id="igendercheck" class="err_check"></div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Mobile Number</b><span id="mandatory">&nbsp;*</span>  </label>
								<input type="number" class="form-control form-control-sm" placeholder="Enter Mobile Number" name="individual_mobile" id="individual_mobile"required>
								<div id="imobilecheck" class="err_check"></div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Adhaar Number</b>&nbsp;<span>(Optional)</span> </label>
								<input type="text" class="form-control form-control-sm" name="individual_adhaar" id="individual_adhaar" placeholder="Enter Adhaar Number">
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<label class="form-label"><b>Date Of Birth</b></label>
									<input type="date"  class="form-control form-control-sm" name="individual_date_of_birth" id="individual_date_of_birth">
									<div id="idobcheck" class="err_check"></div>
									<br>
								</div>
								<div class="col-md-3">
									<label class="form-label"><b>Age</b> </label>
									<input type="text" class="form-control form-control-sm" name="individual_age" id="individual_age" placeholder="Age" value="">
									<!-- <div id="iagecheck" class="err_check"></div> -->
								</div>
								<div class="col-md-3">
									<label class="form-label"><b>Age with days</b> </label>
									<input type="text" class="form-control form-control-sm" name="individual_age1" id="individual_age1" placeholder="Age" value="" readonly>
									<!-- <div id="iagecheck" class="err_check"></div> -->
								</div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Blood Group</b><span id="mandatory">&nbsp;*</span> </label>
								<select class="form-control form-control-sm" name="individual_bloodgroup" id="individual_bloodgroup"required>
	                              	<option value="">Choose</option>
	                              	<option value="A+">A+</option>
	                              	<option value="A-">A-</option>
	                              	<option value="AB+">AB+</option>
	                              	<option value="AB-">AB-</option>
	                              	<option value="B+">B+</option>
	                              	<option value="B-">B-</option>
	                              	<option value="O+">O+</option>
	                              	<option value="O-">O-</option>
                        		</select> 
                        		<div id="ibgcheck"></div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Education</b><span id="mandatory">&nbsp;*</span> </label>
                        		<select class="form-control form-control-sm" name="individual_education" id="individual_education"required>
                              		<option value="">Choose Education</option>
                              		<option value="Illiterate">Illiterate</option>
                              		<option value="Primary">Primary</option>
                              		<option value="Secondary">Secondary</option>
                              		<option value="Higher Secondary">Higher Secondary</option>
                              		<option value="PUC">PUC</option>
                              		<option value="Diploma">Diploma</option>
                              		<option value="Degree">Degree</option>
                              		<option value="Postgraduate">Postgraduate</option>
                        		</select> 
                        		<div id="ieducheck"></div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Occupation</b><span id="mandatory">&nbsp;*</span> </label>
                        		<select class="form-control form-control-sm" name="individual_occupation" id="individual_occupation"required>
                              		<option value="">Choose Occupation</option>
                              		<option value="Housewife">Housewife</option>
                              		<option value="Farmer">Farmer</option>
                              		<option value="Unskilled">Unskilled</option>
                              		<option value="Skilled">Skilled</option>
                              		<option value="Petty Business">Petty Business</option>
                              		<option value="Contactor">Contactor</option>
                              		<option value="Political Leader">Political Leader</option>
                              		<option value="Teacher">Teacher</option>
                              		<option value="Doctor">Doctor</option>
                              		<option value="Health worker">Health worker</option>
                              		<option value="Lawyer">Lawyer</option>
                              		<option value="Engineer">Engineer</option>
                              		<option value="Driver">Driver</option>
                              		<option value="Retired">Retired</option>
                              		<option value="Priest">Priest</option>
                              		<option value="Student">Student</option>
                              		<option value="Others">Others</option>
                        		</select> 
                        		<div id="iocccheck"></div>
							</div>
							<div class="mt-3">
								<label class="form-label"><b>Relation with Head Of Family</b><span id="mandatory">&nbsp;*</span> </label>
                        		<select class="form-control form-control-sm" name="individual_relation_with_head" id="individual_relation_with_head"required>
                              		<option value="">Choose Relation</option>
                              		<option value="Self">Self</option>
                              		<option value="Spouse">Spouse</option>
                              		<option value="Son">Son</option>
                              		<option value="Daughter">Daughter</option>
                              		<option value="Mother">Mother</option>
                              		<option value="Father">Father</option>
                              		<option value="Brother">Brother</option>
                              		<option value="Sister">Sister</option>
                              		<option value="Other">Other</option>
                        		</select> 
                        		<div id="irelcheck"></div>
							</div>
					

							<div class="row mt-3">
								<div class="col-md-4">
									<label class="form-label"><b>Are You Student?</b><span id="mandatory">&nbsp;*</span> </label>
									<div class="row ">
										<div class="col-md-6 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_student" id="student1" value="yes" required>
												<label class="form-check-label" for="student1">
													Yes
												</label>
											</div>
										</div>
										<div class="col-md-6 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_student" id="student2" value="no">
												<label class="form-check-label" for="student2">
													No
												</label>
											</div>
										</div>
									</div>
									<div id="istudcheck"></div>
								</div>
								<div class="col-md-4 college"  style="display: none;" >
									<label class="form-label"><b>Name Of The School/College</b></label>
									<input type="text" class="form-control form-control-sm studnull" name="insitution_name" id="insitution_name" placeholder="Enter Institution Name">
									<br>
								</div>
								<div class="col-md-4 college"  style="display: none;">
									<label class="form-label"><b>Which Standard?</b></label>
									<input type="text" class="form-control form-control-sm studnull"
									name="standard_semester" id="standard_semester" placeholder="Enter Standard">
								</div>
							</div>
							<div class="row mt-4 align-items-center">
								<div class="col-md-4">
									<label class="form-label"><b>Underfive child?</b><span id="mandatory">&nbsp;*</span> </label>
									<div class="row ">
										<div class="col-md-6 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="underfive_yes_no" id="underfive1" value="yes" required>
												<label class="form-check-label" for="underfive1">
													Yes
												</label>
											</div>
										</div>
										<div class="col-md-6 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="underfive_yes_no" id="underfive2" value="no">
												<label class="form-check-label" for="underfive2">
													No
												</label>
											</div>
										</div>
									</div>
									<div id="iufivecheck"></div>
								</div>
							</div>

							<div class="mt-3" id="ifvac" style="display: none;">
								<label class="form-label"><b>If Yes What Vaccines Taken So Far?</b></label>
								<table class="table table-sm table-responsive-lg dt " width="100%" cellspacing="0">
									


									<tr>
										<td><b>BCG</b></td>
										<td><div class="form-check">
												<input type="radio" class="form-check-input" name="bcg" id="bcg1" value="yes">
												<label class="form-check-label" for="bcg1">
														Yes
												</label>
											</div>
										</td>
										<td><div class="form-check">
												<input type="radio" class="form-check-input" name="bcg" id="bcg2" value="no">
												<label class="form-check-label" for="bcg2">
														No
												</label>
											</div>
										</td>
										<td></td>
									</tr>
									<tr>
										<td><b>Hepatitis B Birth Dose</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="hepatitis" id="hepatitis1" value="yes" >
													<label class="form-check-label" for="hepatitis1">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="hepatitis" id="hepatitis2" value="no">
													<label class="form-check-label" for="hepatitis2">
														No
													</label>
												</div>
										</td>
										<td></td>
									</tr>
									<tr>
										<td><b>OPV Zero Dose </b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv" id="opv1" value="yes" >
													<label class="form-check-label" for="opv1">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv" id="opv2" value="no">
													<label class="form-check-label" for="opv2">
														No
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>Pentavalent 1 </b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent1" id="pentavalent11" value="yes" >
													<label class="form-check-label" for="pentavalent11">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent1" id="pentavalent12" value="no">
													<label class="form-check-label" for="pentavalent12">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent1" id="pentavalent13" value="na">
													<label class="form-check-label" for="pentavalent13">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>OPV 1 </b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv1" id="opv11" value="yes" >
													<label class="form-check-label" for="opv11">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv1" id="opv12" value="no">
													<label class="form-check-label" for="opv12">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv1" id="opv13" value="na">
													<label class="form-check-label" for="opv13">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>IPV 1 </b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="ipv1" id="ipv11" value="yes" >
													<label class="form-check-label" for="ipv11">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="ipv1" id="ipv12" value="no">
													<label class="form-check-label" for="ipv12">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="ipv1" id="ipv13" value="na">
													<label class="form-check-label" for="ipv13">
														NA
													</label>
												</div>
										</td>
									</tr>


									<tr>
										<td><b>Rotavirus 1</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus1" id="rotavirus11" value="yes" >
													<label class="form-check-label" for="rotavirus11">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus1" id="rotavirus12" value="no">
													<label class="form-check-label" for="rotavirus12">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus1" id="rotavirus13" value="na">
													<label class="form-check-label" for="rotavirus13">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>PCV 1</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcv1" id="pcv11" value="yes" >
													<label class="form-check-label" for="pcv11">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcv1" id="pcv12" value="no">
													<label class="form-check-label" for="pcv12">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcv1" id="pcv13" value="na">
													<label class="form-check-label" for="pcv13">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>Pentavalent 2</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent2" id="pentavalent21" value="yes" >
													<label class="form-check-label" for="pentavalent21">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent2" id="pentavalent22" value="no">
													<label class="form-check-label" for="pentavalent22">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent2" id="pentavalent23" value="na">
													<label class="form-check-label" for="pentavalent23">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>OPV 2</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv2" id="opv21" value="yes" >
													<label class="form-check-label" for="opv21">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv2" id="opv22" value="no">
													<label class="form-check-label" for="opv22">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv2" id="opv23" value="na">
													<label class="form-check-label" for="opv23">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>Rotavirus 2</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus2" id="rotavirus21" value="yes" >
													<label class="form-check-label" for="rotavirus21">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus2" id="rotavirus22" value="no">
													<label class="form-check-label" for="rotavirus22">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus2" id="rotavirus23" value="na">
													<label class="form-check-label" for="rotavirus23">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>Pentavalent 3</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent3" id="pentavalent31" value="yes" >
													<label class="form-check-label" for="pentavalent31">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent3" id="pentavalent32" value="no">
													<label class="form-check-label" for="pentavalent32">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pentavalent3" id="pentavalent33" value="na">
													<label class="form-check-label" for="pentavalent33">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>OPV 3</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv3" id="opv31" value="yes" >
													<label class="form-check-label" for="opv31">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv3" id="opv32" value="no">
													<label class="form-check-label" for="opv32">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opv3" id="opv33" value="na">
													<label class="form-check-label" for="opv33">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>IPV 2</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="ipv2" id="ipv21" value="yes" >
													<label class="form-check-label" for="ipv21">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="ipv2" id="ipv22" value="no">
													<label class="form-check-label" for="ipv22">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="ipv2" id="ipv23" value="na">
													<label class="form-check-label" for="ipv23">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>Rotavirus 3</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus3" id="rotavirus31" value="yes" >
													<label class="form-check-label" for="rotavirus31">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus3" id="rotavirus32" value="no">
													<label class="form-check-label" for="rotavirus32">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="rotavirus3" id="rotavirus33" value="na">
													<label class="form-check-label" for="rotavirus33">
														NA
													</label>
												</div>
										</td>
									</tr>

									<tr>
										<td><b>PCV 2</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcv2" id="pcv21" value="yes" >
													<label class="form-check-label" for="pcv21">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcv2" id="pcv22" value="no">
													<label class="form-check-label" for="pcv22">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcv2" id="pcv23" value="na">
													<label class="form-check-label" for="pcv23">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>MR 1</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="mr1" id="mr11" value="yes" >
													<label class="form-check-label" for="mr11">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="mr1" id="mr12" value="no">
													<label class="form-check-label" for="mr12">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="mr1" id="mr13" value="na">
													<label class="form-check-label" for="mr13">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>PCV Booster</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcvbooster" id="pcvbooster1" value="yes" >
													<label class="form-check-label" for="pcvbooster1">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcvbooster" id="pcvbooster2" value="no">
													<label class="form-check-label" for="pcvbooster2">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="pcvbooster" id="pcvbooster3" value="na">
													<label class="form-check-label" for="pcvbooster3">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>Vitamin A</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="vitamina" id="vitamina1" value="yes" >
													<label class="form-check-label" for="vitamina1">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="vitamina" id="vitamina2" value="no">
													<label class="form-check-label" for="vitamina2">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="vitamina" id="vitamina3" value="na">
													<label class="form-check-label" for="vitamina3">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>DPT Booster 1</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="dptbooster1" id="dptbooster11" value="yes" >
													<label class="form-check-label" for="dptbooster11">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="dptbooster1" id="dptbooster12" value="no">
													<label class="form-check-label" for="dptbooster12">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="dptbooster1" id="dptbooster13" value="na">
													<label class="form-check-label" for="dptbooster13">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>OPV Booster</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opvbooster" id="opvbooster1" value="yes" >
													<label class="form-check-label" for="opvbooster1">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opvbooster" id="opvbooster2" value="no">
													<label class="form-check-label" for="opvbooster2">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="opvbooster" id="opvbooster3" value="na">
													<label class="form-check-label" for="opvbooster3">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>MR 2</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="mr2" id="mr21" value="yes" >
													<label class="form-check-label" for="mr21">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="mr2" id="mr22" value="no">
													<label class="form-check-label" for="mr22">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="mr2" id="mr23" value="na">
													<label class="form-check-label" for="mr23">
														NA
													</label>
												</div>
										</td>
									</tr>
									<tr>
										<td><b>DPT Booster 2</b></td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="dptbooster2" id="dptbooster21" value="yes" >
													<label class="form-check-label" for="dptbooster21">
														Yes
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="dptbooster2" id="dptbooster22" value="no">
													<label class="form-check-label" for="dptbooster22">
														No
													</label>
												</div>
										</td>
										<td><div class="form-check">
													<input type="radio" class="form-check-input" name="dptbooster2" id="dptbooster23" value="na">
													<label class="form-check-label" for="dptbooster23">
														NA
													</label>
												</div>
										</td>
									</tr>
								</table>
							</div>

							<div class="mt-3" id="immusatate" style="display: none;">
								<label class="form-label"><b>Immunization Status</b><span id="mandatory">&nbsp;*</span> </label>
                        		<select class="form-control form-control-sm" name="immunization" id="immunization" >
                              		<option value="">Choose Status</option>
                              		<option value="Unimmunised">Unimmunised</option>
                              		<option value="Unimmunised">Partially Immunised</option>
                              		<option value="Fully Immunised">Fully Immunised</option>
                              		<option value="Immunised Till Date">Immunised Till Date </option>
                        		</select> 
                        		<div id="immucheck"></div>
							</div>
							<div class="mt-3" id="alcohol_div">
								<label class="form-label"><b>Alcohol Use</b><span id="mandatory">&nbsp;*</span> </label>
								<select class="form-control form-control-sm" name="individual_alcohol_usage" id="individual_alcohol_usage"required>
	                              	<option value="">Choose</option>
	                              	<option value="No alcohol use">No alcohol use</option>
	                              	<option value="Daily use">Daily use</option>
	                              	<option value="1-4 days a week">1-4 days a week</option>
	                              	<option value="1-3 days a month">1-3 days a month</option>
	                              	<option value="less than once a month">less than once a month</option>
                        		</select>
                        		<div id="ialcocheck"></div> 
							</div>
							<div class="mt-3" id="tobacco_div">
								<label class="form-label"><b>Tobacco Use</b><span id="mandatory">&nbsp;*</span> </label>
								<select class="form-control form-control-sm" name="individual_tobacco_usage" id="individual_tobacco_usage"required>
	                              	<option value="">Choose</option>
	                              	<option value="no tobacco use">No tobacco use</option>
	                              	<option value="smokeless">Smokeless form</option>
	                              	<option value="smoking">Smoking form</option>
	                              	<option value="both">Both</option>
                        		</select>
                        		<div id="itobaccocheck"></div> 
							</div>
							

							<div class=" mt-3">
									<label class="form-label"><b>Diet</b><span id="mandatory">&nbsp;*</span> </label>
									<select class="form-control form-control-sm" name="individual_diet" id="individual_diet"required>
	                              		<option value="">Choose</option>
	                              		<option value="Veg">Veg</option>
	                              		<option value="Mixed diet">Mixed diet</option>
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
												<input type="radio" class="form-check-input" name="ichronic" id="chronic1" value="yes"required >
												<label class="form-check-label" for="chronic1">Yes
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="ichronic" id="chronic2" value="no" >
												<label class="form-check-label" for="chronic2">No</label>
											</div>
										</div>
									</div>
									<div id="chronicso" style="display: none;">
										<label class="form-label">If Yes</label>
										<textarea class="form-control form-control-sm" rows="4" name="individual_chronic_illness" id="individual_chronic_illness" value="no"></textarea>
									</div>
								</div>

								<div class="mt-2">
									<label class="form-label">2.&nbsp;Acute Illness (two weeks)<span id="mandatory">&nbsp;*</span></label>
									<div class="row">
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="iacute" id="acute1" value="yes"required >
												<label class="form-check-label" for="acute1">Yes
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="iacute" id="acute2" value="no" >
												<label class="form-check-label" for="acute2">No</label>
											</div>
										</div>
									</div>
									<div id="acuteso" style="display: none;">
										<label class="form-label">If Yes</label>
										<textarea class="form-control form-control-sm" rows="4" name="individual_acute_illness" id="individual_acute_illness" value="no"></textarea>
									</div>
								</div>

								<div class="mt-2">
									<label class="form-label">3.&nbsp;Flu like illness<span id="mandatory">&nbsp;*</span></label>
									<div class="row">
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_flu_illness" id="flu1" value="yes"required >
												<label class="form-check-label" for="flu1">Yes
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_flu_illness" id="flu2" value="no" >
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
												<input type="radio" class="form-check-input" name="individual_maleria" id="maleria1" value="yes" required>
												<label class="form-check-label" for="maleria1">Yes
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_maleria" id="maleria2" value="no" >
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
												<input type="radio" class="form-check-input" name="individual_dengue" id="dengue1" value="yes" required>
												<label class="form-check-label" for="dengue1">Yes
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_dengue" id="dengue2" value="no" >
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
												<input type="radio" class="form-check-input" name="individual_tuberculosis" id="tuber1" value="yes" required>
												<label class="form-check-label" for="tuber1">Yes
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_tuberculosis" id="tuber2" value="no" >
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
											<input type="radio" class="form-check-input" name="known_hypertension" id="ht1" value="yes" required>
											<label class="form-check-label" for="ht1">Yes</label>
										</div>
									</div>
									<div class="col-md-3 ps-5">
										<div class="form-check">
											<input type="radio" class="form-check-input" name="known_hypertension" id="ht2" value="no"required>
											<label class="form-check-label" for="ht2">No</label>
										</div>
									</div>
									<div class="col-md-3 ps-5">
										<div class="form-check">
											<input type="radio" class="form-check-input" name="known_hypertension" id="ht3" value="do not know"required >
											<label class="form-check-label" for="ht3">Do Not Know</label>
										</div>
									</div>
									<div class="col-md-3 ps-5">
										<div class="form-check">
											<input type="radio" class="form-check-input" name="known_hypertension" id="ht4" value="na"required >
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
												<input type="radio" class="form-check-input" name="known_dm" id="dm1" value="yes" required>
												<label class="form-check-label" for="dm1">Yes</label>
											</div>
										</div>
										<div class="col-md-3 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="known_dm" id="dm2" value="no">
												<label class="form-check-label" for="dm2">No</label>
											</div>
										</div>
										<div class="col-md-3 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="known_dm" id="dm3" value="do not know" >
												<label class="form-check-label" for="dm3">Do Not Know</label>
											</div>
										</div>
										<div class="col-md-3 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="known_dm" id="dm4" value="na" >
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
												<input type="radio" class="form-check-input" name="teeth_related_questions" id="teeth_related_questions1" value="applicable" >
												<label class="form-check-label" for="teeth_related_questions1">Applicable
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="teeth_related_questions" id="teeth_related_questions2" value="not applicable" >
												<label class="form-check-label" for="teeth_related_questions2">Not Applicable</label>
											</div>
										</div>
								</div>
							</div>
							<div class="row mt-3 teeth_ques" style="display: none;">
								<div class="col-md-6">
									<label class="form-label"><b>How do you generally clean your teeth?</b><span id="mandatory">&nbsp;*</span></label>
									<div class="row ">
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_clean_teeth" id="teeth1" value="fingers" >
												<label class="form-check-label" for="teeth1">Fingers
												</label>
											</div>
											<br>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_clean_teeth" id="teeth2" value="tooth brush" >
												<label class="form-check-label" for="teeth2">Tooth brush</label>
											</div>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_clean_teeth" id="teeth3" value="others" >
												<label class="form-check-label" for="teeth3">Others</label>
											</div>
										</div>
									</div>
									<div id="ibrushcheck"></div>
								</div>
								<div class="col-md-6" id="ifbrush" style="display: none;">
									<label class="form-label"><b>If Others Specify</b></label>
									<input type="text" class="form-control form-control-sm" name="individual_teeth_other" id="individual_teeth_other" >
								</div>
							</div>
							<div class="row mt-3 teeth_ques" style="display: none;">
								<div class="col-md-6">
									<label class="form-label"><b>How often do you clean your teeth in a day?</b><span id="mandatory">&nbsp;*</span></label>
									<select class="form-control form-control-sm" name="individual_clean_day" id="individual_clean_day">
	                              		<option value="">Choose</option>
	                              		<option value="Once">Once</option>
	                              		<option value="Twice">Twice</option>
	                              		<option value="Thrice">Thrice</option>
	                              		<option value="After every meal">After every meal</option>
	                              		<option value="Don't clean everyday">Don't clean everyday</option>
                        			</select> 
                        			<div id="icleancheck"></div>
                        			<br>
								</div>
								<div class="col-md-6">
									<label class="form-label"><b>What material generally you use to clean your teeth?</b><span id="mandatory">&nbsp;*</span></label>
									<select class="form-control form-control-sm" name="individual_material_for_clean" id="individual_material_for_clean">
	                              		<option value="">Choose</option>
	                              		<option value="Toothpaste">Toothpaste</option>
	                              		<option value="Tooth powder">Tooth powder</option>
	                              		<option value="Other">Other</option>
                        			</select> 
                        			<div id="imatcheck"></div>
								</div>
							</div>
							<div class="mt-3 teeth_ques" style="display: none;">
								<label class="form-label"><b>Check toothpaste/tooth powder used and record whether it is fluoridated or not?</b><span id="mandatory">&nbsp;*</span></label>
								<select class="form-control form-control-sm" name="individual_paste_kind" id="individual_paste_kind">
	                              	<option value="">Choose</option>
	                              	<option value="Yes">Yes</option>
	                              	<option value="No">No</option>
	                              	<option value="Can't say">Can't say</option>
                        		</select> 
                      			<div id="ipastecheck"></div>
							</div>
							<div class=" mt-3 teeth_ques" style="display: none;">
									<label class="form-label"><b>How often do you change your toothbrush?</b><span id="mandatory">&nbsp;*</span></label>
									<select class="form-control form-control-sm" name="individual_change_brush" id="individual_change_brush">
	                              		<option value="">Choose</option>
	                              		<option value="1-3 months">1-3 months</option>
	                              		<option value="4-6 months">4-6 months</option>
	                              		<option value=">6 months">>6 months</option>
	                              		<option value="Not using toothbrush">Not using toothbrush</option>
                        			</select> 
                        			<div id="ichangebcheck"></div>
							</div>
							<div class="mt-3 teeth_ques" style="display: none;">
								<label class="form-label"><b>Do you use any of these oral hygine aids? (Tick as many as reported)</b><span id="mandatory">&nbsp;*</span></label>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine1" value="Dental floss">
										<label class="form-check-label" for="oralhygine1">Dental floss</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine2" value="Interdental brush">
										<label class="form-check-label" for="oralhygine2">Interdental brush</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine3" value="Toothpick">
										<label class="form-check-label" for="oralhygine3">Toothpick</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine4" value="Mouthrinse">
										<label class="form-check-label" for="oralhygine4">Mouthrinse</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine5" value="Others">
										<label class="form-check-label" for="oralhygine5">Others</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_oral_hygine_aids[]" id="oralhygine6" value="None">
										<label class="form-check-label" for="oralhygine6">None</label>
									</div>
									<div id="iohygcheck"></div>
							</div>
							<div class="row mt-3 teeth_ques" style="display: none;">
								<div class="col-md-6">
									<label class="form-label"><b>Have you suffered from any mouth or teeth problems in the last one year?</b><span id="mandatory">&nbsp;*</span></label>
									<div class="row ">
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_mouth_problem" id="mouth1" value="yes" >
												<label class="form-check-label" for="mouth1">Yes
												</label>
											</div>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_mouth_problem" id="mouth2" value="no" >
												<label class="form-check-label" for="mouth2">No</label>
											</div>
										</div>
										<div class="col-md-4 ps-5">
											<div class="form-check">
												<input type="radio" class="form-check-input" name="individual_mouth_problem" id="mouth3" value="cant say" >
												<label class="form-check-label" for="mouth3">Can't say</label>
											</div>
										</div>
									</div>
									<div id="itprobcheck"></div>
								</div>
								<div class="col-md-6" style="display:none;" id="one_year_prob">
									<label class="form-label"><b>What were or was the problems?</b><span id="mandatory">&nbsp;*</span></label>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck1" value="Tooth decay">
										<label class="form-check-label" for="mcheck1">Tooth decay</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck2" value="Foul breath/bleeding gums/ Gum disease">
										<label class="form-check-label" for="mcheck2">Foul breath/bleeding gums/ Gum disease</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck3" value="Broken teeth/Trauma">
										<label class="form-check-label" for="mcheck3">Broken teeth/Trauma</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck4" value="Abscess">
										<label class="form-check-label" for="mcheck4">Abscess</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck5" value="Crooked teeth">
										<label class="form-check-label" for="mcheck5">Crooked teeth</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck6" value="Ulcer">
										<label class="form-check-label" for="mcheck6">Ulcer</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_mouth_check[]" id="mcheck7" value="Other">
										<label class="form-check-label" for="mcheck7">Other</label>
									</div>
									<div id="iprobcheck"></div>
								</div>
							</div>
							<div class=" mt-3 teeth_ques" style="display: none;">
									<label class="form-label"><b>How accessible are the dental facilities for treatment with avialable transport?</b><span id="mandatory">&nbsp;*</span></label>
									<select class="form-control form-control-sm" name="individual_transport_dental" id="individual_transport_dental">
	                              		<option value="">Choose</option>
	                              		<option value="> half an hour">> half an hour</option>
	                              		<option value="Half an hour to 1 hour">Half an hour to 1 hour</option>
	                              		<option value=">1 hour">>1 hour</option>
	                              		<option value="Cant say">Can't say</option>
                        			</select> 
                        			<div id="iaccesscheck"></div>
							</div>
							<div class="mt-3 teeth_ques" style="display: none;">
								<label class="form-label"><b>What in your opinion are the major factors which causes dental problems?</b> (Tick as many as reported)<span id="mandatory">&nbsp;*</span></label>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor1" value="Eating sweets such as icecreams/chocolate">
										<label class="form-check-label" for="factor1">Eating sweets such as icecreams/chocolate</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor2" value="Not brushing regularly">
										<label class="form-check-label" for="factor2">Not brushing regularly</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor3" value="Not rinsing regularly">
										<label class="form-check-label" for="factor3">Not rinsing regularly</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor4" value="Consuming tobacco products">
										<label class="form-check-label" for="factor4">Consuming tobacco products</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor5" value="Other specify">
										<label class="form-check-label" for="factor5">Other specify</label>
									</div>
									<div class="form-check ps-5">
										<input type="checkbox" class="form-check-input" name="individual_major_factor[]" id="factor6" value="Dont know">
										<label class="form-check-label" for="factor6">Don't know</label>
									</div>
									<div id="icdentcheck"></div>
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
                      			<button type="submit" class="btn btn-primary" id="submit_individual">Submit</button>
                      			<button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    		</div>
						</form>
					</div>
				</div>
			</div>
		</div>

<?php include('footer.php');?>
<script type="text/javascript" src="ajax/individual.js"></script>
<script type="text/javascript">
	$('#individual_date_of_birth').change(function(){
         var today = new Date();
          var birthDate = new Date($('#individual_date_of_birth').val());
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age--;
          }
         $('#individual_age').val(age);
            if(age >= 18)
                {
                    $('#bsadiv').show();
     $("#alcohol_div").show();
          $("#tobacco_div").show();
                

                 }
            else{
                $('#bsadiv').hide();
     $("#alcohol_div").hide();
      $("#tobacco_div").hide();                

            }
            var age1 = getAge(birthDate);
         alert(age1);
         document.getElementById("individual_age1").value = age1;
              
        });
	function getAge(dateString) {
		
  var now = new Date();
  
  var td=new Date(dateString);
  //alert(td);
 
 var today=now.getTime()-td.getTime();
 var birth=new Date(today);

  var yearNow = birth.getYear()-70;
alert(yearNow);
  var monthNow = birth.getMonth();
 // alert(monthNow);
 var dateNow = birth.getDate();
 //alert(dateNow);
  
  var ageFull="";
if ( (yearNow > 0) && (monthNow > 0) && (dateNow > 0) ){
	var ageFull= yearNow+" year "+monthNow+" month "+dateNow+" days ";
	 return ageFull;

}
else if ( (yearNow== 0) && (monthNow == 0) && (dateNow > 0) ){
	var ageFull= yearNow+" year "+monthNow+" month "+dateNow+" days ";
	 return ageFull;

}
else if ( (yearNow == 0) && (monthNow > 0) && (dateNow > 0) ){
	var ageFull= yearNow+" year "+monthNow+" month "+dateNow+" days ";
	 return ageFull;

}
  
   else{
    ageFull = "Oops! Could not calculate age!";
   return ageFull;
}

 
}

		$("#individual_tobacco_usage").change(function() {
    	if($(this).val() == 'smokeless') {   
            $("#smokless_form").show();
            $("#smoke_form").hide();
        }
        else if($(this).val() == 'smoking'){
            $("#smoke_form").show();
            $("#smokless_form").hide();
        }
        else if($(this).val() == 'both'){
        	$("#smokless_form").show();
        	$("#smoke_form").show();
        }
        else{
        	$("#smoke_form").hide();
        	$("#smokless_form").hide();
        }
    });


		$("#individual_age").keyup(function() {
		if($(this).val() < 18)
		{
			$("#alcohol_div").hide();
			$("#tobacco_div").hide();
		}
		else{
			$("#alcohol_div").show();
			$("#tobacco_div").show();
		}
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

</script>


