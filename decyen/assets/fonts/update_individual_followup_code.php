<?php 
include("config.php");
$db=$conn;

echo $id=$_POST['individual_id'];

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


$modifydate=date("d/m/y");
$modifyby="student";

echo $col ="UPDATE  `individual_followup` SET `individual_height`='$individual_height', `individual_weight`='$individual_weight', `individual_bmi`='$individual_bmi', `individual_systolic_value`='$individual_systolic_value', `individual_diastolic_value`='$individual_diastolic_value', `individual_sugar`='$individual_sugar', `individual_urine_sugar_value`='$individual_urine_sugar_value', `individual_urine_protien`='$individual_urine_protien', `individual_oral_cavity`='$individual_oral_cavity', `individual_oral_ulcer`='$individual_oral_ulcer', `individual_oral_hygine`='$individual_oral_hygine', `individual_heamoglobin`='$individual_heamoglobin', `individual_health_needs`='$individual_health_needs', `individual_action_required`='$individual_action_required', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `id`='$id'";
if(mysqli_query($db,$col))
{
    echo("successfully added in db");
}
else{
    echo("not able to add in database");
}


mysqli_close($db);

?>