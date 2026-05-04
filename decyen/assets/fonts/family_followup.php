<?php 
session_start();
include('header.php');
include 'config.php';
$db=$conn;
if(isset($_GET['id'])){
  $id=$_GET['id'];
}
?>



        <div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-title pt-3 ps-3 text-primary">
                  <h3>Enroll Family</h3>
                </div>
                <div class="card-body">
                  <form class="form-sample" id="family_followup" method="POST">
                    <p class="card-description">
                      Family information
                    </p>
                    <input type="hidden" id="family_id" name="family_id" value="<?php echo $id;?>">

                     <div class="row mt-4" id="birthdiv">
                        <div class="col-md-6">
                          <label class="form-label"><b>Any Birth in last 12 months?</b><span id="mandatory">&nbsp;*</span></label>
                          <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input bb" name="birth" id="birth1" value="yes" >
                                  <label class="form-check-label" for="birth1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input bb " name="birth" id="birth2" value="no">
                                  <label class="form-check-label" for="birth2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 " id="ifso" style="display: none;">
                          <label class="form-label"><b>If So Provide Number Of Birth</b></label>
                          <select class="form-control" name="nofbirth" id="nofbirth">
                              <option value="0">Choose Number Of Birth</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                        </select> 
                        <br>
                        </div>
                      </div>
                          
                      <div class="row mt-4 "id="deathdiv"> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Any death in the family in last 12 months?</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="death" id="death1" value="yes" >
                                  <label class="form-check-label" for="death1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="death" id="death2" value="no">
                                  <label class="form-check-label" for="death2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6" id="ifd" style="display:none;">
                            <label class="form-label"><b>If So Provide Number Of Death</b></label>
                            <select class="form-control" name="nofdeath" id="nofdeath">
                              <option value="0">Choose Number Of Death</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select> 
                            <br>
                        </div>
                      </div>

                      <div class="row mt-4 "id="marrydiv"> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Any marriage in last 12 months?</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="marriage" id="marriage1" value="yes" >
                                  <label class="form-check-label" for="marriage1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="marriage" id="marriage2" value="no">
                                  <label class="form-check-label" for="marriage2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6" id="ifm" style="display:none;">
                            <label class="form-label"><b>If So Provide Number Of Marriage</b></label>
                            <select class="form-control" name="nofmarry" id="nofmarry">
                              <option value="0">Choose Number Of Marriage</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select> 
                            <br>
                        </div>
                      </div>
                   
 
                    <div class="mt-3">
                          <label class="form-label"><b>Health Problems Reported By The Family Members</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="family_health_problem" id="family_health_problem" placeholder="Enter Health Problems Reported By The Family Members" />
                    </div>

                    <div class="row mt-4 "> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Past One Year Health Care Utilization</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="utilization" id="utilization1" value="yes" >
                                  <label class="form-check-label" for="utilization1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="utilization" id="utilization2" value="no">
                                  <label class="form-check-label" for="utilization2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6" id="ifhealth" style="display:none;">
                            <label class="form-label"><b>If yes</b></label>
                            <div class="form-check ps-5">
                              <input type="checkbox" class="form-check-input" name="healthcare[]" id="healthcare1" value="Govt">
                              <label class="form-check-label" for="healthcare1">Govt</label>
                            </div>
                            <div class="form-check ps-5">
                              <input type="checkbox" class="form-check-input" name="healthcare[]" id="healthcare2" value="Private(YMCH)">
                              <label class="form-check-label" for="healthcare2">Private(YMCH)</label>
                            </div>
                            <div class="form-check ps-5">
                              <input type="checkbox" class="form-check-input" name="healthcare[]" id="healthcare3" value="Private(Others)">
                              <label class="form-check-label" for="healthcare3">Private(Others)</label>
                            </div>
                            <div class="form-check ps-5">
                              <input type="checkbox" class="form-check-input" name="healthcare[]" id="healthcare4" value="Other">
                              <label class="form-check-label" for="healthcare4">Other</label>
                            </div>
                        </div>
                      </div>

                      <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Direct Cost</b> ( Cost Of Treatment, Medicines, OPD,IPD,Etc) INR<span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="direct_cost" id="direct_cost" placeholder="Enter Cost Of Treatment, Medicines, OPD,IPD,Etc " />
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Indirect Cost</b>( Travel, Loss Of Wages, Etc) INR<span id="mandatory">&nbsp;*</span></label>
                        <input type="text" class="form-control" name="indirect_cost" id="indirect_cost" placeholder="Enter Cost Of Travel, Loss Of Wages, Etc"/>
                      </div>
                    </div>

                    <div class="mt-3">
                          <label class="form-label"><b>Social Security Scheme </b>(Specify)<span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="scheme" id="scheme" placeholder="Enter Social Security Scheme" />
                    </div>

                    <div class="row mt-4 "> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Have the family members approached you?</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="approached" id="approached1" value="yes" >
                                  <label class="form-check-label" for="approached1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="approached" id="approached2" value="no">
                                  <label class="form-check-label" for="approached2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6" id="ifapproach" style="display:none;">
                            <label class="form-label"><b>If Yes What Action You Have Taken?</b><span id="mandatory">&nbsp;*</span></label>
                            <input type="text" class="form-control" name="what_action_taken" id="what_action_taken" placeholder="Enter What Action You Have Taken " />
                        </div>
                      </div>

                      <div class=" mt-4 "> 
                        
                          <label class="form-label"><b>Any Other Observation</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="observation" id="observation" placeholder="Enter If Any Other Observation " />
                        
                      </div>

                    <div class="mt-3">
                          <label class="form-label"><b>Date Of Visit</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="date" name="date_of_visit" id="date_of_visit" class="form-control" />
                    </div>

                    <div class="text-end mt-5">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <!-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> -->
                    </div>

            
                  </form>
                </div>
              </div>
            </div>
          </div>
                  


        <?php include('footer.php');?>

<script type="text/javascript" src="ajax/family_register.js"></script>