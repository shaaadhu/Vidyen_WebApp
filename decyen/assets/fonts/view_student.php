<?php include('header.php');
include('config.php');

?>
<div class="content-wrapper">

                  
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">View Mentors</h1>
                        <a href="add_mentor.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Add New mentor</a>
                       
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View Mentor Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile_number</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                     <tbody>
                                <?php 

                                    $db=$conn;
                                    $query="SELECT * FROM student ";
                                    $rowcon=mysqli_query($db,$query);
                                    $i=1;
                                    while($rows=mysqli_fetch_array($rowcon)){
                                         $id=$rows['id'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i;?>
                                            </td>
                                            <td><?php echo $rows['student_id'];?></td>

                                            <td><?php echo $rows['student_name'];?></td>
                                            <td><?php echo $rows['student_email'];?></td>
                                            <td><?php echo $rows['student_mobile_number'];?></td>
                                            <!-- <td><button class="btn btn-outline-primary" onclick="edit_user(this.getAttribute('data-id'))" id="edit_user" name="edit_user"data-bs-toggle="modal" data-bs-target="#modal_user" data-id="<?php echo $rows['id'];?>"  method="GET">Edit</button>
                                                <a class="btn btn-danger" href="delete_user.php?id=<?php echo $rows['id'];?>">delete</a>
                                            </td> -->


                                        </tr>
                                    </tbody>
                                   
                                    <div class="modal fade" id="modal_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg text-black">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title  ms-auto me-auto" id="exampleModalLabel">View User</h5>
                                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                        </div>
                                        <div class="modal-body" id="modal_view_user">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <?php
                               

                                    $i++;
                                    }
                                       

                                ?>                          

                                       
                                           
                                     
                                    

                                </table>
                            </div>
                        </div>
                    </div>
</div>
<?php include('footer.php');?>

<style type="text/css">
   
.form-select-lg {
    padding-top: .5rem;
    padding-bottom: .5rem;
    padding-left: 1rem;
    font-size: 1.25rem;
}
</style>
