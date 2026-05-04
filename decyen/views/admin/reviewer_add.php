<?php
require_once __DIR__ . '/../main.php';
?>

<div class="content-wrapper bg-light">
  <div class="col-12 grid-margin">
    <div class="card p-3 shadow-lg">
        <div class="card-title p-3 text-primary d-flex justify-content-between">
          <h3>Add Reviewer</h3> 
          <a class="btn  btn-primary btn-sm " onClick="history.go(-1);">Back</a>
      </div>
          <div class="card-body">
            <form id="add_reviewer_form" method="POST" >    
               <?php echo Csrf::field(); ?>
              <div role="tabpanel" class="tab-pane" id="dinfo">
                <div class="row ">
                  <div class="col-md-6 mb-3">   
                    <label for="reviewer_name"><b>Name</b></label>
                    <input type="text" name="reviewer_name" required class="form-control" id="reviewer_name" placeholder="Enter Reviewer Name">
                  </div>
                  <div class="col-md-6 mb-3">   
                    <label for="reviewer_phone"><b>Phone Number</b></label>
                    <input type="number" name="reviewer_phone" required class="form-control" id="reviewer_phone" placeholder="Enter Reviewer Phone Number">
                  </div>
                  <div class="col-md-6 mb-3">   
                    <label for="reviewer_email"><b>Email</b></label>
                    <input type="email" name="reviewer_email" required class="form-control" id="reviewer_email" placeholder="Enter Reviewer Email">
                  </div>
                   <div class="col-md-6 mb-3">   
                    <label for="reviewer_designation"><b>Designation</b></label>
                    <input type="text" name="reviewer_designation" required class="form-control" id="reviewer_designation" placeholder="Enter Reviewer Designation">
                  </div>
                  <div class="col-md-6 mb-3">   
                    <label for="reviewer_institution"><b>Institution</b></label>
                    <input type="text" name="reviewer_institution" required class="form-control" id="reviewer_institution" placeholder="Enter Reviewer Institution Name">
                  </div>
                  <div class="col-md-6 mb-3">   
                    <label for="reviewer_address"><b>Address</b></label>
                    <input type="text" name="reviewer_address" required class="form-control" id="reviewer_address" placeholder="Enter Reviewer Address">
                  </div>
                  <div class="col-md-6 mb-3">   
                    <label for="reviewer_type"><b>Reviewer Type</b></label>
                    <select id="reviewer_type" name="reviewer_type" class="form-control" required>
                      <option value="">choose type of reviewer</option>
                      <option value="Abstract Reviewer">Abstract Reviewer</option>
                      <option value="PreConference Reviewer">Pre Conference
                       Reviewer</option>
                       <option value="Workshop Reviewer">Workshop Reviewer</option>
                    </select>
                  </div>
                </div>   
                </div>
                
              <div class="mt-5 text-center">
                <button type="submit" class="btn btn-primary btn-lg rounded text-light fw-bold" id="submit_reviewer_button">Submit</button>
                <button type="reset" class="btn btn-outline-danger btn-lg rounded  fw-bold"  >Cancel</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  


    <!-- <?php
require_once __DIR__ . '/../footer.php';
?> -->

<script>
 var isSubmitting = false;
 $(document).on('submit','#add_reviewer_form', function (e) {

  e.preventDefault();
  if (isSubmitting) {
        return;
    }
     isSubmitting = true;
  $.ajax({
    method: "POST",
    url: "index.php?controller=admin&action=ajaxAddReviewer", 
    data: $(this).serialize(),

    success: function (data) {
      alert(data);
    //   window.location.assign('view_reviewer.php');
        window.location.assign('index.php?controller=admin&action=reviewer_view');
    },
         complete: function() {
                isSubmitting = false;
            }
  });
  
});
</script>