<?php include('header.php');?>

<script>
         function nextPage() {
            window.history.next()
         }
</script>
  
        <div class="content-wrapper">
             <div class="row">
             <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Add Role</h4>
        
                  <form id="roleform" method="POST">
                            <div class="row mt-5">
                                <div class="col-lg-3 text-end">
                                    <label class="form-label">Role</label>
                                </div>
                                <div class="col-lg-9">
                                   <input type="text" name="role" id="role" class="form-control form-select-lg " required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-3 text-end">
                                    <label class="form-label">Description</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="role_description" id="role_description" class="form-control form-select-lg " required>
                                </div>
                            </div>
                      
                      <div class="text-center mt-5">
                        <button class="btn btn-primary  text-center" type="submit" id="sub_role" name="sub_role" method="POST"onclick="insertrole()">Submit</button>
                        <button class="btn btn-outline-danger" type="reset" id="cancel_role">Cancel</button>
                      </div>
                  </form>
                </div>
              </div>
          </div>                       
    </div>
</div>
 
<?php include('footer.php');?>
<script type="text/javascript" src="js/add_role.js"></script>
<style type="text/css">
   
.form-select-lg {
    padding-top: .5rem;
    padding-bottom: .5rem;
    padding-left: 1rem;
    font-size: 1.25rem;
}
.error{
            color: red;
            /*font-style: italic;*/
            font-size:inherit;
            width: 100%;
            padding-top: .5rem;
            padding-bottom: .5rem;
            padding-left: 1rem;
            font-size: 1.25rem;
}
</style>
















