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
    
    global $db;

     $id=$_GET['id'];
    $j=1;
   
     $query="SELECT * FROM family_followup WHERE id='$id'";
    $sqlcon=mysqli_query($db,$query);
    

       while($rows=mysqli_fetch_assoc($sqlcon))
         {
          echo $family_id=$rows['family_id'];
            ?>




        <div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-title pt-3 ps-3 text-primary">
                  <h3>Family Followup View</h3>
                </div>
                <div class="card-body">
                    <p class="card-description">
                      Family information
                    </p>

                     <div class="row mt-4" id="birthdiv">
                        <div class="col-md-6">
                          <label class="form-label"><b>Birth in last 12 months</b></label>
                          <input type="text" id="bb"  class="form-control" value="<?php echo $rows['birth'];?>" disabled>
                        </div>
                        <div class="col-md-6 " id="ifsob" style="display: none;">
                          <label class="form-label"><b>Number Of Birth</b></label>
                          <input type="text"  class="form-control" value="<?php echo $rows['nofbirth'];?>" disabled>
                        <br>
                        </div>
                      </div>
                  
                        <div class="table-responsive mt-3" id="birth_table" style="display:none;">
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Date</th>
                                      <th>Name</th>
                                      <th>Gender</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $query_birth="SELECT * FROM birth_history WHERE family_id='$family_id'";
                                $sql_birth=mysqli_query($db,$query_birth);
                                $k=1;
                                while ($rows_birth=mysqli_fetch_assoc($sql_birth)) {
                                   $birth=$rows_birth['family_id'];
                                ?>
                                <tr>
                                  <td><?php echo $k; ?></td>
                                  <td><?php echo $rows_birth['cbdate']; ?></td>
                                  <td><?php echo $rows_birth['cbname']; ?></td>
                                  <td><?php echo $rows_birth['cbgender']; ?></td>
                                </tr> 
                                <?php 
                                $k++;
                                }
                                ?>  
                              </tbody>
                          </table>
                      </div>
                    
                      <div class="row mt-4 "id="deathdiv"> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Death in the family in last 12 months</b></label>
                            <input type="text" id="dd"  class="form-control" value="<?php echo $rows['death'];?>" disabled>
                        </div>
                        <div class="col-md-6 " id="ifsod" style="display: none;">
                          <label class="form-label"><b>Number Of Death</b></label>
                          <input type="text"  class="form-control" value="<?php echo $rows['nofdeath'];?>" disabled>
                        <br>
                        </div>
                      </div>
                 
                       <div class="table-responsive mt-3" id="death_table" style="display: none;">
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Date</th>
                                      <th>Name</th>
                                      <th>Age</th>
                                      <th>Gender</th>
                                      <th>Cause Of Death</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php 
                                 $death_query="SELECT * FROM death_history WHERE family_id='$family_id'";
                                $sql_death=mysqli_query($db,$death_query);
                                $n=1;
                                while ($rows_death=mysqli_fetch_assoc($sql_death)) {
                                    $death=$rows_death['family_id'];
                                ?>
                                
                                <tr>
                                  <td><?php echo $n;?></td>
                                  <td><?php echo $rows_death['ddate'];?></td>
                                  <td><?php echo $rows_death['dname'];?></td>
                                  <td><?php echo $rows_death['dage'];?></td>
                                  <td><?php echo $rows_death['dgender'];?></td>
                                  <td><?php echo $rows_death['dcause'];?></td>
                                </tr> 
                                <?php  
                                $n++;
                              }
                                ?>  
                              </tbody>
                          </table>
                      </div>

                      <div class="row mt-4 "id="marrydiv"> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Marriage in the family in last 12 months</b></label>
                            <input type="text" id="marry"  class="form-control" value="<?php echo $rows['marriage'];?>" disabled>
                        </div>
                        <div class="col-md-6 " id="ifsom" style="display: none;">
                          <label class="form-label"><b>Number Of Marriage</b></label>
                          <input type="text"  class="form-control" value="<?php echo $rows['nofmarry'];?>" disabled>
                        <br>
                        </div>
                      </div>
                      <div class="table-responsive mt-3" id="marry_table" style="display: none;">
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Name</th>
                                      <th>Age</th>
                                      <th>Gender</th>
                                      <th>Relation With HOF</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php 
                                 $query_marriage="SELECT * FROM marriage_history WHERE family_id='$family_id'";
                                $sql_marriage=mysqli_query($db,$query_marriage);
                                $m=1;
                                while ($rows_marriage=mysqli_fetch_assoc($sql_marriage)) {
                                    $marriage=$rows_marriage['family_id'];
                                ?>
                                <tr>
                                  <td><?php echo $m;?></td>
                                  <td><?php echo $rows_marriage['marryname'];?></td>
                                  <td><?php echo $rows_marriage['marryage'];?></td>
                                  <td><?php echo $rows_marriage['marrygender'];?></td>
                                  <td><?php echo $rows_marriage['marryrel'];?></td>
                                </tr> 
                                <?php 
                                $m++;
                                }
                                ?>  
                              </tbody>
                          </table>
                      </div>
                   
 
                    <div class="mt-4">
                          <label class="form-label"><b>Health Problems Reported By The Family Members</b></label>
                          <input type="text" class="form-control" name="fprob" id="fprob" value="<?php echo $rows['family_health_problem'];?>"disabled />
                    </div>

                    <div class="row mt-4 "> 
                        <div class="col-md-6">
                            <label class="form-label"><b>Health Care Utilization</b></label>
                            <input type="text" id="huti"  class="form-control" value="yes" disabled>
                        </div>
                        <div class="col-md-6" id="ifhealth" style="display:none;">
                            <label class="form-label"><b>Name Of Health Care</b></label>
                            <input type="text" class="form-control" name="" value="<?php echo $rows['healthcare'];?>" disabled>
                        </div>
                      </div>

                      <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Direct Cost</b> ( Cost Of Treatment, Medicines, OPD,IPD,Etc) INR</label>
                          <input type="text" class="form-control" value="<?php echo $rows['direct_cost'];?>" disabled />
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Indirect Cost</b>( Travel, Loss Of Wages, Etc) INR</label>
                        <input type="text" class="form-control" value="<?php echo $rows['indirect_cost'];?>" disabled />
                      </div>
                    </div>
                    <?php 
                    
                    ?>
                    <div class="mt-3">
                          <label class="form-label"><b>Social Security Scheme </b></span></label>
                          <input type="text" class="form-control" value="<?php echo $rows['scheme'];?>" disabled />
                    </div>

                    <div class="row mt-4 "> 
                      <?php if($rows['what_action_taken'] == '') { ?>
                        <div class="col-md-6">
                            <label class="form-label"><b>Have the family members approached you?</b></label>
                            <input type="text" class="form-control" id="app" value="No" disabled>
                        </div>
                        <?php } else if ($rows['what_action_taken'] != '') {?>
                          <div class="col-md-6">
                            <label class="form-label"><b>Have the family members approached you?</b></label>
                            <input type="text" class="form-control" id="app" value="Yes" disabled>
                        </div>
                        <div class="col-md-6" id="ifapproach">
                            <label class="form-label"><b>Action Taken</b></label>
                            <input type="text" class="form-control" value="<?php echo $rows['what_action_taken'];?>" disabled />
                        </div>
                      <?php } ?>
                      </div>

                      
                        
                        <div class="mt-3">
                          <label class="form-label"><b>Other Observation</b></label>
                          <input type="text" class="form-control" value="<?php echo $rows['observation'];?>" disabled />
                        </div>

                    <div class="mt-3">
                          <label class="form-label"><b>Date Of Visit</b></label>
                          <input type="text"  class="form-control" value="<?php echo $rows['date_of_visit'];?>" disabled />
                    </div>

                    <div class="mt-3 text-end">
                         
                      <a href="#" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="PDF Download"><i class="fa-solid fa-file-pdf"></i></a>
                    </div>

                </div>
              </div>
            </div>
          </div>

          <?php
      //  }
          }
        }

include('footer.php');?>
        <script type="text/javascript">
    

          if($("#bb").val()=='yes'){
             $("#ifsob").show();
             $("#birth_table").show();
          }
             
        else{
          $("#ifsob").hide();
          $("#birth_table").hide();
        }

        if($("#dd").val()=='yes'){
             $("#ifsod").show();
             $("#death_table").show();
          }
             
        else{
          $("#ifsod").hide();
          $("#death_table").hide();
        }
         if($("#marry").val()=='yes'){
             $("#ifsom").show();
             $("#marry_table").show();
          }
             
        else{
          $("#ifsom").hide();
          $("#marry_table").hide();
        }

        if($("#huti").val()=='yes'){
             $("#ifhealth").show();
            
          }
             
        else{
          $("#ifhealth").hide();
          
        }

        
            </script>