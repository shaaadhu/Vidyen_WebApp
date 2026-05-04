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
   
    $query="SELECT * FROM family";
    $sqlcon=mysqli_query($db,$query);
    $rowfetch=mysqli_fetch_array($sqlcon);


    if ($rowfetch) {
       // echo $id;

        $rowdata="SELECT * FROM family WHERE id=$id";
        $rowcon=mysqli_query($db,$rowdata);

        while($rows=mysqli_fetch_assoc($rowcon))
        {
            ?>



        <div class="content-wrapper ">
            <div class="col-12 grid-margin">
              <div class="card">
                 <div class="text-end mt-3 p-3">
                     <?php 
                  if($user_type=='student'){
                  ?>

                      <a href="family_followup.php?id=<?php echo $id;?>" class="btn btn-primary btn-sm">Add Followup</a>
                      <a href="individual_details.php?id=<?php echo $id;?>" class="btn btn-primary btn-sm">Add Individual</a>

                      <?php } ?>
                    </div>
                <div class="card-body">
                  <form class="form-sample" id="family_register">
                    <p class="card-description">
                      Family View
                    </p>
                   
                    <div class="row">
                      <div class="col-md-6">
                          <label class="form-label"><b>Name Of Head Of The Family</b></label>
                          <input type="text" class="form-control" name="namehof" id="namehof" value="<?php echo $rows['head_of_family_name'];?>" disabled>
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>House Number</b></label>
                        <input type="text" class="form-control" name="houseno" id="houseno" value="<?php echo $rows['house_number'];?>" disabled>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Village Name</b></label>
                          <input type="text" class="form-control" name="vname" id="vname" value="<?php echo $rows['village_name'];?>" disabled>
                          <br>
                      </div>
                      <div class="col-md-6">  
                        <label class="form-label"><b>Full Address With Landmarks</b></label>
                        <input type="text" class="form-control" name="fulladd" id="fulladd" value="<?php echo $rows['full_address'];?>" disabled>   
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-6">
                            <label class="form-label"><b>Date Of Birth</b></label>
                          <input type="text" class="form-control"  value="<?php echo $rows['date_of_birth'];?>" disabled>
                          <br>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label"><b>Age</b></label>
                          <input type="number" class="form-control"  value="<?php echo $rows['age'];?>" disabled>
                          <br>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Gender</b></label>
                        <select class="form-control" name="gender" id="gender" disabled>
                              <option value=""><?php echo $rows['gender'];?></option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Others">Others</option>
                        </select> 
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Mobile Number</b></label>
                          <input type="number" class="form-control" name="mobnum" id="mobnum" value="<?php echo $rows['phone_number'];?>" disabled>
                          <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Number Of Living Rooms</b></label>
                          <input type="number" class="form-control" name="lroom" id="lroom" value="<?php echo $rows['number_of_living_room'];?>" disabled>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label"><b>Living Room Area In Sq.ft</b></label>
                        <input type="text" class="form-control" name="rarea" id="rarea" value="<?php echo $rows['living_room_area'];?>" disabled>
                        <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Number of Family members</b></label>
                             <input type="text" class="form-control" name="fmembers" id="fmembers" value="<?php echo $rows['number_of_family_members'];?>" disabled>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label class="form-label"><b>Overcrowding</b><span id="mandatory"></label>
                        <select class="form-control" name="ocrowd" id="ocrowd" disabled>
                              <option value=""><?php echo $rows['overcrowding'];?> </option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                        </select> 
                        <br>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label"><b>Aadhar Number</b></label>
                             <input type="text" class="form-control" name="adhaar" id="adhaar" value="<?php echo $rows['adhaar_number'];?>" disabled>
                      </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label"><b>Type of Ration Card</b></label>
                        <input type="text" name="" class="form-control" value="<?php echo $rows['ration_card_type'];?>" disabled>
                        <br>
                    </div>
                      
                    <div class="mt-3">
                          <label class="form-label"><b>Longitude & Lattitude</b></label>
                          <input type="number" class="form-control" name="lonlat" id="lonlat" value="<?php echo $rows['longtitude_and_latitude'];?>" disabled>
                    </div>

                    <div class="row mt-3">
                      <div class="col-md-6">
                          <label class="form-label"><b>Mobile Number Of Student</b></label>
                          <input type="number" class="form-control" name="mobnos" id="mobnos" value="<?php echo $rows['mobile_number_student'];?>" disabled>
                          <br>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label"><b>Date of follow up visits</b></label>
                        <input type="date" class="form-control" name="foldate" id="foldate" value="<?php echo $rows['follow_up_date'];?>" disabled/>
                      </div>
                    </div>

                    <div class="mt-3 text-end">
                         <!-- <a href="#" class="btn btn-primary  " data-bs-toggle="tooltip" data-bs-placement="top" title="Excel Export"><i class="fa-solid fa-file-excel"></i></a> -->
                      <a href="#" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="PDF Download"><i class="fa-solid fa-file-pdf"></i></a>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-12 grid-margin">

              <div class="card">
                  <div class="card-title pt-3 ps-3 text-primary">
                      <h3>Family Follow View</h3>

                  </div>

                  <div class="card-body">
                   
                    <div class="table-responsive mt-3">
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Family Id</th>
                                      <th>Head Of Family Name</th>
                                      <th>Phone Number</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                 <?php 
                              $db=$conn;

                              $query="SELECT * FROM family_followup WHERE family_id=$id";
                              $rowcon=mysqli_query($db,$query);
                              $i=1;
                              while ($row=mysqli_fetch_array($rowcon)) {
                                $f_id=$row['id'];

                                ?>
                                
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $rows['id'];?></td>
                                  <td><?php echo $rows['head_of_family_name'];?></td>
                                  <td><?php echo $rows['phone_number'];?></td>
                                  <td><a  class="btn btn-outline-primary" href="view_family_followup.php?id=<?php echo $row['id'];?>" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a  class="btn btn-outline-primary" href="update_family_followup.php?id=<?php echo $row['id'];?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" ><i class="fa-solid fa-pen-to-square"></i></a>
                                  <a href="#" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="PDF Download"><i class="fa-solid fa-file-pdf"></i></a></td>
                                </tr>   
                              </tbody>

                              <?php

                                    $i++; 
                                  }

                                  ?> 
                          </table>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-12 grid-margin">

              <div class="card">
                  <div class="card-title pt-3 ps-3 text-primary">
                      <h3>Family Members View</h3>

                  </div>




                  <div class="card-body">
                    <div class="table-responsive mt-3">
                          <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                              <thead class="text-center bg-primary text-white">
                                  <tr>
                                      <th>Sl.No</th>
                                      <th>Individual Id</th>
                                      <th>Individual Name</th>
                                      <th>Mobile Number</th>
                                      <th>Health Needs</th>
                                      <th>Action Required</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                 <?php 
                              $db=$conn;
                              $query="SELECT * FROM individual WHERE family_id='$id'";
                              $rowcon=mysqli_query($db,$query);
                              $i=1;
                              while ($row=mysqli_fetch_array($rowcon)) {
                                $id=$row['id'];

                                ?>
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $id;?></td>
                                  <td><?php echo $row['individual_name'];?></td>
                                  <td><?php echo $row['individual_mobile'];?></td>
                                  <td><?php echo $row['individual_health_needs'];?></td>
                                  <td><?php echo $row['individual_action_required'];?></td>
                                  <td><a  class="btn btn-outline-primary" href="view_individual.php?id=<?php echo $id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa-solid fa-eye"></i></a>
                                    <a  class="btn btn-outline-primary" href="update_individual.php?id=<?php echo $row['id'];?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" ><i class="fa-solid fa-pen-to-square"></i></a>
                                  <a href="#" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="PDF Download"><i class="fa-solid fa-file-pdf"></i></a></td>
                                </tr>   
                              </tbody>
                              <?php

                                    $i++; 
                                  }

                                  ?> 
                          </table>
                      </div>
                  </div>
              </div>
            </div>
          </div>

            <?php
           // echo "success";
            $j++;


        }
    }


}


?>

        <?php include('footer.php');?>

