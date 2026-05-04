<?php 
include("config.php");
$db=$conn;

echo $id=$_POST['id'];

$hofname=$_POST['head_of_family_name'];
echo $housenumber=$_POST['house_number']; 
$villagename=$_POST['village_name'];
$fulladd=$_POST['full_address'];
$dob=$_POST['date_of_birth'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$mobnum=$_POST['phone_number'];
echo $nofroom=$_POST['number_of_living_room'];
$roomarea=$_POST['living_room_area'];
$nofmembers=$_POST['number_of_family_members'];
$overcrowd=$_POST['overcrowding'];
echo $adhaar=$_POST['adhaar_number'];
$rationtype=$_POST['ration_card_type'];
$longlat=$_POST['longtitude_and_latitude'];
//$studentnum=$_POST['mobile_number_student'];
echo $followdate=$_POST['follow_up_date'];

$modifydate=date("d/m/y");
$modifyby="student";
//UPDATE `family` SET `id`='[value-1]',`family_id`='[value-2]',`head_of_family_name`='[value-3]',`house_number`='[value-4]',`village_name`='[value-5]',`full_address`='[value-6]',`date_of_birth`='[value-7]',`age`='[value-8]',`gender`='[value-9]',`phone_number`='[value-10]',`number_of_living_room`='[value-11]',`living_room_area`='[value-12]',`number_of_family_members`='[value-13]',`overcrowding`='[value-14]',`adhaar_number`='[value-15]',`ration_card_type`='[value-16]',`longtitude_and_latitude`='[value-17]',`student_id`='[value-18]',`follow_up_date`='[value-19]',`created_by`='[value-20]',`created_on`='[value-21]',`modified_by`='[value-22]',`modified_on`='[value-23]',`status`='[value-24]',`flag`='[value-25]' WHERE 1
echo $col ="UPDATE  `family` SET `head_of_family_name`='$hofname', `house_number`='$housenumber', `village_name`='$villagename', `full_address`='$fulladd', `date_of_birth`='$dob', `age`='$age', `gender`='$gender', `phone_number`='$mobnum', `number_of_living_room`='$nofroom', `living_room_area`='$roomarea', `number_of_family_members`='$nofmembers', `overcrowding`='$overcrowd', `adhaar_number`='$adhaar', `ration_card_type`='$rationtype', `longtitude_and_latitude`='$longlat',`follow_up_date`='$followdate', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `id`='$id'";
if(mysqli_query($db,$col))
{
	echo("successfully added in db");
}
else{
	echo("not able to add in database");
}


mysqli_close($db);

?>