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

$query ="SELECT * FROM family_followup WHERE id='$id'";
$results=mysqli_query($conn, $query);

while ($rows=mysqli_fetch_array($results,MYSQLI_ASSOC)) {


?>

<div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-title pt-3 ps-3 text-primary">
                  <h3>Enroll Family</h3>
                </div>
                <div class="card-body">
                  <form class="form-sample" id="family_followup_update" method="POST">
                    <p class="card-description">
                      Family information
                    </p>
                    <input type="hidden" id="family_id" name="family_followup_id" value="<?php echo $id;?>">

                     <div class="row mt-4" id="birthdiv">
                        <div class="col-md-6">
                          <label class="form-label"><b>Any Birth in last 12 months?</b><span id="mandatory">&nbsp;*</span></label>
                          <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input bb" name="birth" id="birth1" value="yes"<?php if($rows['birth']=='yes') echo 'checked'; ?> >
                                  <label class="form-check-label" for="birth1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input bb " name="birth" id="birth2" value="no" <?php if($rows['birth']=='no') echo 'checked'; ?>>
                                  <label class="form-check-label" for="birth2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <?php if ($rows['birth'] == 'yes' ) {  ?>
                        <!-- <div class="col-md-6 " id="ifso">
                          <label class="form-label"><b>If So Provide Number Of Birth</b></label>
                          <select class="form-control" name="nofbirth" id="nofbirthup" >
                              <option value="0">Choose Number Of Birth</option>
                              <option value="1"<?php if($rows['nofbirth'] == '1') echo 'selected';?>>1</option>
                              <option value="2"<?php if($rows['nofbirth'] == '2') echo 'selected';?>>2</option>
                              <option value="3"<?php if($rows['nofbirth'] == '3') echo 'selected';?>>3</option>
                              <option value="4"<?php if($rows['nofbirth'] == '4') echo 'selected';?>>4</option>
                          </select> 
                        <br>
                        </div> -->
                          <div class="mt-3">
                            <input type="hidden" value="<?php echo $rows['family_id'];?>" id="family_id">
                             <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#add_birth" >ADD</button>
                              <!-- Modal -->
                              <div class="modal fade" id="add_birth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title"> Add Birth History</h2>
                                    </div>
                                    <div class="modal-body">
                                      <input type="hidden" value="">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <label class="form-label">Date</label>
                                          <input type="date" class="form-control" name="cbdate_add" id="cbdate_add" value="">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Name</label>
                                          <input type="text" class="form-control" name="cbname_add" id="cbname_add" value="">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Gender</label>
                                          <select class="form-control form-control-sm" name="cbgender_add" id="cbgender_add">
                                          <option value="0">Choose Gender</option>
                                          <option value="male">Male</option>
                                          <option value="female">Female</option>
                                          <option value="others">Others</option>
                                          </select>
                                        </div>
                                      </div>    
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" id="close_add_birth" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" id="insert_birth" data-id="<?php echo $rows['id'];?>" >Save</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="table-responsive mt-3" id="birth_table" >
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Date</th>
                                      <th>Name</th>
                                      <th>Gender</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                                <?php 
                                $family_followup_code=$rows['id'];

                                $db=$conn;
                                $birth_query="SELECT * FROM birth_history WHERE family_followup_code='$family_followup_code'";
                                $sql_birth=mysqli_query($db,$birth_query);
                                $n=1;
                                while ($rows_birth=mysqli_fetch_assoc($sql_birth)){
                                ?>
                                
                                <tr>
                                  <td><?php echo $n;?></td>
                                  <td><?php echo $rows_birth['cbdate'];?></td>
                                  <td><?php echo $rows_birth['cbname'];?></td>
                                  <td><?php echo $rows_birth['cbgender'];?></td>
                                  <td> 
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_birth" type="GET" id="edit_birth_btn" data-id="<?php echo $rows_birth['id'];?>" ><i class="fa-solid fa-pen-to-square"></i></button> 
                                  <button type="button" class="btn btn-primary" id="delete_birth" data-id="<?php echo $rows_birth['id'];?>" type="POST" ><i class="fa-solid fa-trash-can"></i></button>  
                                  </td> 
                                   <!-- Modal -->
                                    <div class="modal fade" id="edit_birth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title"> Edit Birth History</h2>
                                          </div>
                                          <div class="modal-body" id="edit_birth_modal" >
                                           
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                              
                                </tr> 
                                <?php  
                                $n++;
                                }
                                ?>  
                              </tbody>
                            
                          </table>
                      </div>
                        <?php } ?>
                      </div>
                          
                      <div class="row mt-4 "id="deathdiv"> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Any death in the family in last 12 months?</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="death" id="death1" value="yes"<?php if($rows['death']=='yes') echo 'checked'; ?> >
                                  <label class="form-check-label" for="death1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="death" id="death2" value="no"<?php if($rows['death']=='no') echo 'checked'; ?> >
                                  <label class="form-check-label" for="death2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <?php if ($rows['death'] == 'yes' ) {  ?>
                        <!-- <div class="col-md-6" id="ifd" >
                            <label class="form-label"><b>If So Provide Number Of Death</b></label>
                            <select class="form-control" name="nofdeath" >
                              <option value="0">Choose Number Of Death</option>
                              <option value="1"<?php if($rows['nofdeath'] == '1') echo 'selected';?>>1</option>
                              <option value="2"<?php if($rows['nofdeath'] == '2') echo 'selected';?>>2</option>
                              <option value="3"<?php if($rows['nofdeath'] == '3') echo 'selected';?>>3</option>
                              <option value="4"<?php if($rows['nofdeath'] == '4') echo 'selected';?>>4</option>
                            </select> 
                            <br>
                        </div> -->
                         <div class="mt-3">
                            <input type="hidden" value="<?php echo $rows['family_id'];?>" id="family_id">
                             <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#add_death" >ADD</button>
                              <!-- Modal -->
                              <div class="modal fade" id="add_death" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title"> Add Death History</h2>
                                    </div>
                                       <div class="modal-body">
                                      <input type="hidden" value="">
                                      <div class="row ">
                                        <div class="col-md-4">
                                          <label class="form-label">Date</label>
                                          <input type="date" class="form-control" name="ddate_add" id="ddate_add" value="">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Name</label>
                                          <input type="text" class="form-control" name="dname_add" id="dname_add" value="">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Age</label>
                                          <input type="text" class="form-control" name="dage_add" id="dage_add" value="">
                                        </div>
                                      </div>
                                      <div class="row mt-3">
                                        <div class="col-md-6">
                                          <label class="form-label">Gender</label>
                                          <select class="form-control form-control-sm" name="dgender_add" id="dgender_add">
                                          <option value="0">Choose Gender</option>
                                          <option value="male">Male</option>
                                          <option value="female">Female</option>
                                          <option value="others">Others</option>
                                          </select>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Cause Of Death</label>
                                          <input type="text" class="form-control" name="dcause_add" id="dcause_add" value="">
                                        </div>
                                      </div>    
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" id="close_add_death" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" id="insert_death" data-id="<?php echo $rows['id'];?>" >Save</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        <div class="table-responsive mt-3" id="death_table" >
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Date</th>
                                      <th>Name</th>
                                      <th>Age</th>
                                      <th>Gender</th>
                                      <th>Cause Of Death</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                                <?php 
                           
                                $family_followup_code=$rows['id'];
                               
                                $db=$conn;
                                 $death_query="SELECT * FROM death_history WHERE family_followup_code='$family_followup_code'";
                                $sql_death=mysqli_query($db,$death_query);
                                $n=1;
                                while ($rows_death=mysqli_fetch_assoc($sql_death)){
                                ?>
                                
                                <tr>
                                  <td><?php echo $n;?></td>
                                  <td><?php echo $rows_death['ddate'];?></td>
                                  <td><?php echo $rows_death['dname'];?></td>
                                  <td><?php echo $rows_death['dage'];?></td>
                                  <td><?php echo $rows_death['dgender'];?></td>
                                  <td><?php echo $rows_death['dcause'];?></td>
                                  <td> 
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_death" type="GET" id="edit_death_btn" data-id="<?php echo $rows_death['id'];?>" ><i class="fa-solid fa-pen-to-square"></i></button> 
                                  <button type="button" class="btn btn-primary" id="delete_birth" data-id="<?php echo $rows_death['id'];?>" type="POST" ><i class="fa-solid fa-trash-can"></i></button> 
                                  </td>
                                   <!-- Modal -->
                                   <div class="modal fade" id="edit_death" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title"> Edit Death History</h2>
                                          </div>
                                          <div class="modal-body" id="edit_death_modal" >
                                           
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Modal -->
                              <div class="modal fade" id="edit_death" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body">
                             
                                  </div>
                                </div>
                              </div>
                                </tr> 
                                <?php  
                                $n++;
                              }
                                ?>  
                              </tbody>
                          </table>
                      </div>
                        <?php } ?>
                      </div>

                      <div class="row mt-4 "id="marrydiv"> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Any marriage in last 12 months?</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="marriage" id="marriage1" value="yes"<?php if($rows['marriage']=='yes') echo 'checked'; ?> >
                                  <label class="form-check-label" for="marriage1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="marriage" id="marriage2" value="no"<?php if($rows['marriage']=='no') echo 'checked'; ?>>
                                  <label class="form-check-label" for="marriage2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <?php if ($rows['marriage'] == 'yes' ) {  ?>
                        <!-- <div class="col-md-6" id="ifm" >
                            <label class="form-label"><b>If So Provide Number Of Marriage</b></label>
                            <select class="form-control" name="nofmarry" id="nofmarry">
                              <option value="0">Choose Number Of Marriage</option>
                              <option value="1"<?php if($rows['nofmarry'] == '1') echo 'selected';?>>1</option>
                              <option value="2"<?php if($rows['nofmarry'] == '2') echo 'selected';?>>2</option>
                              <option value="3"<?php if($rows['nofmarry'] == '3') echo 'selected';?>>3</option>
                              <option value="4"<?php if($rows['nofmarry'] == '4') echo 'selected';?>>4</option>
                            </select> 
                            <br>
                        </div> -->
                        <div class="table-responsive mt-3" id="death_table" >
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Name</th>
                                      <th>Age</th>
                                      <th>Gender</th>
                                      <th>Relation With HOF</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                                <?php 
                                
                                $family_followup_code=$rows['id'];
                                $db=$conn;
                                 $marry_query="SELECT * FROM marriage_history WHERE family_id='$family_followup_code'";
                                $sql_marry=mysqli_query($db,$marry_query);
                                $n=1;
                                
                                while ($rows_marry=mysqli_fetch_assoc($sql_marry)){
                                ?>
                                
                                <tr>
                                  <td><?php echo $n;?></td>
                                  <td><?php echo $rows_marry['marryname'];?></td>
                                  <td><?php echo $rows_marry['marryage'];?></td>
                                  <td><?php echo $rows_marry['marrygender'];?></td>
                                  <td><?php echo $rows_marry['marryrel'];?></td>
                                   <td>  
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_marry" type="GET" id="edit_marry_btn" data-id="<?php echo $rows_marry['id'];?>" ><i class="fa-solid fa-pen-to-square"></i></button> 
                                  <button type="button" class="btn btn-primary" id="delete_marry" data-id="<?php echo $rows_marry['id'];?>" type="POST" ><i class="fa-solid fa-trash-can"></i></button>    
                                </td>
                                      <!-- Modal -->
                              <div class="modal fade" id="edit_marry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <input type="hidden" value="<?php echo $rows_marry['id'];?>">
                                      <div class="row ">
                                        <div class="col-md-6">
                                          <label class="form-label">Name</label>
                                          <input type="text" class="form-control" name="marryname" id="marryname" value="<?php echo $rows_marry['marryname'];?>">
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Age</label>
                                          <input type="text" class="form-control" name="marryage" id="marryage" value="<?php echo $rows_marry['marryage'];?>">
                                        </div>
                                      </div>
                                      <div class="row mt-3">
                                        <div class="col-md-6">
                                          <label class="form-label">Gender</label>
                                          <select class="form-control form-control-sm" name="marrygender" id="marrygender">
                                          <option value="0">Choose Gender</option>
                                          <option value="male"<?php if($rows_marry['marrygender']=='male') echo 'selected'; ?>>Male</option>
                                          <option value="female"<?php if($rows_marry['marrygender']=='female') echo 'selected'; ?>>Female</option>
                                          <option value="others"<?php if($rows_marry['marrygender']=='others') echo 'selected'; ?>>Others</option>
                                          </select>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Relation With HOF</label>
                                          <input type="text" class="form-control" name="marryrel" id="marryrel" value="<?php echo $rows_marry['marryrel'];?>">
                                        </div>
                                      </div>    
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" id="close_marry" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" id="update_marry" data-id="<?php echo $rows_marry['id'];?>" >Save</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <?php  
                                $n++;
                              }
                                ?>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                        <?php } ?>
                      </div>
                   
 
                    <div class="mt-3">
                          <label class="form-label"><b>Health Problems Reported By The Family Members</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="family_health_problem" id="family_health_problem" placeholder="Enter Health Problems Reported By The Family Members" value="<?php echo $rows['family_health_problem'];?>" />
                    </div>

                    <div class="row mt-4 "> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Past One Year Health Care Utilization</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="utilization" id="utilization1" value="yes"<?php if($rows['healthcare']!='') echo 'checked'; ?> >
                                  <label class="form-check-label" for="utilization1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="utilization" id="utilization2" value="no"<?php if($rows['healthcare']=='') echo 'checked'; ?>>
                                  <label class="form-check-label" for="utilization2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <?php if ($rows['healthcare'] != '' ) {  ?>
                        <div class="col-md-6" id="ifhealth" >
                            <label class="form-label"><b>If yes</b></label>
                            <select class="form-control" name="healthcare" id="healthcare">
                              <option value="">Choose </option>
                              <option value="Govt"<?php if($rows['healthcare'] == 'Govt') echo 'selected';?>>Govt</option>
                              <option value="Private(YMCH)"<?php if($rows['healthcare'] == 'Private(YMCH)') echo 'selected';?>>Private(YMCH)</option>
                              <option value="Private (Others)"<?php if($rows['healthcare'] == 'Private (Others)') echo 'selected';?>>Private (Others)</option>
                              <option value="Other"<?php if($rows['healthcare'] == 'Other') echo 'selected';?>>Other</option>
                            </select> 
                        </div>
                         <?php } ?>
                      </div>

                      <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Direct Cost</b> ( Cost Of Treatment, Medicines, OPD,IPD,Etc) INR<span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="direct_cost" id="direct_cost" placeholder="Enter Cost Of Treatment, Medicines, OPD,IPD,Etc "value="<?php echo $rows['direct_cost'];?>" />
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Indirect Cost</b>( Travel, Loss Of Wages, Etc) INR<span id="mandatory">&nbsp;*</span></label>
                        <input type="text" class="form-control" name="indirect_cost" id="indirect_cost" placeholder="Enter Cost Of Travel, Loss Of Wages, Etc"value="<?php echo $rows['indirect_cost'];?>"/>
                      </div>
                    </div>

                    <div class="mt-3">
                          <label class="form-label"><b>Social Security Scheme </b>(Specify)<span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="scheme" id="scheme" placeholder="Enter Social Security Scheme"value="<?php echo $rows['scheme'];?>" />
                    </div>

                    <div class="row mt-4 "> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Have the family members approached you?</b><span id="mandatory">&nbsp;*</span></label>
                             <div class="row">
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="approached" id="approached1" value="yes"<?php if($rows['what_action_taken']!='') echo 'checked'; ?> >
                                  <label class="form-check-label" for="approached1">
                                  Yes
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 ps-5">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input" name="approached" id="approached2" value="no"<?php if($rows['what_action_taken']=='') echo 'checked'; ?>>
                                  <label class="form-check-label" for="approached2">
                                  No
                                </label>
                            </div>
                            </div>
                          </div>
                        </div>
                        <?php if ($rows['healthcare'] != '' ) {  ?>
                        <div class="col-md-6" id="ifapproach" >
                            <label class="form-label"><b>If Yes What Action You Have Taken?</b><span id="mandatory">&nbsp;*</span></label>
                            <input type="text" class="form-control" name="what_action_taken" id="what_action_taken" placeholder="Enter What Action You Have Taken " value="<?php echo $rows['scheme'];?>" />
                        </div>
                      </div>
                      <?php } ?>
                      <div class=" mt-4 "> 
                        
                          <label class="form-label"><b>Any Other Observation</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="text" class="form-control" name="observation" id="observation" placeholder="Enter If Any Other Observation " value="<?php echo $rows['observation'];?>" />
                        
                      </div>

                    <div class="mt-3">
                          <label class="form-label"><b>Date Of Visit</b><span id="mandatory">&nbsp;*</span></label>
                          <input type="date" name="date_of_visit" id="date_of_visit" class="form-control" value="<?php echo $rows['date_of_visit'];?>" />
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




  <?php }
    }
  ?>
  <?php include('footer.php');?>
  <script type="text/javascript" src="ajax/family_register.js"></script>
  <script type="text/javascript">
    
   // function closebt() {
    
    var closedeath=document.getElementById('close_death');
       closedeath.onclick=function() {
     location.reload();
    }
    var closemarry=document.getElementById('close_marry');
       closemarry.onclick=function() {
     location.reload();
    }
    var close_birthadd=document.getElementById('close_add_birth');
       close_birthadd.onclick=function() {
     location.reload();
    }
    var close_deathadd=document.getElementById('close_add_death');
       close_deathadd.onclick=function() {
     location.reload();
    }
  </script>
