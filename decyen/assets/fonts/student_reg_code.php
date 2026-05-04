<?php 
include('config.php');

$db=$conn;

	function generate_student_id(){
		global $db;
		$student_query="SELECT `student_id` FROM `student`";
		$sql_id=mysqli_query($db,$student_query);
		if(mysqli_num_rows($sql_id)<=0){
			$student_id='FA/S/100001';
		}else
		{
			while($rows=mysqli_fetch_array($sql_id)){
				$id_count=$rows['student_id'];
				if($id_count==''){
					$student_id='FA/S/100001';
				}else
				{
					$student_id=++$id_count;
				}
			}
		}
		return $student_id;
	}

	echo $student_name=$_POST['student_name'];
	echo $student_email=$_POST['student_email'];
	echo $student_user_name=$_POST['register_number'];
	echo $student_contact_number=$_POST['student_contact_number'];
	echo $college_name=$_POST['college_name'];
	echo $register_number=$_POST['register_number'];
	echo $course_name=$_POST['course_name'];
	echo $addmission_year=$_POST['addmission_year'];
	echo $student_password=md5($_POST['student_contact_number']);

	$student_id=generate_student_id();

	$createdby="admin";
	$createdon=date('y/m/d');

	$query="INSERT INTO `student`(`student_id`, `student_name`, `student_email`, `student_username`, `student_mobile_number`, `college_name`, `register_number`, `course_name`, `addmission_year`, `student_password`, `created_by`, `created_on`) VALUES ('$student_id','$student_name','$student_email','$student_user_name','$student_contact_number','$college_name','$register_number','$course_name','$addmission_year','$student_password','$createdby','$createdon')";
	
		if(mysqli_query($db,$query)){
				echo "successfully";
			}
			else{
				echo"Not able to insert";
			}


		$usertype="student";
	$query_login="INSERT INTO `login`( `user_id`, `username`, `password`, `email`, `usertype`, `created_by`, `created_on`) VALUES ('$student_id','$student_user_name','$student_password','$student_email','$usertype','$createdby','$createdon')";
	if(mysqli_query($db,$query_login)){
		echo"Successfully inserted into login";
	}else{
		echo"not inserted";
	}

	



?>