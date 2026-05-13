<?php
require_once __DIR__ . '/../models/CertificateModel.php';

class CertificateController
{

    public static function isAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 'participant' || ($_SESSION['user_id'] == '')) {
            header('Location: index.php?controller=login&action=login_page');
            exit();
        }
        return true;
    }

    public function conference_participation()
    {
        return $this->generateCertificate([
            'template' => 'conference_participation',
            'title'    => 'Conference Participation Certificate',
            'name_pos' => ['x' => 91.97, 'y' => 111.8, 'w' => 140, 'align' => 'L'],
            'has_paper' => false,
            'cert_type' => 'conference_participation'
            // 'name'=>$name
        ]);
    }

    /**
     * Case 2: Paper Presentation
     */
    public function paper_presentation()
    {
        $allowedTypes = ['Oral Presentations for research submission', 'Oral Presentations for Speciality Research'];
        return $this->generateCertificate([
            'template'  => 'paper_presentation',
            'title'     => 'Paper Presentation Certificate',
            'name_pos'  => ['x' => 127.61, 'y' => 99.2, 'w' => 140, 'align' => 'L'],
            'has_paper' => true,
            'paper_types' => $allowedTypes,
            'paper_pos' => ['x' => 48.5, 'y' => 115, 'w' => 200, 'align' => 'C'],
            'cert_type' => 'paper_presentation'
        ]);
    }


    public function poster_presentation()
    {
        return $this->generateCertificate([
            'template'    => 'posters',
            'title'       => 'Poster Presentation Certificate',
            // Coordinates from your script: X=127.61, Y=98.15
            'name_pos'    => ['x' => 127.61, 'y' => 98.15, 'w' => 140, 'align' => 'L'],
            'has_paper'   => true,
            'paper_types' => ['Posters'],
            // Coordinates for the title: X=48.5, Y=115
            'paper_pos'   => ['x' => 48.5, 'y' => 115, 'w' => 200, 'align' => 'C'],
            'filename_prefix' => 'Certificate_Poster_Presentation_',
            'cert_type' => 'posters_presentation'
        ]);
    }

    public function yenvision()
    {
        return $this->generateCertificate([
            'template'    => 'yenvision_lightning_talk',
            'title'       => 'Yenvision Lightning Talk Certificate',
            // Coordinates from your script: X=127.61, Y=98.15
            'name_pos'    => ['x' => 127.61, 'y' => 98.15, 'w' => 140, 'align' => 'L'],
            'has_paper'   => true,
            'paper_types' => ['Yenvision- Lightning talk'],
            // Coordinates for the title: X=48.5, Y=115
            'paper_pos'   => ['x' => 48.5, 'y' => 115, 'w' => 200, 'align' => 'C'],
            'filename_prefix' => 'Certificate_Yenvision_Lightning_Talk_',
            'cert_type' => 'yenvision_lightning_talk'
        ]);
    }

    

    
    public function downloadGenerated()
    {
        // session_start();
        $type = $_GET['type'] ?? '';
        $name=$_GET['name']?? '';
        $userId = $_SESSION['user_id'];
        $model = new CertificateModel();
        // 1. Check if the admin actually generated this specific cert for the user
        if (!$model->isCertificateGenerated($userId, $type)) {
            return $this->showError("Not Available", "This certificate has not been issued to your account yet.");
        }

        // 2. Configuration Map for all  types
       $certMap = [
            'preconference_item_analysis' => ['preconference_certificate', 'Pre-Conference Participation Certificate', 100,107],
            'mindful_map'            => ['Preconference_workshop-_mindful_map', 'Pre-Conference Workshop', 100,104],
            'sage'                   => ['Preconference_participation_SAGE', 'Pre-Conference Participation SAGE', 100,107],
            'itlm'                   => ['Preconference_participation_Interactive_teaching_learning_methods', 'Pre-Conference Participation ITLM', 100, 107],
            'workshop_bridging'      => ['Workshop_course_bridging_mind_buliding_care', 'Workshop Course',100,107],
            'workshop_proms_prems'   => ['WORKSHOP_PROMs_PREMs', 'Workshop PROMs PREMs', 100,101],
            'workshop_microteaching' => ['WORKSHOP_ MICROTEACHING', 'Microteaching Workshop', 100,104],
            'first_place_paper'      => ['1ST_PLACE_PAPER', '1st Place Paper Award', 90, 111.8],
            'second_place_paper'     => ['2ND_PLACE_PAPER', '2nd Place Paper Award',  90, 111.8],
            'first_place_poster'     => ['1ST_PLACE_POSTER', '1st Place Poster Award',  90, 111.8],
            'second_place_poster'    => ['2ND_PLACE_POSTER', '2nd Place Poster Award', 90, 111.8],
            'first_place_yenvision'  => ['1ST_PLACE_YENVISION', '1st Place YenVision Award', 90, 111.8],
            'second_place_yenvision' => ['2ND_PLACE_YENVISION', '2nd Place YenVision Award', 90, 111.8],
            'co_author_certificate' => ['co_author_certificate','Co-Author Certificate',100,103]
        ];

        
        if (!isset($certMap[$type])) {
            return $this->showError("Error", "Certificate type definition not found.");
        }
            $config = $certMap[$type];
       // 3. Call the Engine
        return $this->generateCertificate([
            'template'    => $config[0],
            'title'       => $config[1],
            'name_pos'    => ['x' => $config[2], 'y' => $config[3], 'w' => 140, 'align' => 'L'],
            'has_paper'   => false, // These awards usually only have the name
            'filename_prefix' => 'Certificate_' . str_replace(' ', '_', $config[1]) . '_',
            'cert_type' => $type,
            'name'=>$name
        ]);
        
    }

    private function generateCertificate($config)
    {
        if ($this->isAuth()) {
            $userId = $_SESSION['user_id'];
            if($config['cert_type']=='co_author_certificate'){
                $fullName=$config['name'];

            }
            else{
                $model = new CertificateModel();
                $user = $model->getParticipantData($userId);
                $fullName = $user['honorofic'] . ' ' . $user['full_name'];
                $paperTitle = "";
            }

            // Check Eligibility if it's a paper-based certificate
            if ($config['has_paper']) {
                $paper = $model->getAbstractDetails($userId, $config['paper_types']);
                if (!$paper) {
                    return $this->showError("Not Eligible", "No eligible presentation found for this certificate.");
                }
                $paperTitle = $paper['paper_title'];
            }

            $imagePath = __DIR__ . '/../assets/certificates/' . $config['template'] . '.jpg';
            if (!file_exists($imagePath)) {
                if ($_GET['action'] == 'downloadGenerated') {
                    return $this->showError("Not Available", "Simple Setup: Just place your certificate JPEG/PNG image in the certificates folder!", $config['template'], $imagePath, $action = 'downloadGenerated');
                } else {
                    return $this->showError("Not Found", "Setup Required: Please upload the {$config['template']} certificate image!", $config['template'], $imagePath);
                }
            }


            if (!class_exists('TCPDF')) {
                require_once __DIR__ . '/../assets/libraries/tecnickcom/tcpdf/tcpdf.php';
            }
            $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle($config['title']);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->AddPage();

            // Add Image
            $pdf->Image($imagePath, 0, 0, 297, 210);

            // Draw Name
            $pdf->SetFont('times', 'B', 16);
            $pdf->SetXY($config['name_pos']['x'], $config['name_pos']['y']);
            $pdf->Cell($config['name_pos']['w'], 7, $fullName, 0, 0, $config['name_pos']['align']);

            // Draw Paper Title if needed
            if ($config['has_paper']) {
                $pdf->SetFont('times', 'B', 10);
                $pdf->SetXY($config['paper_pos']['x'], $config['paper_pos']['y']);
                $pdf->Cell($config['paper_pos']['w'], 7, $paperTitle, 0, 0, $config['paper_pos']['align']);
            }

            return $pdf->Output($config['title'] . '.pdf', 'D');
        }
    }

    private function showError($title, $msg, $config = '', $imagePath = null, $action = '')
    {
        $action = $action;
        $certName = $config;
        $errorTitle = $title;
        $errorMessage = $msg;

        require_once __DIR__ . '/../views/participant/certificate_not_found.php';
    }
    
    public function uploadAction()
    {
        // ... validation logic ...
        if (!$this->isAuth()) {
            return;
        }

        $data = ['message' => '', 'messageType' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 2. BASIC UPLOAD VALIDATION
            if (!isset($_FILES['certificate_image']) || $_FILES['certificate_image']['error'] === UPLOAD_ERR_NO_FILE) {
                $data['message'] = "Please select a file to upload.";
                $data['messageType'] = "warning";
            } else {
                $file = $_FILES['certificate_image'];

                // 3. FILE SIZE VALIDATION (e.g., limit to 5MB)
                $maxFileSize = 5 * 1024 * 1024; // 5 Megabytes
                if ($file['size'] > $maxFileSize) {
                    $data['message'] = "File is too large. Maximum size is 5MB.";
                    $data['messageType'] = "danger";
                }

                // 4. FILE TYPE / MIME VALIDATION
                else {
                    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mimeType = $finfo->file($file['tmp_name']);

                    if (!in_array($mimeType, $allowedMimeTypes)) {
                        $data['message'] = "Invalid file format. Only JPG and PNG are allowed.";
                        $data['messageType'] = "danger";
                    }

                    // 5. FINAL PROCESSING
                    else {
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        // Pass to Model to save
                        $model = new CertificateModel();
                        $success = $model->saveCertificateImage(
                            $file['tmp_name'],
                            $extension,
                            'preconference_certificate'
                        );

                        if ($success) {
                            $data['message'] = "Certificate template updated successfully!";
                            $data['messageType'] = "success";
                        } else {
                            $data['message'] = "Critical Error: Could not save file to disk.";
                            $data['messageType'] = "danger";
                        }
                    }
                }
            }
        }

        // Pass $data to the View
        require_once __DIR__ . '/../views/participant/upload_certificate.php';
       
    }
}




