<?php include('header.php');?>


        <div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-title pt-3 ps-3 text-primary">
                  <h3>Add Student</h3>
                </div>
                <div class="card-body">
                  <form class="form-sample" id="student_registration">
                    <p class="card-description">
                      Student information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                          <label class="form-label">Full Name</label>
                          <input type="text" class="form-control" name="student_name" id="sname" />
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="student_email" id="semail" />
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">  
                        <label class="form-label">Registration Number</label>
                        <input type="number" class="form-control" name="register_number" id="regnum" />   
                      </div>
                      <div class="col-md-6">  
                        <label class="form-label">Contact No.</label>
                        <input type="number" class="form-control" name="student_contact_number" id="sconnum" />   
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label">College Name</label>
                          <input type="text" class="form-control" name="college_name" id="colname" />
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Course Name</label>
                        <select class="form-control" name="course_name" id="corname">
                              <option value="">Choose Course</option>
                              <option value="MBBS">MBBS</option>
                              <option value="BDS">BDS</option>
                        </select> 
                      </div>
                    </div>
                    <div class="row mt-3">
                      
                      <div class="col-md-6">
                          <label class="form-label">Admission Year</label>
                          <input type="text" class="form-control" name="addmission_year" id="addyear" placeholder="" required>
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

<script type="text/javascript">
      $("#addyear").datepicker({

        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        autoclose:true //to close picker once year is selected
    });

</script>
<script type="text/javascript" src="ajax/register.js"></script>