<?php  

include('config.php');
$db = $conn;
     require_once('C:\xampp\htdocs\adoptation\tcpdf\tcpdf.php');
     class MYPDF extends TCPDF
     {
        public function AcceptPageBreak() {
            if (1 == $this->PageNo()) {
                   $this->SetMargins(15, 15, -1, true);
            }
           if ($this->num_columns > 1) {
               // multi column mode
               if ($this->current_column < ($this->num_columns - 1)) {
                   // go to next column
                   $this->selectColumn($this->current_column + 1);
               } elseif ($this->AutoPageBreak) {
                   // add a new page
                   $this->AddPage();
                   // set first column
                   $this->selectColumn(0);
               }
               // avoid page breaking from checkPageBreak()
               return false;
           }
           return $this->AutoPageBreak;
       }
     }
     $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 
      $pdf->SetCreator(PDF_CREATOR);  
      $pdf->SetTitle("Digi Health"); 
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128)); 
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $pdf->SetDefaultMonospacedFont('helvetica');  
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $pdf->setPrintHeader(false);  
      $pdf->setPrintFooter(false);  
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      $id=$_GET['id'];
      $query = $db->query("SELECT * FROM `individual` WHERE `family_id`='$id' ");
      while($row = $query->fetch_assoc()){ 
         $individual_name=$row['individual_name'];
         $individual_code=$row['individual_code'];
         $individual_gender=$row['individual_gender']; 
         $individual_mobile=$row['individual_mobile'];
         $individual_adhaar=$row['individual_adhaar'];
         $individual_date_of_birth=$row['individual_date_of_birth'];
         $individual_age=$row['individual_age'];
         $individual_bloodgroup=$row['individual_bloodgroup'];
         $individual_education=$row['individual_education'];
         $individual_occupation=$row['individual_occupation'];
         $individual_relation_with_head=$row['individual_relation_with_head'];
         $individual_student=$row['individual_student'];
         $underfive_yes_no=$row['underfive_yes_no'];
         $immunization=$row['immunization'];
         $individual_alcohol_usage=$row['individual_alcohol_usage'];
         $individual_tobacco_usage=$row['individual_tobacco_usage'];
         $individual_diet=$row['individual_diet'];
         $individual_chronic_illness=$row['individual_chronic_illness'];
         $individual_acute_illness=$row['individual_acute_illness'];
         $individual_flu_illness=$row['individual_flu_illness'];
         $individual_maleria=$row['individual_maleria'];
         $individual_dengue=$row['individual_dengue'];
         $individual_tuberculosis=$row['individual_tuberculosis'];
         $known_hypertension=$row['known_hypertension'];
         $known_dm=$row['known_dm'];
         $teeth_related_questions=$row['teeth_related_questions'];
         $individual_clean_teeth=$row['individual_clean_teeth'];
         $individual_teeth_other=$row['individual_teeth_other'];
         $individual_clean_day=$row['individual_clean_day'];
         $individual_material_for_clean=$row['individual_material_for_clean'];
         $individual_paste_kind=$row['individual_paste_kind'];
         $individual_change_brush=$row['individual_change_brush'];
         $individual_oral_hygine_aids=$row['individual_oral_hygine_aids'];
         $individual_mouth_problem=$row['individual_mouth_problem'];
         $individual_mouth_check=$row['individual_mouth_check'];
         $individual_transport_dental=$row['individual_transport_dental'];
         $individual_major_factor=$row['individual_major_factor'];
         $individual_health_needs=$row['individual_health_needs'];
         $individual_action_required=$row['individual_action_required'];
         
        
     
     } 
     $query = $db->query("SELECT student.student_name,student.student_id, student.student_mobile_number,student.student_id,family.family_id FROM `family` INNER JOIN student ON student.student_id = family.student_id WHERE family.id='$id' ");
    while($row = $query->fetch_assoc()){ 
       $student_id = $row['student_id'];
       $student_name=$row['student_name'];
       $student_id=$row['student_id'];

       $student_mobile_number=$row['student_mobile_number'];
       $family_id=$row['family_id'];
    
      
   
   }  
      
     
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }
      $pdf->SetAutoPageBreak(TRUE, 10);  
      $pdf->SetFont('helvetica', '', 12);  
      $pdf->AddPage();  
      $style2 = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, 
        'text' => true,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
    );
      $pdf->write1DBarcode($family_id, 'C39', '155', '45', '', 18, 0.4, $style2, 'N');
      $style = array(
        'border' => 0,
        'vpadding' => 'auto',
        'hpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255)
        'module_width' => 1, // width of a single module in points
        'module_height' => 1 // height of a single module in points
    );
    $pdf->write2DBarcode('tel:'.$individual_mobile, 'QRCODE,M', 175, 115, 15, 15, $style, 'N');

    
    $pdf->setJPEGQuality(75);
    $pdf->Image('./image/yen.jpg', 85, 0, 35, 40, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
    $pdf->setCellPaddings(1, 2, 1, 2);
    $pdf->setCellMargins(1, 1, 1, 1);
    $pdf->MultiCell('', '', $student_name, 0, '', false, 0, '145', '72', true);
      $pdf->MultiCell('', '', $student_mobile_number, 0, '', false, 0, '50', '84', true);
      $pdf->write2DBarcode('tel:'.$student_mobile_number, 'QRCODE,M', 105, 80, 15, 15, $style, 'N');
    $pdf->SetFont('','B',); 
    $pdf->MultiCell(70, 5, 'FAMILY HEALTH RECORD', 1, 'C', false, 0, '65', '40', true);
    $pdf->MultiCell(100, 5, 'FAMILY ADOPTION PROGRAMME FOR MEDICAL AND DENTAL STUDENTS', 0, 'C', false, 1, '50', '50', true);
    $pdf->MultiCell(70, 5, 'FAMILY MEMBERS DETAILS',0 , 'C', false, 1, '65', '61', true);
    $pdf->SetFont('','',);
    $pdf->MultiCell('', '', 'Student Code:', 'LTR', '', false, 0, '10', '', true,0,true);
    $pdf->MultiCell('', '', $student_id, 0, '', false, 0, '40', '', true);
      $pdf->MultiCell('', '', 'Student Name:', 0, '', false, 1, '115', '', true,0,true);
      $pdf->MultiCell('', '', 'Student Mobile No.:', 'LBR', '', false, 0, '10', '', true,0,true);
      $pdf->MultiCell('', '', '', 'BR', '', false, 1, '115', '', true,0,true);
      $pdf->SetTextColor(0, 0, 0 );
      $pdf->MultiCell('', '', 'Name', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_name, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Gender:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_gender, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Mobile Number:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_mobile, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Aadhaar Number:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_adhaar, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Date of Birth:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_date_of_birth, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Age', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_age, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Bood Group:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_bloodgroup, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Educaion:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_education, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Occupation:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_occupation, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Relation with Head Of Famil:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_relation_with_head, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Under five Child?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $underfive_yes_no, 0, '', false, 1, '100', '', true);
      $table1='<style>
      th{
        background-color:SlateBlue;
        color:white;
      }</style>
      <table cellpadding="2" border="1" align="center" >
      <tr><th width="10%">SL.NO</th>
      <th width="45%">VACCINATION NAME</th>
      <th width="45%">STATUS</th>
      </tr>';
      $rowdata_query="SELECT * FROM `vaccination_history` WHERE individual_id='$individual_code'";
      $row_vaccine=mysqli_query($db,$rowdata_query);
      if($row_vaccine){

         $i=1;
        while($rows_vaccine=mysqli_fetch_array($row_vaccine)){
          $vaccine_id=$rows_vaccine['vaccination_id'];
        }
      }
          $i=1;
         $query_name="SELECT * FROM vaccination WHERE id= $vaccine_id";
         $sql_vaccine_name=mysqli_query($db,$query_name);
         while($row_vaccine_name=mysqli_fetch_assoc($sql_vaccine_name)){
        
        $table1.='<tr><td>'.$i.'</td>
      <td>'.$row_vaccine_name['vaccination_name'].'</td>
      <td>'.$row_vaccine_name['status'].'</td></tr>';
       
       $i++;

        }

      $table1.=' </table>';
       $pdf->writeHTMLCell('', '', '', '', $table1, 0, 1, false, true, '', true);

      $pdf->MultiCell('', '', 'Immunization Status:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $immunization, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Alcohol Use:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_alcohol_usage, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Tobocco Use:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_tobacco_usage, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Diet:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_diet, 0, '', false, 1, '100', '', true);
      $pdf->SetFont('','B',); 
      $pdf->MultiCell('', '', 'Health Status', '', '', false, 1, '', '', true);
      $pdf->SetFont('','',);
      $pdf->MultiCell('', '', 'Chronic Illness:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_chronic_illness, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Acute Illness(two weeks):', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_acute_illness, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Fluke like illness:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_flu_illness, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Maleria:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_maleria, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Dengue:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_dengue, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Tuberculosis:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_tuberculosis, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Known case of HT:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $known_hypertension, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Known case of DM:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $known_dm, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'How do you genrally clean your teeth?:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_clean_teeth, 0, '', false, 1, '100', '', true);
      if($individual_clean_teeth=='others'){
      $pdf->MultiCell('', '', 'If Others Specify:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_teeth_other, 0, '', false, 1, '100', '', true);
      }
      $pdf->MultiCell('', '', 'How often do you clean your teeth in a day?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_clean_day, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('80', '', 'What material generally you use to clean your teeth?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $individual_material_for_clean, 0, '', false, 1, '100', '', true);
      $pdf->Ln();
      $pdf->MultiCell('80', '', 'Check toothpaste/tooth powder used and record whether it is fluoridated or not?:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_paste_kind, 0, '', false, 1, '100', '', true);
      $pdf->Ln();
      $pdf->MultiCell('80', '', 'How often do you change your toothbrush?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_change_brush, 0, '', false, 1, '100', '', true);
      $pdf->Ln();
      $pdf->MultiCell('80', '', 'Do you use any of these oral hygine aids? (Tick as many as reported)', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_oral_hygine_aids, 0, '', false, 1, '100', '', true);
      $pdf->Ln();
      $pdf->MultiCell('80', '', 'Have you suffered from any mouth or teeth problems in last one year?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_mouth_problem, 0, '', false, 1, '100', '', true);
      $pdf->Ln();
      $pdf->MultiCell('80', '', 'What were or was the the problems?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_mouth_check, 0, '', false, 1, '100', '', true);
      $pdf->Ln();
      $pdf->MultiCell('80', '', 'How accessible are the dental facilities for treatment with available transport?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_transport_dental, 0, '', false, 1, '100', '', true);
      
      $pdf->MultiCell('80', '', 'What in your opinion are the major factors which causes dental problems?', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_major_factor, 0, '', false, 1, '100', '', true);
      $pdf->Ln();
      $pdf->MultiCell('80', '', 'Health Needs:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_health_needs, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('80', '', 'Action Required:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('80', '', $individual_action_required, 0, '', false, 1, '100', '', true);
      $table2='<style>
      th{
        background-color:SlateBlue;
        color:white;
      }</style>
      <table cellpadding="2" border="1" align="center" >
      <tr><th width="10%">SL.NO</th>
      <th width="18%">INDIVIDUAL ID</th>
      <th width="18%">INDIVIDUAL NAME</th>
      <th width="18%">MOBILE NUMBER</th>
      <th width="18%">HEALTH NEDDS</th>
      <th width="18%">ACTION REQUIRED</th>
      </tr>';
      $sql_individual_follow_view = "SELECT b.id as individual_followup_id, a.id as individual_id, a.individual_name as individual_name, a.individual_mobile as individual_mobile, b.individual_health_needs as individual_health_needs, b.individual_action_required as individual_action_required FROM individual a, individual_followup b  WHERE a.id = '$individual_code' AND b.individual_id = '$individual_code' AND a.id = b.individual_id";
									$result_individual_follow_view = mysqli_query($conn, $sql_individual_follow_view);
									$i=1;
									while($rows_individual_follow_view = mysqli_fetch_assoc($result_individual_follow_view)){
								
                    $table2.='<tr>
											<td>'. $i.'</td>
											<td>'. $rows_individual_follow_view['individual_id'].'</td>
											<td>'. $rows_individual_follow_view['individual_name'].'</td>
											<td>'. $rows_individual_follow_view['individual_mobile'].'</td>
											<td>'. $rows_individual_follow_view['individual_health_needs'].'</td>
											<td>'. $rows_individual_follow_view['individual_action_required'].'</td>
                     
										</tr>';	 $i++;	 }   

                    $table2.='</table>';
       $pdf->writeHTMLCell('', '', '', '', $table2, 0, 1, false, true, '', true);

      
$pdf->SetAutoPageBreak(TRUE, 10); 
$pdf->Output('individual.pdf', 'I');  
 

 ?>  
 