<?php 


include("config.php");
$db=$conn;

	function generate_individual_code(){
		global $db;
		$query="SELECT * FROM individual";
		$sqlcon=mysqli_query($db,$query);
		if(mysqli_num_rows($sqlcon)<=0){
			$individual_id='FA/I/100001';
		}
		else{
			while($row=mysqli_fetch_array($sqlcon)){
				$count=$row['individual_id'];
				if($count=''){
					$individual_id='FA/I/100001';
				}else{
					$individual_id=++$count;
				}
			}
		}
		return $individual_id;
	}


	$individual_code=generate_individual_code();
	echo $family_id=$_POST['family_id'];	
	$individual_name=$_POST['individual_name'];
	$individual_gender=$_POST['individual_gender'];
	$individual_mobile=$_POST['individual_mobile']; 
	$individual_adhaar=$_POST['individual_adhaar']; 
	$individual_date_of_birth=$_POST['individual_date_of_birth'];
	$individual_age=$_POST['individual_age'];
	$individual_bloodgroup=$_POST['individual_bloodgroup'];
	$individual_education=$_POST['individual_education'];
	$individual_occupation=$_POST['individual_occupation'];
	$individual_relation_with_head=$_POST['individual_relation_with_head'];
	$individual_student=$_POST['individual_student'];
	$underfive_yes_no=$_POST['underfive_yes_no'];
	$immunization=$_POST['immunization']; 
	$individual_alcohol_usage=$_POST['individual_alcohol_usage'];
	$individual_tobacco_usage=$_POST['individual_tobacco_usage'];
	$individual_diet=$_POST['individual_diet'];
	$individual_chronic_illness=$_POST['individual_chronic_illness'];
	$individual_acute_illness=$_POST['individual_acute_illness'];
	$individual_flu_illness=$_POST['individual_flu_illness'];
	$individual_maleria=$_POST['individual_maleria'];
	$individual_dengue=$_POST['individual_dengue'];
	$individual_tuberculosis=$_POST['individual_tuberculosis'];
	$known_hypertension=$_POST['known_hypertension'];
	$known_dm=$_POST['known_dm'];
	$teeth_related_questions=$_POST['teeth_related_questions'];
	$individual_clean_teeth=$_POST['individual_clean_teeth'];
	$individual_teeth_other=$_POST['individual_teeth_other'];
	$individual_clean_day=$_POST['individual_clean_day'];
	$individual_material_for_clean=$_POST['individual_material_for_clean'];
	$individual_paste_kind=$_POST['individual_paste_kind'];
	$individual_change_brush=$_POST['individual_change_brush'];
	$individual_oral_hygine_aids=implode(',' ,$_POST['individual_oral_hygine_aids']);
	$individual_mouth_problem=$_POST['individual_mouth_problem'];
	$individual_mouth_check=implode(',' ,$_POST['individual_mouth_check']);
	$individual_transport_dental=$_POST['individual_transport_dental'];
	$individual_major_factor=implode(',' ,$_POST['individual_major_factor']);
	$individual_health_needs=$_POST['individual_health_needs'];
	$individual_action_required=$_POST['individual_action_required'];
   $createdby="student";
$created_on=date('y/m/d');
	
