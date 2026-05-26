<?php
require_once __DIR__ . '/../models/AdminModel.php';
require_once __DIR__ . '/../models/DashboardModel.php';
class AdminController
{
    

    // checking whether the user is authenticated (logged in).
    public function isAuth()
    {
        // session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 'admin' || ($_SESSION['user_id'] == '')) {
            require_once __DIR__ . '/../views/login.php';
            exit;
        } else {
            return true;
        }
    }

    private  function year_filter(){
          $currentYear = (int)date('Y');
        $selectedYear = isset($_GET['filter_year']) ? $_GET['filter_year'] : (string)$currentYear;

        return [
            'year_options' => [
                (string)$currentYear        => (string)$currentYear,
                (string)($currentYear - 1)  => (string)($currentYear - 1)             
            ],
            'selected_year' => $selectedYear,
        ];
    }


    // get all registration details for admin                         (1.REGISTRATION)
    public function admin_reg_view()
    {
        if (!$this->isAuth()) {
            return;
        }
        $user_type = $_SESSION['usertype'];
        $model = new AdminModel;
        $data = [];
        $data = array_merge($data, $this->year_filter());
        $year = $data['selected_year'];
        $participants = $model->getAllParticipants($year);
        $content_file = __DIR__ . '/../views/admin/admin_reg_view.php';
        require_once __DIR__ . '/../views/main.php';
    }

    //personal details view of registered candidates
    public function ajaxGetRegistrationDetails()
    {
        $model = new AdminModel;
        $id = $_GET['id'] ?? '';
        if ($id) {
            $row = $model->getRegistrationDetails($id);
            require_once __DIR__ . '/../views/admin/view_registration_details.php';
        }
    }

     // activate user by admin
    public function ajaxActivateUser()
    {
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        $model = new AdminModel;
        $userid = $_POST['userid'] ?? '';
        if ($userid) {
            $model->activateUser($userid);
            echo "Successfully Activated";
        }
    }
    
    // download registration details in csv format
    public function exportCSV()
    {
        $model = new AdminModel;
        $delimiter = ",";
        $filename = "participants_registration_" . date('Y-m-d') . ".csv";

        // Create a file pointer
        $f = fopen('php://memory', 'w');

        // Set column headers
        $fields = ['User ID', 'Full Name', 'Age', 'Gender', 'Designation', 'College Name', 'State', 'Email', 'Mobile No'];
        fputcsv($f, $fields, $delimiter);

        // Fetch data
        $query = $model->getAllRegistration();

        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $lineData = [
                    $row['registration_code'],
                    $row['honorofic'] . $row['full_name'],
                    $row['age'],
                    $row['gender'],
                    $row['designation'],
                    $row['college_name'],
                    $row['state'],
                    $row['email'],
                    $row['phone_number']
                ];
                fputcsv($f, $lineData, $delimiter);
            }
        }

        // Move back to beginning of file
        fseek($f, 0);

        // Set headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        // Output all remaining data
        fpassthru($f);
        exit;
    }

   
    // get pre-conference submitted details for admin view           (2. PRE-CONFERENCE)
    public function preconference_view()
    {
        if (!$this->isAuth()) {
            return;
        }
        $user_type = $_SESSION['usertype'];
        $model = new AdminModel;
        $data = [];
        $data = array_merge($data, $this->year_filter());
        $year = $data['selected_year'];
        $result = $model->getAll_preConference($year);
        $content_file = __DIR__ . '/../views/admin/preconference_view.php';
        require_once __DIR__ . '/../views/main.php';
    }

    // get details of preconference submission of candidate
    public function preconference_viewDetails()
    {
        if (!$this->isAuth()) {
            return;
        }
        $user_type = $_SESSION['usertype'];
        $model = new AdminModel;
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Invalid ID");
        }

        // Fetch Data
        $conference = $model->getConferenceById($id);
        $authorData = $model->getAuthorDetails($id);
        $comments = $model->getReviewerComments($id);
        $reviewers = $model->getPreconferenceReviewers();

        // Process Author Strings (explode CSV data)
        $authors = [];
        if ($authorData) {
            $firstNames = explode(",", $authorData['first_name']);
            // ... repeat for other fields ...
            for ($i = 0; $i < count($firstNames); $i++) {
                $authors[] = [
                    'name' => $firstNames[$i] . " " . explode(",", $authorData['middle_name'])[$i]. " " . explode(",", $authorData['last_name'])[$i],
                    'email' => explode(",", $authorData['author_email'])[$i],
                    'author_type' => explode(",", $authorData['author_type'])[$i],
                    'designation' => explode(",", $authorData['designation'])[$i],
                    'institution' => explode(",", $authorData['author_institution'])[$i],
                    'city' => explode(",", $authorData['author_city'])[$i],
                    'state' => explode(",", $authorData['author_state'])[$i],
                    'pincode' => explode(",", $authorData['author_pincode'])[$i],
                    // Add other fields as needed
                ];
            }
    
        } else {
            $no_author = "No author information available.";
        }
        // Load the View
            // require_once __DIR__ . '/../views/admin/preconference_details.php';
            $content_file = __DIR__ . '/../views/admin/preconference_details.php';
            require_once __DIR__ . '/../views/main.php';
    }


    // assign reviewer to pre-conference submission by admin
    public function assignPreConferenceReviewer()
    {
      

        // 2. Collect Data
        $participantId = $_POST['participant_id'] ?? '';
        $preconferencetId    = $_POST['abstract_code'] ?? '';
        $reviewerId    = $_POST['reviewers'] ?? '';
        $currentYear = (int)date('Y');

        if (empty($participantId) || empty($preconferencetId) || empty($reviewerId)) {
            echo "Missing required data";
            exit;
        }

        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }
        // session_start();
        // echo $participantId,$abstractId,$reviewerId;

        $model = new AdminModel;
        // 3. Logic: Model call
        $result = $model->assignPreConferenceReviewer($participantId, $preconferencetId, $reviewerId, $currentYear);

        // 4. Response
        if ($result) {
            echo "successfully updated";
        } else {
            echo "not able to add in database";
        }
    }

    // get all workshop details for admin                       (3. WORKSHOP)
    public function workshop_view()
    {
        if ($this->isAuth()) {
        }
        $user_type = $_SESSION['usertype'];
        $model = new AdminModel;
         $data = [];
        $data = array_merge($data, $this->year_filter());
        $year = $data['selected_year'];
        $workshops = $model->getAllWorkshops($year);

        // 3. Load the View and pass data
        // require_once __DIR__ . '/../views/admin/workshop_view.php';
        $action = 'workshop_view';
        $content_file = __DIR__ . '/../views/admin/workshop_view.php';
        require_once __DIR__ . '/../views/main.php';
    }

    // get details of workshop submission of candidate
    public function workshop_details()
    {
        if ($this->isAuth()) {
            $user_type = $_SESSION['usertype'];
            $model = new AdminModel;

            $id = $_GET['id'] ?? null;
            if (!$id) {
                die("Invalid ID");
            }

            // Fetch Data
            $workshop = $model->getWorkshopById($id);
            $authorData = $model->getAuthorDetails($id);
            $comments = $model->getReviewerComments($id);
            $reviewers = $model->getWorkshopReviewers();

            // Process Author Strings (explode CSV data)
            $authors = [];
            if ($authorData) {
                $firstNames = explode(",", $authorData['first_name']);
                // ... repeat for other fields ...
                for ($i = 0; $i < count($firstNames); $i++) {
                    $authors[] = [
                        'name' => $firstNames[$i] . " " . explode(",", $authorData['last_name'])[$i],
                        'email' => explode(",", $authorData['author_email'])[$i],
                        'author_type' => explode(",", $authorData['author_type'])[$i],
                        'designation' => explode(",", $authorData['designation'])[$i],
                        'institution' => explode(",", $authorData['author_institution'])[$i],
                        'city' => explode(",", $authorData['author_city'])[$i],
                        'state' => explode(",", $authorData['author_state'])[$i],
                        'pincode' => explode(",", $authorData['author_pincode'])[$i],
                        // Add other fields as needed
                    ];
                }
            }

            // Load the View
            // require_once __DIR__ . '/../views/admin/workshop_details.php';
            $content_file = __DIR__ . '/../views/admin/workshop_details.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }


    // assign reviewer to workshop submission by admin
    public function assignWorkshopReviewer()
    {
       
        // 2. Get Input
        $participantId = $_POST['participant_id'] ?? '';
        $abstractId    = $_POST['abstract_code'] ?? '';
        $reviewerId    = $_POST['reviewers'] ?? '';
        $currentYear = (int)date('Y');

        if (empty($participantId) || empty($abstractId) || empty($reviewerId)) {
            echo "Missing required data";
            exit;
        }

         $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        $model = new AdminModel;
        // 3. Call Model Logic
        $result = $model->assignWorkshopReviewer($participantId, $abstractId, $reviewerId, $currentYear);

        // 4. Send Response back to AJAX
        if ($result) {
            echo "successfully updated";
        } else {
            echo "unable to process assignment";
        }
    }

    // get all abstract details for admin view                         (4. ABSTRACT)
     public function abstract_view()
    {
        // 1. Session Auth
        if ($this->isAuth()) {
            $user_type = $_SESSION['usertype'];
            $model = new AdminModel;
            $data = [];
            $data = array_merge($data, $this->year_filter());
            $year = $data['selected_year'];
            $abstracts = $model->getAllAbstracts($year);
            $action = 'abstract_view';
            // require_once __DIR__ . '/../views/admin/abstract_view.php';
            $content_file = __DIR__ . '/../views/admin/abstract_view.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

    // download abstract details in excel format
    public function downloadAbstractExcel()
    {
        

        // 2. Set environment
        // session_start();
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', 300);

        $model = new AdminModel();
        $data = $model->getExportData();

        if (empty($data)) {
            die("No data found to export.");
        }

        $filename = "participants_abstract_" . date('Y-m-d') . ".csv";
        $f = fopen('php://memory', 'w');

        // Headers
        $fields = ['Registration Id', 'Abstract Code', 'Sub Theme', 'Type of Presentation', 'Category of Presentation', 'Title', 'Abstract', 'Author Name', 'Email', 'Designation', 'Comments'];
        fputcsv($f, $fields);

        // Rows
        foreach ($data as $line) {
            fputcsv($f, $line);
        }

        fseek($f, 0);

        // Download Headers
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        if (ob_get_level()) ob_clean();

        fpassthru($f);
        fclose($f);
        exit;
    }

    // get details of abstract submission of candidate
    public function abstract_details()
    {
        // session_start();
        $user_type = $_SESSION['usertype'];
        $model = new AdminModel;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Invalid ID");
        }

        // Fetch Data
        $abstract = $model->getAbstractById($id);
        $authorData = $model->getAuthorDetails($id);
        $comments = $model->getReviewerComments($id);
        $reviewers = $model->getAbstractReviewers();

        // $reviewers = $model->getAvailableReviewers();

        // Process Author Strings (explode CSV data)
        $authors = [];
        if ($authorData) {
            $firstNames = explode(",", $authorData['first_name']);
            // ... repeat for other fields ...
            for ($i = 0; $i < count($firstNames); $i++) {
                $authors[] = [
                    'name' => $firstNames[$i] . " " . explode(",", $authorData['last_name'])[$i],
                    'email' => explode(",", $authorData['author_email'])[$i],
                    'author_type' => explode(",", $authorData['author_type'])[$i],
                    'designation' => explode(",", $authorData['designation'])[$i],
                    'institution' => explode(",", $authorData['author_institution'])[$i],
                    'city' => explode(",", $authorData['author_city'])[$i],
                    'state' => explode(",", $authorData['author_state'])[$i],
                    'pincode' => explode(",", $authorData['author_pincode'])[$i],
                    // Add other fields as needed
                ];
            }
        }

        // Load the View
        // require_once __DIR__ . '/../views/admin/abstract_details.php';
        $content_file = __DIR__ . '/../views/admin/abstract_details.php';
        require_once __DIR__ . '/../views/main.php';
    }

    // assign reviewer to abstract submission by admin
    public function assignAbstractReviewer()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $participant_id = $_POST['participant_id'] ?? '';
            $abstract_code  = $_POST['abstract_code'] ?? '';
            $reviewer_id    = $_POST['reviewers'] ?? '';
            $currentYear = (int)date('Y');

            if (empty($participant_id) || empty($abstract_code) || empty($reviewer_id)) {
                echo "Missing required data";
                exit;
            }
            // session_start();
             $token = Csrf::getTokenFromRequest();
            if (!Csrf::validateToken($token)) {
                die("Security error: Invalid CSRF token");
            }
            $model = new AdminModel();
            $result = $model->assignAbstractReviewer($participant_id, $abstract_code, $reviewer_id, $currentYear    );

            if ($result) {
                echo "Successfully assigned and updated";
            } else {
                echo "Error: Unable to complete assignment";
            }
        }
    }


    // get all reviewer details for admin view                         (5. REVIEWER)
    public function reviewer_view()
    {
        // 1. Access Control (Authentication & Authorization)
        if ($this->isAuth()) {
            $user_type = $_SESSION['usertype'];
            $model = new AdminModel;
            $reviewers = $model->getAllReviewers();

            // 3. Define variables for the View
            $pageTitle = "Reviewer View";

            // 4. Load View
            // require_once __DIR__ . '/../views/admin/reviewer_view.php';
            $action = 'reviewer_view';
            $content_file = __DIR__ . '/../views/admin/reviewer_view.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

    // adding reviewer details by admin
    public function reviewer_add()
    {
        if ($this->isAuth()) {
            $user_type = $_SESSION['usertype'];
            // require_once __DIR__ . '/../views/admin/reviewer_add.php';
            $content_file = __DIR__ . '/../views/admin/reviewer_add.php';
            require_once __DIR__ . '/../views/main.php';
        } // 1. Access Control (Authentication & Authorization)
    }


    // AJAX: Handle Add Reviewer form submission
    public function ajaxAddReviewer()
    {

        date_default_timezone_set("Asia/Calcutta");


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $token = Csrf::getTokenFromRequest();
            if (!Csrf::validateToken($token)) {
                die("Security error: Invalid CSRF token");
            }

            // session_start();
            $model = new AdminModel;

            // 1. Generate Unique Reviewer Code
            $lastCode = $model->getLastReviewerCode();
            if (!$lastCode) {
                $reviewer_code = 'REV0001';
            } else {
                $reviewer_code = ++$lastCode;
            }

            // 2. Prepare Data Object
            $data = [
                'code'        => $reviewer_code,
                'name'        => $_POST['reviewer_name'],
                'phone'       => $_POST['reviewer_phone'],
                'email'       => $_POST['reviewer_email'],
                'designation' => $_POST['reviewer_designation'],
                'institution' => $_POST['reviewer_institution'],
                'address'     => $_POST['reviewer_address'],
                'type'        => $_POST['reviewer_type'],
                'created_by'  => $_SESSION['user_id'],
                'created_on'  => date('d-m-Y')
            ];

            // 3. Save via Model
            if ($model->saveReviewer($data)) {
                echo "Successfully Added to Login";
            } else {
                echo "Unable to add reviewer";
            }
        }
    }


    // get details of each reviewer 
    public function reviewer_details()
    {
        // global $conn;

        if ($this->isAuth()) {

            $id = $_GET['id'] ?? null;
            if (!$id) exit('ID Missing');

            $model = new AdminModel;
            $reviewer = $model->getReviewerById($id);

            if (!$reviewer) {
                exit('Reviewer not found');
            }

            // 3. Load the Partial View
            require_once __DIR__ . '/../views/admin/reviewer_details.php';
        }
    }
    

    // get all conference room details for admin view                         (6. CONFERENCE ROOM)
    public function conference_room_view()
    {
        // Auth Check
        if ($this->isAuth()) {
            $user_type = $_SESSION['usertype'];
            $model = new AdminModel;
            $data = [];
            $data = array_merge($data, $this->year_filter());
            $year = $data['selected_year'];
            $rooms = $model->getAllActiveRooms($year);

            // Pass data to the view
            // require_once __DIR__ . '/../views/admin/conference_room_view.php';
            $action = 'conference_room_view';
            $content_file = __DIR__ . '/../views/admin/conference_room_view.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

    
    // adding conference room details by admin
    public function conference_room_add()
    {
        // session_start();
        $user_type = $_SESSION['usertype'];
        // require_once __DIR__ . '/../views/admin/conference_room_add.php';
        $content_file = __DIR__ . '/../views/admin/conference_room_add.php';
        require_once __DIR__ . '/../views/main.php';
    }


    // AJAX: Handle Add Conference Room form submission
    public function store()
    {
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        //  Call Model
        // session_start();
        $userId = $_SESSION['user_id'];
        $model = new AdminModel;
        $success = $model->insertRoom($_POST, $userId);

        //  Response (Clean JSON for AJAX)
        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Successfully inserted']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database error']);
        }
    }
   

    //conference room details view in modal 
   public function conference_room_viewDetails()
    {
        $id = $_GET['id'];
        $model = new AdminModel;
        $data = $model->getRoomById($id);
        // In MVC, you usually include a small "partial" view file
        require_once __DIR__ . '/../views/admin/conference_room_details.php';
    }


    // get details of each conference room for edit
    public function conference_room_edit()
    {
        $id = $_GET['id'];
        // session_start();
        $user_type = $_SESSION['usertype'];
        $model = new AdminModel;
        $room = $model->getRoomById($id);
        if (!$room) {
            header('location:index.php?controller=admin&action=viewDetails');
            exit;
        }
        // Load the view and pass the $room variable
        // require_once __DIR__ . '/../views/admin/conference_room_edit.php';
        $content_file = __DIR__ . '/../views/admin/conference_room_edit.php';
        require_once __DIR__ . '/../views/main.php';
    }
   
    // AJAX: Handle Update Conference Room form submission
     public function updateConferenceRoom()
    {
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }
        $postData = $_POST;
        $model = new AdminModel;
        $success = $model->updateRoom($postData);
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }

    
    // AJAX: Handle Delete Conference Room action
    public function conference_room_delete()
    {
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }
        $id = $_POST['id'];
        $model = new AdminModel;
        $success = $model->deleteRoom($id);
        echo json_encode(['success' => $success]);
    }


    // get all certificate generation details for admin view                         (7. CERTIFICATE GENERATION)
    public function certificate_generates()
{
    // Auth check
    if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 'admin') {
        header('location:index.php?controller=authentication&action=login');
        exit;
    }

    $user_type = $_SESSION['usertype'];
    $model = new AdminModel;
    $data = [];
    $data = array_merge($data, $this->year_filter());
    $year = $data['selected_year'];
    $participants = $model->getParticipants($year);
    $coAuthors = $model->getCoAuthors($year);

    $certTypes = [
        "preconference_item_analysis" => "Pre-Conference Item Analysis",
        "mindful_map" => "Pre-Conference Workshop - Mindful Map",
        "sage" => "Pre-Conference SAGE",
        "itlm" => "Pre-Conference Interactive Teaching Learning Methods",
        "workshop_bridging" => "Workshop Course - Bridging Mind Building Care",
        "workshop_proms_prems" => "Enhancing Health Care Using PROMs, PREMs, and Experiences in Dentistry- Workshop",
        "workshop_microteaching" => "Microteaching Workshop",
        "first_place_paper" => "1st Place Paper Award",
        "second_place_paper" => "2nd Place Paper Award",
        "first_place_poster" => "1st Place Poster Award",
        "second_place_poster" => "2nd Place Poster Award",
        "first_place_yenvision" => "1st Place YenVision Award",
        "second_place_yenvision" => "2nd Place YenVision Award",
        "co_author_certificate" => "Co-Author certificate"
    ];

    $action = 'certificate_generates';
    $content_file = __DIR__ . '/../views/admin/certificate_generates.php';
    require_once __DIR__ . '/../views/main.php';
}


    // AJAX: Check if certificate already generated for a user and type
    public function checkStatusCertificate()
    {
      

        header('Content-Type: application/json'); 
        $user_id = $_GET['user'] ?? '';
        $cert_type = $_GET['type'] ?? '';

        if (empty($user_id) || empty($cert_type)) {
            echo json_encode(['generated' => false]);
            return;
        }

        // 3. Data Retrieval via Model
        $model = new AdminModel;
        $row = $model->getGenerationStatus($user_id, $cert_type);

        // 4. Response
        if ($row) {
            echo json_encode([
                'generated' => true,
                'date' => date('M d, Y', strtotime($row['generated_date']))
            ]);
        } else {
            echo json_encode(['generated' => false]);
        }
    }


    // AJAX: Batch generate certificates for selected users and type
    public function processGeneration()
    {
        // 1. Auth check
        // if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 'admin') {
        //     header('location:login.php');
        //     exit();
        // }

        // session_start();
         $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }
        // 2. Data Validation
        $certificate_type = $_POST['certificate_type'] ?? '';
        $users = $_POST['users'] ?? [];

        if (empty($certificate_type) || empty($users)) {
            header('location:index.php?controller=admin&action=certificate_generates&error=invalid');
            exit();
        }

        // 3. Logic: Call the Model
        $admin_id = $_SESSION['user_id'];
        $model = new AdminModel;
        $count = $model->batchGenerate($users, $certificate_type, $admin_id);

        // 4. Redirection
        header('location:index.php?controller=admin&action=certificate_generates&success=1&count=' . $count);
        exit();
    }

    //view generated certificate list by admin 
    public function viewGeneratedCertificates()
    {
        // Auth check
        // if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 'admin') {
        //     header('location:login.php');
        //     exit();
        // }
        // session_start();
        $user_type = $_SESSION['usertype'];
        $type = $_GET['type'] ?? 'all';
        $search = $_GET['search'] ?? '';
        $model = new AdminModel;
        // Data from Model
        $certificates = $model->getGeneratedList($type, $search);
        $stats = $model->getCertificateStats();
        $totalCount = $model->getTotalCount();

        // Mappings for the View
        $certTypes = [
            'preconference_item_analysis' => 'Pre-Conference Item Analysis',
            'mindful_map' => 'Pre-Conference Workshop - Mindful Map',
            'sage' => 'Pre-Conference SAGE',
            'itlm' => 'Pre-Conference Interactive Teaching Learning Methods',
            'workshop_bridging' => 'Workshop Course - Bridging Mind Building Care',
            'workshop_proms_prems' => 'Enhancing Health Care Using PROMs, PREMs, and Experiences in Dentistry- Workshop',
            'workshop_microteaching' => 'Microteaching Workshop',
            'first_place_paper' => '1st Place Paper Award',
            'second_place_paper' => '2nd Place Paper Award',
            'first_place_poster' => '1st Place Poster Award',
            'second_place_poster' => '2nd Place Poster Award',
            'first_place_yenvision' => '1st Place YenVision Award',
            'second_place_yenvision' => '2nd Place YenVision Award',
            'co_author_certificate' => 'Co-Author certificate'
        ];

        // require_once __DIR__ . '/../views/admin/generated_certificates.php';
        $action = 'viewGenerated';
        $content_file = __DIR__ . '/../views/admin/generated_certificates.php';
        require_once __DIR__ . '/../views/main.php';
    }


    // export generated certificate list in csv format by admin
    
    public function export_certificates()
{
    // Optional Auth Check
    // if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 'admin') {
    //     exit('Unauthorized');
    // }

    $type = $_GET['type'] ?? 'all';
    $search = $_GET['search'] ?? '';

    // Certificate type labels
    $certTypes = [
        'preconference_item_analysis' => 'Pre-Conference Item Analysis',
        'mindful_map' => 'Pre-Conference Workshop - Mindful Map',
        'sage' => 'Pre-Conference SAGE',
        'itlm' => 'Pre-Conference Interactive Teaching Learning Methods',
        'workshop_bridging' => 'Workshop Course - Bridging Mind Building Care'
    ];

    // Load model
    $model = new AdminModel();
    $data = $model->getCertificateExportData($type, $search);

    // Headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="Certificates_Export_' . date('Y-m-d') . '.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    // UTF-8 BOM (for Excel)
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    // CSV Headers
    fputcsv($output, [
        'Registration Code',
        'Participant Name',
        'Email',
        'Certificate Type',
        'Generated Date',
        'Generated By'
    ]);

    // Data rows
    foreach ($data as $row) {
        fputcsv($output, [
            $row['registration_code'],
            trim($row['honorofic'] . ' ' . $row['full_name']),
            $row['email'],
            $certTypes[$row['certificate_type']] ?? $row['certificate_type'],
            date('M d, Y h:i A', strtotime($row['generated_date'])),
            $row['generated_by']
        ]);
    }

    fclose($output);
    exit();
}

// get all contact details for admin view                         (8. CONTACT)
public function contact_view()
{
    if ($this->isAuth()) {
        $user_type = $_SESSION['usertype'];
        $model = new AdminModel();
        $contacts = $model->getAllContacts();

        // require_once __DIR__ . '/../views/admin/contact_view.php';
        $action = 'contact_view';
        $content_file = __DIR__ . '/../views/admin/contact_view.php';
        require_once __DIR__ . '/../views/main.php';
    }
}

    // get details of each contact message for admin view
    public function ajaxGetContactDetails()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model = new AdminModel();
            $data = $model->getContactById($id);
            // Pass data to a partial view or echo it directly
            require_once __DIR__ . '/../views/admin/contact_details.php';
        }
    }
    
}
 