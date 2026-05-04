<?php 

include("config.php");
$db=$conn;

$date_created="";
 $individual_id=$_POST['individual_id'];
 $family_id=$_POST['family_id'];

$query="SELECT * FROM individual WHERE id='$individual_id'";
$sqlcon=mysqli_query($db,$query);
 
$individual_height=$_POST['individual_height']; 
$individual_weight=$_POST['individual_weight'];
$individual_bmi=$_POST['individual_bmi'];
$individual_systolic_value=$_POST['individual_systolic_value'];
$individual_diastolic_value=$_POST['individual_diastolic_value'];
$individual_sugar=$_POST['individual_sugar'];
$individual_urine_sugar_value=$_POST['individual_urine_sugar_value'];
$individual_urine_protien=$_POST['individual_urine_protien'];
$individual_oral_cavity=$_POST['individual_oral_cavity'];
$individual_oral_ulcer=$_POST['individual_oral_ulcer'];
$individual_oral_hygine=$_POST['individual_oral_hygine'];
$individual_heamoglobin=$_POST['individual_heamoglobin'];
$individual_health_needs=$_POST['individual_health_needs'];
$individual_action_required=$_POST['individual_action_required'];

$createdby="student";
$created_on=date('y/m/d');

echo $col ="INSERT INTO `individual_followup`(`individual_id`,`family_id`, `individual_height`, `individual_weight`, `individual_bmi`, `individual_systolic_value`, `individual_diastolic_value`, `individual_sugar`, `individual_urine_sugar_value`, `individual_urine_protien`,`individual_oral_cavity`,`individual_oral_ulcer`,`individual_oral_hygine`,`individual_heamoglobin`,`individual_health_needs`,`individual_action_required`,`created_by`,`created_on`) VALUES ('$individual_id','$family_id','$individual_height','$individual_weight','$individual_bmi','$individual_systolic_value','$individual_diastolic_value','$individual_sugar','$individual_urine_sugar_value','$individual_urine_protien','$individual_oral_cavity','$individual_oral_ulcer','$individual_oral_hygine','$individual_heamoglobin','$individual_health_needs','$individual_action_required','$createdby','$created_on')";
if(mysqli_query($db,$col))
{
echo("successfully added in individual_followup");
    
}
else{
echo("not able to add in individual_followup");
}


mysqli_close($conn);


?>