$col ="INSERT INTO `individual`(`individual_code`,`family_id`,`individual_name`, `individual_gender`, `individual_mobile`, `individual_adhaar`, `individual_date_of_birth`, `individual_age`, `individual_bloodgroup`, `individual_education`, `individual_occupation`, `individual_relation_with_head`,  `individual_student` , `underfive_yes_no`, `immunization`, `individual_alcohol_usage`, `individual_tobacco_usage`, `individual_diet`, `individual_chronic_illness`, `individual_acute_illness`, `individual_flu_illness`, `individual_maleria`, `individual_dengue`, `individual_tuberculosis`, `known_hypertension`, `known_dm`, `teeth_related_questions`, `individual_clean_teeth`, `individual_teeth_other`, `individual_clean_day`, `individual_material_for_clean`, `individual_paste_kind`, `individual_change_brush`, `individual_oral_hygine_aids`, `individual_mouth_problem`, `individual_mouth_check`, `individual_transport_dental`, `individual_major_factor`, `individual_health_needs`, `individual_action_required`) VALUES('$individual_code','$family_id','$individual_name','$individual_gender','$individual_mobile','$individual_adhaar','$individual_date_of_birth','$individual_age','$individual_bloodgroup','$individual_education','$individual_occupation','$individual_relation_with_head','$individual_student','$underfive_yes_no','$immunization','$individual_alcohol_usage','$individual_tobacco_usage','$individual_diet','$individual_chronic_illness','$individual_acute_illness','$individual_flu_illness','$individual_maleria','$individual_dengue','$individual_tuberculosis','$known_hypertension','$known_dm','$teeth_related_questions','$individual_clean_teeth','$individual_teeth_other','$individual_clean_day','$individual_material_for_clean','$individual_paste_kind','$individual_change_brush','$individual_oral_hygine_aids','$individual_mouth_problem','$individual_mouth_check','$individual_transport_dental','$individual_major_factor','$individual_health_needs','$individual_action_required')";
if(mysqli_query($db,$col))
{
   $individual_insert_id = mysqli_insert_id($db);
	if($individual_student=='yes'){
         $insitution_name=$_POST['insitution_name'];
         $standard_semester=$_POST['standard_semester'];
            $studsql="INSERT INTO `study_history`( `individual_id`, `family_id`, `insitution_name`, `standard_semester`, `created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$insitution_name','$standard_semester','$createdby','$created_on')";
            if (mysqli_query($db,$studsql)) {
                echo "successfully inserted into study history";
            }else{
                echo"not able to insert into study history "; 
            }
        }
	echo("successfully added in db");
}
else{
	echo("not able to add in database");
}


if($underfive_yes_no=="yes"){
    echo "yes submit vaccines list";

$query_vaccine="SELECT * FROM vaccination";
$sql_vaccine=mysqli_query($db,$query_vaccine);
 $number_rows=mysqli_num_rows($sql_vaccine);
for($i=1;$i<=$number_rows;$i++){
   $vaccine_id=$i;
  if($vaccine_id==1){
     $vaccine_value=$_POST['bcg'];
   echo $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not inserting";
   }


  }
  if($vaccine_id==2){
    echo"dgdg";
     $vaccine_value=$_POST['hepatitis'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value`,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
    if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not inserting";
   }
  }


   if($vaccine_id==3){
     $vaccine_value=$_POST['opv'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }


  if($vaccine_id==4){
     $vaccine_value=$_POST['pentavalent1'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==5){
     $vaccine_value=$_POST['opv1'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

if($vaccine_id==6){
     $vaccine_value=$_POST['ipv1'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==7){
     $vaccine_value=$_POST['rotavirus1'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==8){
     $vaccine_value=$_POST['pcv1'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==9){
     $vaccine_value=$_POST['pentavalent2'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==10){
     $vaccine_value=$_POST['opv2'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==11){
     $vaccine_value=$_POST['rotavirus2'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==12){
     $vaccine_value=$_POST['pentavalent3'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==13){
     $vaccine_value=$_POST['opv3'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==14){
     $vaccine_value=$_POST['ipv2'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==15){
     $vaccine_value=$_POST['rotavirus3'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==16){
     $vaccine_value=$_POST['pcv2'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==17){
     $vaccine_value=$_POST['mr1'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==18){
     $vaccine_value=$_POST['pcvbooster'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==19){
     $vaccine_value=$_POST['vitamina'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==20){
     $vaccine_value=$_POST['dptbooster1'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==21){
     $vaccine_value=$_POST['opvbooster'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==22){
     $vaccine_value=$_POST['mr2'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }

  if($vaccine_id==23){
     $vaccine_value=$_POST['dptbooster2'];
    $vaccine_query="INSERT INTO `vaccination_history`( `individual_id`, `family_id`, `vaccination_id`, `vaccination_value` ,`created_by`, `created_on`) VALUES ('$individual_insert_id','$family_id','$vaccine_id','$vaccine_value','$createdby','$created_on')";
   if(mysqli_query($db,$vaccine_query)){
    echo"Successfully";
   }
   else
   {
    echo"not iserting";
   }


  }



}



}

mysqli_close($db);


?>