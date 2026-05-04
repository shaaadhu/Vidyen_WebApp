<?php include('header.php');
include('config.php');
$db=$conn;
?>


        <div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-title pt-3 ps-3 text-primary">
                  <h3>Add Mentor</h3>
                </div>
                <div class="card-body">
                  <form class="form-sample" id="mentor_register" method="POST">
                    <p class="card-description">
                      Mentor information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                          <label class="form-label">Name</label>
                          <input type="text" name="mentor_name" id="mentor_name" class="form-control" />
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="mentor_email" id="mentor_email" class="form-control" />
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">  
                        <label class="form-label">Contact No.</label>
                        <input type="number" name="mentor_contact_number" id="mconnum" class="form-control" />   
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select class="form-control" name="mentor_department" id="mdept">
                              <option value="">Choose Department</option>
                              <option value="Community Medicine">Community Medicine</option>
                        </select> 
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <select class="form-control" name="mentor_designation" id="mdesign">
                              <option value="">Choose Designation</option>
                              <option value="Senior Resident">Senior Resident</option>
                              <option value="Assistant Professor">Assistant Professor</option>
                              <option value="Associate Professor">Associate Professor</option>
                              <option value="Additional Professor">Additional Professor</option>
                              <option value="Professor">Professor</option>
                        </select> 
                      </div>
                      <div class="col-md-6">
                          <label class="form-label">Date of Join</label>
                          <input type="date" class="form-control" name="mentor_date_of_joining" id="mdoj" placeholder=""/> 
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="mentor_employ_id" id="mempid" />
                      </div>
                      <div class="col-md-6">
                          <label class="form-label">Role</label>
                            <select class="form-control" name="mentor_role" id="mentor_role">
                              <option value="">Choose Role</option>
                              <?php 
                              $query="SELECT `id`,`role`,`description` FROM `role`";
                              $sqlcon=mysqli_query($db,$query);
                              while($rows=mysqli_fetch_array($sqlcon)){
                                echo"<option value='".$rows['id']."'>".$rows['role']."</option>";
                                //echo "<option value='" . $d['sex_code'] . "'>" . $d['sex_value'] . "</option>";

                              }
                              ?>
                            </select> 
                      </div>
                    </div>

                    
                    <div class="text-end mt-5">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include('footer.php');?>
<script type="text/javascript" src="ajax/register.js"></script>