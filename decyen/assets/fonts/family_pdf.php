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
     $query = $db->query("SELECT * FROM `family` WHERE `id`='$id' ");
     while($row = $query->fetch_assoc()){ 
        $stud_id=$row['student_id'];
        $family_id=$row['family_id']; 
        $phone_number=$row['phone_number'];
        $house_number=$row['house_number'];
        $village_name=$row['village_name'];
        $full_address=$row['full_address'];
        $age=$row['age'];
        $gender=$row['gender'];
        $number_of_living_room=$row['number_of_living_room'];
        $living_room_area=$row['living_room_area'];
        $adhaar_number=$row['adhaar_number'];
        $ration_card_type=$row['ration_card_type'];
        $head_of_family_name=$row['head_of_family_name'];
        $date_of_birth=$row['date_of_birth'];
        $overcrowding=$row['overcrowding'];
        $follow_up_date=$row['follow_up_date'];



    
    } 
    $query = $db->query("SELECT * FROM `student` WHERE `student_id`='$stud_id' ");
     while($row = $query->fetch_assoc()){ 
        
        $student_name=$row['student_name'];
        $student_mobile_number=$row['student_mobile_number'];
       



    
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
      $pdf->SetAutoPageBreak(TRUE);  
      $pdf->SetFont('helvetica', '', 12);  
      $pdf->AddPage();  



    
    $pdf->setJPEGQuality(75);
      $pdf->SetXY(110, 200);
      $pdf->MultiCell('', '', $student_name, 0, '', false, 0, '145', '76', true);
      $pdf->MultiCell('', '', $student_mobile_number, 0, '', false, 0, '49', '88', true);
      $pdf->MultiCell('', '', $follow_up_date, 0, '', false, 0, '150', '88', true);
      $pdf->Image('./image/yen.jpg', 85, 0, 35, 40, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
      $pdf->setCellPaddings(1, 2, 1, 2);
      $pdf->setCellMargins(1, 1, 1, 1);
      $pdf->SetFont('','B',); 
      $pdf->MultiCell(70, 5, 'FAMILY HEALTH RECORD', 1, 'C', false, 0, '65', '40', true);
      $pdf->MultiCell(100, 5, 'FAMILY ADOPTION PROGRAMME FOR MEDICAL AND DENTAL STUDENTS', 0, 'C', false, 1, '50', '50', true);
      $pdf->MultiCell(70, 5, 'FAMILY DETAILS',0 , 'C', false, 1, '65', '62', true);
      $pdf->SetFont('','',);
      $pdf->MultiCell('', '', 'Student Code:', 'LTR', '', false, 0, '10', '', true,0,true);
      $pdf->MultiCell('', '', $stud_id, 0, '', false, 0, '40', '', true);
      $pdf->MultiCell('', '', 'Student Name:', 0, '', false, 1, '115', '', true,0,true);
      
      $pdf->MultiCell('', '', 'Student Mobile No.:', 'LBR', '', false, 0, '10', '', true,0,true);
      
      $pdf->MultiCell('', '', 'Date of follow up:', 'BR', '', false, 1, '115', '', true,0,true);
      
      $pdf->MultiCell('', '', 'Family Code:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $family_id, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Name of Head of the Family:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $head_of_family_name, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Contact No.:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $phone_number, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'House Number:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '',$house_number , 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Village Name:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $village_name , 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Full Address With Landmarks:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $full_address , 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Date of birth:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $date_of_birth , 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Age', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '',  $age, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Gender:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '',$gender , 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Number of Living rooms:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $number_of_living_room, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Living room area in Sq.ft:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $living_room_area , 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Overcrowding:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '',  $overcrowding, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Aadhar No.:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $adhaar_number, 0, '', false, 1, '100', '', true);
      $pdf->MultiCell('', '', 'Type  of Ration Card:', 0, '', false, 0, '', '', true);
      $pdf->MultiCell('', '', $ration_card_type, 0, '', false, 1, '100', '', true);

      $style = array(
        'border' => 0,
        'vpadding' => 'auto',
        'hpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255)
        'module_width' => 1, // width of a single module in points
        'module_height' => 1 // height of a single module in points
    );
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
      $pdf->write2DBarcode('tel:'.$phone_number, 'QRCODE,M', 175, 115, 15, 15, $style, 'N');
      $pdf->write1DBarcode($family_id, 'C39', '155', '45', '', 18, 0.4, $style2, 'N');
      $y = $pdf->getY();

      
       
      

      
$pdf->SetAutoPageBreak(TRUE, 10); 
$pdf->Output('family.pdf', 'I');  
 

 ?>  
 