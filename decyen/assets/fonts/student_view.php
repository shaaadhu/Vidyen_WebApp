<?php
session_start();
if (isset($_SESSION['user_id'] ) && ($_SESSION['usertype'] == '') || ( $_SESSION['usertype'] == '') ){
  header('location:login.php');

}
else{


include('header.php');
include ('config.php');
	$user_type = $_SESSION['usertype'];

  $userid=$_SESSION['user_id'];
 $username=$_SESSION['username'];
  $db=$conn;
  if(isset ($_GET['id'])){
  	$id=$_GET['id'];
  	$query="SELECT * FROM student WHERE student_id='$id'";
  $sql=mysqli_query($db,$query);
  while($row=mysqli_fetch_assoc($sql)){
   	$id=$row['id'];

  }
  }
  $query="SELECT * FROM student WHERE student_id='$userid'";
  $sql=mysqli_query($db,$query);
  while($row=mysqli_fetch_assoc($sql)){
  	$id=$row['id'];

  }
?>

<div class="content-wrapper ">
            <div class="col-12 grid-margin">

            	<div class="card">
                	<div class="card-title pt-3 ps-3 text-primary">
                  		<h3>Family View</h3>

                	</div>

	                <div class="card-body">
	                	<div class="text-end">
	                		<?php 

	                		if ($_SESSION['usertype'] == 'student'){ 

	                				$query_check="SELECT * FROM family WHERE student_id='$id'";
                              $rowcheck=mysqli_query($db,$query_check);
                               $number=mysqli_num_rows($rowcheck);
                              if($number<5){
                              	echo $number."/5";
                              
                              
	                			?>

	                		<a href="family_register.php?id=<?php echo $id;?>" class=" btn btn-primary btn-sm"><i class="fas fa-add fa-sm text-white"></i>&nbsp;Create</a>
	                		<?php 
	                		}
                              else{
                              	echo $number."/5";
                              	//echo"family created limit crossed";

                              }
	                	}
	                		?>
	                	</div>
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

                              $query="SELECT * FROM family WHERE student_id='$id'";
                              $rowcon=mysqli_query($db,$query);
                              $i=1;
                              while ($row=mysqli_fetch_assoc($rowcon)) {
                                $id=$row['id'];

                                ?>

	                           		<tr>
	                           			<td><?php echo $i;?></td>
	                           			<td><?php echo $id;?></td>
	                           			<td><?php echo $row['head_of_family_name'];?></td>
	                           			<td><?php echo $row['phone_number'];?></td>
	                           			<td><a  class="btn btn-outline-primary" href="view_family.php?id=<?php echo $id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="View" ><i class="fa-solid fa-eye"></i></a>
	                           				<a  class="btn btn-outline-primary" href="update_family.php?id=<?php echo $id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" ><i class="fa-solid fa-pen-to-square"></i></a>
	                           			<a href="#" class="btn btn-outline-success  " data-bs-toggle="tooltip" data-bs-placement="top" title="Excel Export"><i class="fa-solid fa-file-excel"></i></a>
                      						<a href="excel.php?id=<?php echo $id;?>" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="PDF Download"><i class="fa-solid fa-file-pdf"></i></a></td>
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
}
include('footer.php');?>