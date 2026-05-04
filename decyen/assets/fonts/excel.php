
<?php
include('config.php');
$db = $conn;

$id=12;
$delimiter = ","; 
$filename = "members-data_" . date('Y-m-d') . ".csv"; 
 
// Create a file pointer 
$f = fopen('php://memory', 'w'); 
 
// Set column headers 
$fields = array('individual_id', 'individual_education', 'individual_occupation', 'individual_age', 'followup_individual_id', 'individual_student', 'underfive_yes_no', 'immunization', 'individual_height', 'individual_weight', 'individual_bmi', 'individual_alcohol_usage', 'individual_tobacco_usage', 'family_id', 'individual_systolic_value', 'individual_diastolic_value', 'known_hypertension', 'individual_sugar', 'known_dm', 'individual_urine_sugar_value', 'individual_urine_protien', 'individual_oral_cavity', 'individual_oral_ulcer', 'individual_oral_hygine', 'individual_heamoglobin', 'individual_diet', 'individual_chronic_illness', 'individual_acute_illness', 'individual_flu_illness', 'individual_maleria', 'individual_dengue', 'individual_tuberculosis', 'individual_clean_teeth', 'individual_teeth_other', 'individual_clean_day', 'individual_material_for_clean', 'individual_paste_kind', 'individual_change_brush', 'individual_oral_hygine_aids', 'individual_mouth_problem', 'individual_mouth_check', 'individual_transport_dental', 'individual_major_factor', 'individual_health_needs', 'individual_action_required', 'individual_followup_health_needs', 'individual_followup_action_required'); 
fputcsv($f,$fields, $delimiter); 
$query = $db->query("SELECT a.id as individual_id, a.individual_education as individual_education, a.individual_occupation as individual_occupation,a.individual_age as individual_age, b.individual_id as followup_individual_id, a.individual_student as individual_student, a.underfive_yes_no as underfive_yes_no, a.immunization as immunization, b.individual_height as individual_height, b.individual_weight as individual_weight, b.individual_bmi as individual_bmi, a.individual_alcohol_usage as individual_alcohol_usage,a.individual_tobacco_usage as individual_tobacco_usage,  b.family_id as family_id, b.individual_systolic_value as individual_systolic_value, b.individual_diastolic_value as individual_diastolic_value, a.known_hypertension as known_hypertension, b.individual_sugar as individual_sugar, a.known_dm as known_dm, b.individual_urine_sugar_value as individual_urine_sugar_value, b.individual_urine_protien as individual_urine_protien, b.individual_oral_cavity as individual_oral_cavity, b.individual_oral_ulcer as individual_oral_ulcer, b.individual_oral_hygine as individual_oral_hygine, b.individual_heamoglobin as individual_heamoglobin, a.individual_diet as individual_diet, a.individual_chronic_illness as individual_chronic_illness, a.individual_acute_illness as individual_acute_illness, a.individual_flu_illness as individual_flu_illness, a.individual_maleria as individual_maleria, a.individual_dengue as individual_dengue, a.individual_tuberculosis as individual_tuberculosis, a.individual_clean_teeth as individual_clean_teeth, a.individual_teeth_other as individual_teeth_other, a.individual_clean_day as individual_clean_day, a.individual_material_for_clean as individual_material_for_clean, a.individual_paste_kind as individual_paste_kind, a.individual_change_brush as individual_change_brush, a.individual_oral_hygine_aids as individual_oral_hygine_aids, a.individual_mouth_problem as individual_mouth_problem, a.individual_mouth_check as individual_mouth_check, a.individual_transport_dental as individual_transport_dental, a.individual_major_factor as individual_major_factor, a.individual_health_needs as individual_health_needs, a.individual_action_required as individual_action_required, b.individual_health_needs as individual_followup_health_needs, b.individual_action_required as individual_followup_action_required FROM `individual` a, `individual_followup` b WHERE b.individual_id='$id' AND a.id = b.individual_id"); 
 
if($query->num_rows > 0){ 
   
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['individual_id'], $row['individual_education'],$row['individual_occupation'], $row['individual_age'], $row['followup_individual_id'], $row['individual_student'], $row['underfive_yes_no'], $row['immunization'], $row['individual_height'], $row['individual_weight'], $row['individual_bmi'], $row['individual_alcohol_usage'], $row['individual_tobacco_usage'], $row['family_id'], $row['individual_systolic_value'], $row['individual_diastolic_value'], $row['known_hypertension'], $row['individual_sugar'], $row['known_dm'], $row['individual_urine_sugar_value'], $row['individual_urine_protien'], $row['individual_oral_cavity'], $row['individual_oral_ulcer'], $row['individual_oral_hygine'], $row['individual_heamoglobin'], $row['individual_diet'], $row['individual_chronic_illness'], $row['individual_acute_illness'], $row['individual_flu_illness'], $row['individual_maleria'], $row['individual_dengue'], $row['individual_tuberculosis'], $row['individual_clean_teeth'], $row['individual_teeth_other'], $row['individual_clean_day'], $row['individual_material_for_clean'], $row['individual_paste_kind'], $row['individual_change_brush'], $row['individual_oral_hygine_aids'], $row['individual_mouth_problem'], $row['individual_mouth_check'], $row['individual_transport_dental'], $row['individual_major_factor'], $row['individual_health_needs'], $row['individual_action_required'], $row['individual_followup_health_needs'], $row['individual_followup_action_required']);
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>

