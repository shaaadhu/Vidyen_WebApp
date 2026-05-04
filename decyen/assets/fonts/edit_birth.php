<?php 
include('config.php');
$db=$conn;
        if(isset($_GET['id'])){

          $id=$_GET['id'];
          $query="SELECT * FROM birth_history WHERE id='$id'";
          $sqlcon=mysqli_query($db,$query);
          while($rows_birth=mysqli_fetch_assoc($sqlcon)){
          ?>
          
                                      <div class="row">
                                        <div class="col-md-4">
                                          <input type="hidden" value="<?php echo $rows_birth['id'];?>">
                                          <label class="form-label">Date</label>
                                          <input type="date" class="form-control" name="cbdate" id="cbdate" value="<?php echo $rows_birth['cbdate'];?>">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Name</label>
                                          <input type="text" class="form-control" name="cbname" id="cbname" value="<?php echo $rows_birth['cbname'];?>">
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Gender</label>
                                          <select class="form-control form-control" name="cbgender" id="cbgender">
                                          <option value="0">Choose Gender</option>
                                          <option value="male"<?php if($rows_birth['cbgender']=='male') echo 'selected'; ?>>Male</option>
                                          <option value="female"<?php if($rows_birth['cbgender']=='female') echo 'selected'; ?>>Female</option>
                                          <option value="others"<?php if($rows_birth['cbgender']=='others') echo 'selected'; ?>>Others</option>
                                          </select>
                                        </div>
                                      </div> 
                                    
                                      <div class="modal-footer mt-3">
                                        <button type="button" id="close_birth" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="update_birth" data-id="<?php echo $rows_birth['id'];?>" >Save</button>
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