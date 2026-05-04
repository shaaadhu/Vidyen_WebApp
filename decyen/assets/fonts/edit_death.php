<?php 
include('config.php');
$db=$conn;
        if(isset($_GET['id'])){

          $id=$_GET['id'];
          $query="SELECT * FROM death_history WHERE id='$id'";
          $sqlcon=mysqli_query($db,$query);
          while($rows_death=mysqli_fetch_assoc($sqlcon)){
          ?>
          
                                      <div class="row ">
                                        <div class="col-md-4">
                                          <input type="hidden" value="<?php echo $rows_death['id'];?>">
                                          <label class="form-label">Date</label>
                                          <input type="date" class="form-control" name="ddate" id="ddate" value="<?php echo $rows_death['ddate'];?>">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Name</label>
                                          <input type="text" class="form-control" name="dname" id="dname" value="<?php echo $rows_death['dname'];?>">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Age</label>
                                          <input type="text" class="form-control" name="dage" id="dage" value="<?php echo $rows_death['dage'];?>">
                                        </div>
                                      </div>
                                      <div class="row mt-3">
                                        <div class="col-md-6">
                                          <label class="form-label">Gender</label>
                                          <select class="form-control form-control-sm" name="dgender" id="dgender">
                                          <option value="0">Choose Gender</option>
                                          <option value="male"<?php if($rows_death['dgender']=='male') echo 'selected'; ?>>Male</option>
                                          <option value="female"<?php if($rows_death['dgender']=='female') echo 'selected'; ?>>Female</option>
                                          <option value="others"<?php if($rows_death['dgender']=='others') echo 'selected'; ?>>Others</option>
                                          </select>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="form-label">Cause Of Death</label>
                                          <input type="text" class="form-control" name="dcause" id="dcause" value="<?php echo $rows_death['dcause'];?>">
                                        </div>
                                      </div>    
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" id="close_death" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" id="update_death" data-id="<?php echo $rows_death['id'];?>" >Save</button>
                                    </div>
                                   
                                    <?php
                                  }

      }

     ?>
     <script type="text/javascript">
        var closebtn=document.getElementById('close_birth');
        closebtn.onclick=function() {
        location.reload();
    }
     </script>