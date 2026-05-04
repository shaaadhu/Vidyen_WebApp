<?php 
include("config.php");
$db=$conn;

	 $id=$_POST['individual_id'];

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

   	$modifyby="student";
	$modifydate=date('y/m/d');


	 $col ="UPDATE  `individual` SET `individual_name`='$individual_name', `individual_gender`='$individual_gender', `individual_mobile`='$individual_mobile', `individual_adhaar`='$individual_adhaar', `individual_date_of_birth`='$individual_date_of_birth', `individual_age`='$individual_age', `individual_bloodgroup`='$individual_bloodgroup', `individual_education`='$individual_education', `individual_occupation`='$individual_occupation', `individual_relation_with_head`='$individual_relation_with_head', `individual_student`='$individual_student', `underfive_yes_no`='$underfive_yes_no', `immunization`='$immunization', `individual_alcohol_usage`='$individual_alcohol_usage', `individual_tobacco_usage`='$individual_tobacco_usage',`individual_diet`='$individual_diet', `individual_chronic_illness`='$individual_chronic_illness', `individual_acute_illness`='$individual_acute_illness', `individual_flu_illness`='$individual_flu_illness', `individual_maleria`='$individual_maleria', `individual_dengue`='$individual_dengue', `individual_tuberculosis`='$individual_tuberculosis', `known_hypertension`='$known_hypertension', `known_dm`='$known_dm', `teeth_related_questions`='$teeth_related_questions', `individual_clean_teeth`='$individual_clean_teeth', `individual_teeth_other`='$individual_teeth_other', `individual_clean_day`='$individual_clean_day', `individual_material_for_clean`='$individual_material_for_clean', `individual_paste_kind`='$individual_paste_kind', `individual_change_brush`='$individual_change_brush', `individual_oral_hygine_aids`='$individual_oral_hygine_aids', `individual_mouth_problem`='$individual_mouth_problem', `individual_mouth_check`='$individual_mouth_check', `individual_transport_dental`='$individual_transport_dental', `individual_major_factor`='$individual_major_factor', `individual_health_needs`='$individual_health_needs', `individual_action_required`='$individual_action_required', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `id`='$id'";


if(mysqli_query($db,$col))
{
	
	if($individual_student=='yes'){
         $insitution_name=$_POST['insitution_name'];
         $standard_semester=$_POST['standard_semester'];
            $studsql="UPDATE `study_history` SET `insitution_name`='$insitution_name', `standard_semester`='$standard_semester', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id'";
            if (mysqli_query($db,$studsql)) {
                echo "successfully inserted into study history";
            }else{
                echo"not able to insert into study history "; 
            }
        }
       else{
       		$studsql="UPDATE `study_history` SET `insitution_name`='NA', `standard_semester`='NA', `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id'";
       		if (mysqli_query($db,$studsql)) {
                echo "successfully inserted into study history";
            }else{
                echo"not able to insert into study history "; 
            }
       }

       if($underfive_yes_no=='yes'){
       	$vaccine_name="";
       		$query_vaccine="SELECT * FROM vaccination";
			$sql_vaccine=mysqli_query($db,$query_vaccine);
			//$vaccine_name=$sql_vaccine['vaccination_name'];
			while($rows_name=mysqli_fetch_array($sql_vaccine)){
				echo $vaccine_name=$rows_name['vaccination_name'];
			}
 			$number_rows=mysqli_num_rows($sql_vaccine);
   			for($i=1;$i<=$number_rows;$i++){
   				 // $vaccine_id=$i;
  				if($i==1){
    				 $vaccine_value=$_POST['BCG'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }
				}
				if ($i==2) {
					  $vaccine_value=$_POST['Hepatitis_B_Birth_Dose'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==3) {
					  $vaccine_value=$_POST['OPV_Zero_Dose'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==4) {
					  $vaccine_value=$_POST['Pentavalent_1'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==5) {
					  $vaccine_value=$_POST['OPV_1'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==6) {
					  $vaccine_value=$_POST['IPV_1'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==7) {
					  $vaccine_value=$_POST['Rotavirus_1'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==8) {
					  $vaccine_value=$_POST['PCV_1'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==9) {
					  $vaccine_value=$_POST['Pentavalent_2'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==10) {
					  $vaccine_value=$_POST['OPV_2'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==11) {
					  $vaccine_value=$_POST['Rotavirus_2'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==12) {
					  $vaccine_value=$_POST['Pentavalent_3'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==13) {
					  $vaccine_value=$_POST['OPV_3'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==14) {
					  $vaccine_value=$_POST['IPV_2'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==15) {
					  $vaccine_value=$_POST['Rotavirus_3'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==16) {
					  $vaccine_value=$_POST['PCV_2'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==17) {
					  $vaccine_value=$_POST['MR_1'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==18) {
					  $vaccine_value=$_POST['PCV_Booster'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==19) {
					  $vaccine_value=$_POST['Vitamin_A'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==20) {
					  $vaccine_value=$_POST['DPT_Booster_1'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==21) {
					  $vaccine_value=$_POST['OPV_Booster'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==22) {
					  $vaccine_value=$_POST['MR_2'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
				if ($i==23) {
					  $vaccine_value=$_POST['DPT_Booster_2'];
  					 $vaccine_query="UPDATE `vaccination_history` SET  `vaccination_value`='$vaccine_value' , `modified_by`='$modifyby', `modified_on`='$modifydate'  WHERE `individual_id`='$id' AND `vaccination_id`='$i'";
   				 	if(mysqli_query($db,$vaccine_query)){
    			 			echo"Successfully";
   						}
				   else
				    {
				     echo"not inserting";
				    }  			 			

				}
			}

       }


	echo("successfully added in db");
}
else{
	echo("not able to add in database");
}


mysqli_close($db);

?>