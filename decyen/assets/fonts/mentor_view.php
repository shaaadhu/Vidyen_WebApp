<?php 
session_start();
if (isset($_SESSION['user_id'] ) && ($_SESSION['usertype']!= 'mentor') || ( $_SESSION['usertype'] == '') ){
  header('location:login.php');

}
else{
  include('header.php');
  include('config.php');
  $db=$conn;

  $userid=$_SESSION['user_id'];
   $user_type = $_SESSION['usertype']; 
// $userid=$_SESSION['user_id'];
	//$mentor_id=$rows_mentor['id'];
$mentor_id="";
$query_mentor="SELECT * FROM mentor WHERE mentor_id='$userid'";
$sqlcon_mentor=mysqli_query($db,$query_mentor);
while ($rows_mentor=mysqli_fetch_assoc($sqlcon_mentor)){
	 $mentor_id=$rows_mentor['id'];
}
?>


<div class="content-wrapper ">
            <div class="col-12 grid-margin">
            	<div class="card">
                	<div class="card-title pt-3 ps-3 text-primary">
                  		<h3>Student View</h3>
                	</div>
	                <div class="card-body">
	                	<div class="table-responsive">
	                        <table class="table table-bordered dt" id="dataTable" width="100%" cellspacing="0">
	                            <thead class="text-center bg-primary text-white">
	                                <tr>
	                                    <th>Sl.No</th>
	                                    <th>Student Name</th>
	                                    <th>Batch</th>
	                                    <th>Roll Number</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                             <tbody>
	                           <?php 
	                           $query="SELECT * FROM `student` WHERE mentor_id='$mentor_id'";
	                           $sql=mysqli_query($db,$query);
	                           $i=1;
	                           while($rows=mysqli_fetch_assoc($sql)){
	                           	 $id=$rows['student_id'];
	                           	 $student_name=$rows['student_name'];
	                           	?>


	                           		<tr>
	                           			<td><?php echo $i;?></td>
	                           			<td><?php echo $student_name;?></td>
	                           			<td><?php echo $rows['addmission_year'];?></td>
	                           			<td><?php echo $rows['register_number'];?></td>
	                           			<td><a href="student_view.php?id=<?php echo $id;?>">View</a></td>
	                           		</tr>

	                           <?php 
	                           $i++;
	                           }

	                           ?>
	                                    		
	                            </tbody> 
	                        </table>
	                    </div>
	                </div>
            	</div>
            </div>
          </div>


<?php }
include('footer.php');?>