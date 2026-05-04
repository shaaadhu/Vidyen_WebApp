<?php 

// include("config.php");

// 	$hofname=$_POST['head_of_family_name'];
// 	$housenumber=$_POST['house_number']; 
// 	$villagename=$_POST['village_name'];
// 	$fulladd=$_POST['full_address'];
// 	$dob=$_POST['date_of_birth'];
// 	$age=$_POST['age'];
// 	$gender=$_POST['gender'];
// 	$mobnum=$_POST['phone_number'];
// 	$nofroom=$_POST['number_of_living_room'];
// 	$roomarea=$_POST['living_room_area'];
// 	$nofmembers=$_POST['number_of_family_members'];
// 	$overcrowd=$_POST['overcrowding'];
// 	$adhaar=$_POST['adhaar_number'];
// 	$rationtype=$_POST['ration_card_type'];
// 	$longlat=$_POST['longtitude_and_latitude'];
// 	$studentnum=$_POST['mobile_number_student'];
// 	$followdate=$_POST['follow_up_date'];
	
	
// $col ="INSERT INTO `family`(`head_of_family_name`, `house_number`, `village_name`, `full_address`, `date_of_birth`, `age`, `gender`, `phone_number`, `number_of_living_room`, `living_room_area`, `number_of_family_members`, `overcrowding`, `adhaar_number`, `ration_card_type`, `longtitude_and_latitude`, `mobile_number_student`,`follow_up_date`) VALUES('$hofname','$housenumber','$villagename','$fulladd','$dob','$age','$gender','$mobnum','$nofroom','$roomarea','$nofmembers','$overcrowd','$adhaar','$rationtype','$longlat','$studentnum','$followdate')";
// if(mysqli_query($conn,$col))
// {
// 	echo("successfully added in db");
// }
// else{
// 	echo("not able to add in database");
// }


// mysqli_close($conn);

include("config.php");
$db=$conn;

function generate_family_id(){
	global $db;
	$query="SELECT `family_id` FROM `family`";
	$sqlcon=mysqli_query($db,$query);
	if(mysqli_num_rows($sqlcon)<=0){
		$family_id='FA/F/100001';
	}
	else
	{
		while($row=mysqli_fetch_array($sqlcon)){
			$id_count=$row['family_id'];
			if($id_count==''){
				$family_id='FA/F/100001';

			}else
			{
				$family_id=++$id_count;
			}

		}
	}
	return $family_id;

}
	echo $family_id=generate_family_id();
	echo $student_id=$_POST['student_id'];
	 $hofname=$_POST['head_of_family_name'];
	 $housenumber=$_POST['house_number']; 
	 $villagename=$_POST['village_name'];
	 $fulladd=$_POST['full_address'];
	 $dob=$_POST['date_of_birth'];
	 $age=$_POST['age'];
	 $gender=$_POST['gender'];
	$mobnum=$_POST['phone_number'];
	$nofroom=$_POST['number_of_living_room'];
	 $roomarea=$_POST['living_room_area'];
	 $nofmembers=$_POST['number_of_family_members'];
	 $overcrowd=$_POST['overcrowding'];
	 $adhaar=$_POST['adhaar_number'];
	 $rationtype=$_POST['ration_card_type'];
	 $longlat=$_POST['longtitude_and_latitude'];
	 $studentnum=$_POST['mobile_number_student'];
	 $followdate=$_POST['follow_up_date'];
	  echo	$createdby="student";
	$createdon=date('y/m/d');

	
	 
$col ="INSERT INTO `family`(`family_id`,`head_of_family_name`, `house_number`, `village_name`, `full_address`, `date_of_birth`, `age`, `gender`, `phone_number`, `number_of_living_room`, `living_room_area`, `number_of_family_members`, `overcrowding`, `adhaar_number`, `ration_card_type`, `longtitude_and_latitude`, `student_id`,`follow_up_date`, `created_by`, `created_on`) VALUES('$family_id','$hofname','$housenumber','$villagename','$fulladd','$dob','$age','$gender','$mobnum','$nofroom','$roomarea','$nofmembers','$overcrowd','$adhaar','$rationtype','$longlat','$student_id','$followdate','$createdby','$createdon')";
if(mysqli_query($db,$col))
{
	echo("successfully added in db");
}
else{
	echo("not able to add in database");
}


mysqli_close($db);

?>
?>
