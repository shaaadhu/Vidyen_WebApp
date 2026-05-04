<?php 
include('config.php');
$db=$conn;
function generate_mentor_id(){
	global $db;
	$query="SELECT `mentor_id` FROM `mentor`";
	$sqlcon=mysqli_query($db,$query);
	if(mysqli_num_rows($sqlcon)<=0){
		$mentor_id='FA/M/100001';

	}
	else
	{
		while($row=mysqli_fetch_array($sqlcon)){
			$id_count=$row['mentor_id'];
			if($id_count==''){
				$mentor_id='FA/M/100001';

			}else
			{
				$mentor_id=++$id_count;
			}

		}
	}
	return $mentor_id;

}

	echo $mentor_name=$_POST['mentor_name'];
	echo $mentor_email=$_POST['mentor_email'];
	echo $mentor_contact_number=$_POST['mentor_contact_number'];
	echo $mentor_department=$_POST['mentor_department'];
	echo $mentor_designation=$_POST['mentor_designation'];
	echo $mentor_date_of_joining=$_POST['mentor_date_of_joining'];
	echo $mentor_employ_id=$_POST['mentor_employ_id'];
	echo $mentor_role=$_POST['mentor_role'];
	echo $mentor_user=$_POST['mentor_employ_id'];
	echo $mentor_passwd=md5($_POST['mentor_contact_number']);
	$mentor_id=generate_mentor_id();

	$createdby="admin";
	$createdon=date('y/m/d');

	$col="INSERT INTO `mentor`(`mentor_id`, `mentor_name`, `mentor_email`, `mentor_mobile_number`, `mentor_department`, `mentor_designation`, `mentor_date_of_join`, `mentor_employee_id`, `mentor_role`, `mentor_username`, `mentor_password`, `created_by`, `created_on`) VALUES ('$mentor_id','$mentor_name','$mentor_email','$mentor_contact_number','$mentor_department','$mentor_designation','$mentor_date_of_joining','$mentor_employ_id','$mentor_role','$mentor_user','$mentor_passwd','$createdby','$createdon')";
	if(mysqli_query($db,$col)){
		echo "successfully";
	}else{
		echo "Not successfull";
	}
	$usertype="mentor";
    $query_login="INSERT INTO `login`( `user_id`, `username`, `password`, `email`, `usertype`, `created_by`, `created_on`) VALUES ('$mentor_id','$mentor_user','$mentor_passwd','$mentor_email','$usertype','$createdby','$createdon')";
    if(mysqli_query($db,$query_login)){
        echo"Successfully inserted into login";
    }else{
        echo"not inserted";
    }
?>