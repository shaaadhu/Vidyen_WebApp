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
     $id=$_GET['id'];
     $query = $db->query("SELECT * FROM `family_followup` WHERE `family_id`='$id' ");
     while($row = $query->fetch_assoc()){ 
      $family_id=$row['family_id'];
      $birth=$row['birth'];
      $nofbirth=$row['nofbirth'];
      $death=$row['death'];
      $nofdeath=$row['nofdeath'];
      $marriage=$row['marriage'];
      $nofmarry=$row['nofmarry'];
      $family_health_problem=$row['family_health_problem'];
      $healthcare=$row['healthcare'];
      $direct_cost=$row['direct_cost'];
      $indirect_cost=$row['indirect_cost'];
      $scheme=$row['scheme'];
      $what_action_taken=$row['what_action_taken'];
      $observation=$row['observation'];
      $date_of_visit=$row['date_of_visit'];

     }
     if(!$healthcare){
       $hea="No";
     }else{
      $hea="Yes";
     }
     if(!$what_action_taken){
      $fam="No";
    }else{
     $fam="Yes";
    }
    
    $query = $db->query("SELECT head_of_family_name,phone_number FROM `family` WHERE `id`='$family_id' ");
     while($row = $query->fetch_assoc()){
      $head_of_family_name=$row['head_of_family_name'];
      $phone_number=$row['phone_number'];

      }
    $query = $db->query("SELECT student.student_name, student.student_mobile_number,student.student_id,family.family_id FROM `family` INNER JOIN student ON student.student_id = family.student_id WHERE family.id='$family_id' ");
    while($row = $query->fetch_assoc()){ 
       $student_id = $row['student_id'];
       $student_name=$row['student_name'];
       $student_mobile_number=$row['student_mobile_number'];
       $family_co=$row['family_id'];
      
   
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

    
      
     
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }
      $pdf->SetAutoPageBreak(TRUE,10);  
      $pdf->SetFont('helvetica', '', 12);  
      $pdf->AddPage();  



    
    $pdf->setJPEGQuality(75);
      $pdf->SetXY(110, 200);
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
      $pdf->write1DBarcode($family_co, 'C39', '155', '45', '', 18, 0.4, $style2, 'N');
      $pdf->MultiCell('', '', $student_name, 0, '', false, 0, '145', '76', true);
      $pdf->MultiCell('', '', $student_mobile_number, 0, '', false, 0, '54', '88', true);
      $pdf->MultiCell('', '', $date_of_visit, 0, '', false, 0, '150', '88', true);
      $pdf->Image('./image/yen.jpg', 85, 0, 35, 40, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
      $pdf->setCellPaddings(1, 2, 1, 2);
      $pdf->setCellMargins(1, 1, 1, 1);
      $pdf->SetFont('','B',); 
      $pdf->MultiCell(70, 5, 'FAMILY HEALTH RECORD', 1, 'C', false, 0, '65', '40', true);
      $pdf->MultiCell(100, 5, 'FAMILY ADOPTION PROGRAMME FOR MEDICAL AND DENTAL STUDENTS', 0, 'C', false, 1, '50', '50', true);
      $pdf->MultiCell(70, 5, 'FAMILY FOLLOWUP',0 , 'C', false, 1, '65', '62', true);
      $pdf->SetFont('','',);
      $pdf->MultiCell('', '', 'Student Code:', 'LTR', '', false, 0, '15', '', true,0,true);
      $pdf->MultiCell('', '', $student_id, 0, '', false, 0, '43', '', true);
      $pdf->MultiCell('', '', 'Student Name:', 0, '', false, 1, '115', '', true,0,true);
      $pdf->MultiCell('', '', 'Student Mobile No.:', 'LBR', '', false, 0, '15', '', true,0,true);
      $pdf->MultiCell('', '', 'Date of follow up:', 'BR', '', false, 1, '115', '', true,0,true);
      
      $pdf->MultiCell('', '', 'Family Code:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $family_co, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Head of Family:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $head_of_family_name, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Contact No.:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $phone_number, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Birth in Last 12 months:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $birth, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Number of Birth:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $nofbirth, 0, '', false, 1, '100', '', true);
      if($birth=='yes'){
        $table1='<style>
      th{
        background-color:SlateBlue;
        color:white;
      }</style>
      <table cellpadding="2" border="1" align="center" >
      <tr><th width="10%">SL.NO</th>
      <th width="30%">DATE</th>
      <th width="30%">NAME</th>
      <th width="30%">GENDER</th>
      </tr>';
      $query = $db->query("SELECT * FROM `birth_history` WHERE `family_id`='$id' ");
      $i=1;
     while($row = $query->fetch_assoc()){ 
      $table1.='<tr><td>'.$i.'</td>
      <td>'.$row['cbdate'].'</td>
      <td>'.$row['cbname'].'</td>
      <td>'.$row['cbgender'].'</td></tr>';
      $i++;
     }
      
     
      

      $table1.='</table>';
       $pdf->writeHTMLCell('', '', '', '', $table1, 0, 1, false, true, '', true);
    }
       $pdf->MultiCell('', '', 'Death in the Family in last 12 months:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $death, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Number of death:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $nofdeath, 0, '', false, 1, '100', '', true);
       if($death=='yes'){
       $table2='<style>
      th{
        background-color:SlateBlue;
        color:white;
      }</style>
      <table cellpadding="2" border="1" align="center" >
      <tr><th width="10%">SL.NO</th>
      <th width="18%">DATE</th>
      <th width="18%">NAME</th>
      <th width="18%">AGE</th>
      <th width="18%">GENDER</th>
      <th width="18%">CAUSE OF DEATH</th>
      </tr>';
      $query = $db->query("SELECT * FROM `death_history` WHERE `family_id`='$id' ");
      $i=1;
     while($row = $query->fetch_assoc()){
     
     $table2.= '<tr><td>'.$i.'</td>
      <td>'.$row['ddate'].'</td>
      <td>'.$row['dname'].'</td>
      <td>'.$row['dage'].'</td>
      <td>'.$row['dgender'].'</td>
      <td>'.$row['dcause'].'</td></tr>';
     }
      
     $table2.='</table>';
       $pdf->writeHTMLCell('', '', '', '', $table2, 0, 1, false, true, '', true);
    }
       $pdf->MultiCell('', '', 'Marriage in the Family in last 12 months:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $marriage, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Number of Marriage:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $nofmarry, 0, '', false, 1, '100', '', true);
       if($marriage=='yes'){
       $table3='<style>
      th{
        background-color:SlateBlue;
        color:white;
      }</style>
      <table cellpadding="2" border="1" align="center" >
      <tr><th width="10%">Sl.No</th>
      <th width="22.5%">Name</th>
      <th width="22.5%">Age</th>
      <th width="22.5%">Gender</th>
      <th width="22.5%">Relationship with HOF</th>
      </tr>';
      $query = $db->query("SELECT * FROM `marriage_history` WHERE `family_id`='$id' ");
      $i=1;
     while($row = $query->fetch_assoc()){
     $table3.= '<tr><td>'.$row['dcause'].'</td>
      <td>'.$row['marryname'].'</td>
      <td>'.$row['marryage'].'</td>
      <td>'.$row['marrygender'].'</td>
      <td>'.$row['marryrel'].'</td></tr>';
     }
      
      
      $table3.='</table>';
       $pdf->writeHTMLCell('', '', '', '', $table3, 0, 1, false, true, '', true);
    }
       $pdf->MultiCell('80', '', 'Health Probelms reported By the Family Members:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $family_health_problem, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Health Care Utilization:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $hea, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Name of health care:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $healthcare, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Direct cost:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $direct_cost, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Indirect cost:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $indirect_cost, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Social security Scheme:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $scheme, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Have the family members approached you:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $fam, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Action taken:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $what_action_taken, 0, '', false, 1, '100', '', true);
       $pdf->MultiCell('', '', 'Other observations:', 0, '', false, 0, '', '', true);
       $pdf->MultiCell('', '', $observation, 0, '', false, 1, '100', '', true);

      
$pdf->SetAutoPageBreak(TRUE, 10); 
$pdf->Output('family_followup.pdf', 'I');  

      ?>