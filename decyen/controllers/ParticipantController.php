<?php
require_once __DIR__ . '/../models/ParticipantModel.php';
class ParticipantController
{

    // check if participant is authenticated
    public static function isAuth()
    {
        // session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 'participant' || ($_SESSION['user_id'] == '')) {
            header('Location: index.php?controller=login&action=login_page');
            exit();
        }
        return true;
    }

    // participant registration details view
    public function regestration_view()
    {
        if ($this->isAuth()) {
            $userid = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $model = new ParticipantModel();
            $row = $model->getParticipantDetails($userid);
            // require_once __DIR__ . '/../views/participant/registration_view.php';
            $content_file = __DIR__ . '/../views/participant/registration_view.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

    // Submitted Pre-Conference View
    public function preconference_view()
    {
        if ($this->isAuth()) {
            $userId = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $model = new ParticipantModel();
            $submissions = $model->getSubmissionsByUserId($userId);

            // 3. Load View

            $content_file = __DIR__ . '/../views/participant/preconference_view.php';
            require_once __DIR__ . '/../views/main.php';

            // 2. Data Retrieval

        }
    }

    // Pre-Conference Details View
    public function preconference_details()
    {
        // session_start();
        $id = $_GET['id'] ?? '';
        if (!$id) header('location:index.php');
        $user_type = $_SESSION['usertype'];
        $model = new ParticipantModel();
        $data['details'] = $model->getPreConferenceDetailsById($id);
        $data['authors'] = $model->getAuthorsByAbstractId($id);
        $data['comments'] = $model->getReviewerComments($id);
        $data['reviewers'] = $model->getAvailableReviewers();

        // Load View

        $content_file = __DIR__ . '/../views/participant/preconference_details.php';
        require_once __DIR__ . '/../views/main.php';
    }

    // Pre-Conference Submission View
    public function preconference_submission()
    {
        if ($this->isAuth()) {
            $userid = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $email = $_SESSION['email'];



            // require_once __DIR__ . '/../views/participant/preconference_submission.php';
            $content_file = __DIR__ . '/../views/participant/preconference_submission.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

    // Pre-Conference Save Handler
    public function preconference_save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

        // Validate CSRF token
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        // session_start();

        $model = new ParticipantModel;

        // Prepare main data
        $mainData = [
            'participant_id'      => $_POST['participant_id'],
            'pre_confernce_id'    => $model->generatePreConferenceId(),
            'sub_theme'           => $_POST['subthemes'],
            'paper_title'         => $_POST['paper_title'],
            'keywords'            => $_POST['keyword_preconference'],
            'background'          => $_POST['abstract_background'],
            'rationale'           => $_POST['abstract_rationale'],
            'objective'           => $_POST['abstract_objective'],
            'outcome'             => $_POST['abstract_outcome'],
            'structure'           => $_POST['abstract_structure'],
            'description'         => $_POST['abstract_description'],
            'participant'         => $_POST['participant'],
            'participant_desc'    => $_POST['participant_description'],
            'max_participants'    => $_POST['max_participants'],
            'workshop_overview'   => $_POST['workshop_overview'],
            'created_by'          => $_SESSION['user_id'],
            'created_on'          => date('d-m-Y')
        ];

        // Prepare comma-separated author data
        $authorData = [
            'first_name'  => implode(',', $_POST['first_name']),
            'middle_name' => implode(',', $_POST['middle_name']),
            'last_name'   => implode(',', $_POST['last_name']),
            'email'       => implode(',', $_POST['email']),
            'type'        => implode(',', $_POST['type_author']),
            'designation' => implode(',', $_POST['designation']),
            'institution' => implode(',', $_POST['institution']),
            'city'        => implode(',', $_POST['city']),
            'state'       => implode(',', $_POST['state']),
            'country'     => implode(',', $_POST['country']),
            'pincode'     => implode(',', $_POST['pincode'])
        ];


        if ($model->savePreconferenceSubmission($mainData, $authorData)) {

      ?>
<script type="text/javascript">
alert("Thank you for your submission. We will be in touch with you soon.");
window.location.assign('index.php?controller=participant&action=preconference_view');
</script>
<?php
            
        } else {
        ?>
<script type="text/javascript">
alert("Not submitted.");
window.location.assign('index.php?controller=participant&action=preconference_submission');
</script>
<?php
                    
                }
    }


    // Submitted Workshop View
    public function workshop_view()
    {
        // 1. Participant Auth Check
        // 
        if ($this->isAuth()) {
            $user_type = $_SESSION['usertype'];
            $userId = $_SESSION['user_id'];
            $model = new ParticipantModel;
            $workshops = $model->getWorkshopSubmissions($userId);

            // 3. Load the View
            $content_file = __DIR__ . '/../views/participant/workshop_view.php';
            require_once __DIR__ . '/../views/main.php';
        }

        // 2. Fetch Data

    }


    // Workshop Details View
    public function workshop_details()
    {
        // session_start();
        $id = $_GET['id'] ?? '';
        if (!$id) header('location:index.php');
        $user_type = $_SESSION['usertype'];
        $model = new ParticipantModel();
        $data['details'] = $model->getWorkshopDetailsById($id);
        $data['authors'] = $model->getAuthorsByAbstractId($id);
        $data['comments'] = $model->getReviewerComments($id);
        $data['reviewers'] = $model->getAvailableReviewers();

        // Load View

        $content_file = __DIR__ . '/../views/participant/workshop_details.php';
        require_once __DIR__ . '/../views/main.php';
    }




    // Workshop Submission View
    public function workshop_submission()
    {
        if ($this->isAuth()) {
            $userid = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $email = $_SESSION['email'];
            $content_file = __DIR__ . '/../views/participant/workshop_submission.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

    // Save Workshop Submission
    public function workshop_save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

        // Validate CSRF token
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        // session_start();

        $model = new ParticipantModel;

        // Prepare main data
        $mainData = [
            'participant_id'      => $_POST['participant_id'],
            'pre_confernce_id'    => $model->generateWorkshopId(),
            'sub_theme'           => $_POST['subthemes'],
            'paper_title'         => $_POST['paper_title'],
            'keywords'            => $_POST['keyword_preconference'],
            'background'          => $_POST['abstract_background'],
            'rationale'           => $_POST['abstract_rationale'],
            'objective'           => $_POST['abstract_objective'],
            'outcome'             => $_POST['abstract_outcome'],
            'structure'           => $_POST['abstract_structure'],
            'description'         => $_POST['abstract_description'],
            'participant'         => $_POST['participant'],
            'participant_desc'    => $_POST['participant_description'],
            'max_participants'    => $_POST['max_participants'],
            'workshop_overview'   => $_POST['workshop_overview'],
            'created_by'          => $_SESSION['user_id'],
            'created_on'          => date('d-m-Y')
        ];

        // Prepare comma-separated author data
        $authorData = [
            'first_name'  => implode(',', $_POST['first_name']),
            'middle_name' => implode(',', $_POST['middle_name']),
            'last_name'   => implode(',', $_POST['last_name']),
            'email'       => implode(',', $_POST['email']),
            'type'        => implode(',', $_POST['type_author']),
            'designation' => implode(',', $_POST['designation']),
            'institution' => implode(',', $_POST['institution']),
            'city'        => implode(',', $_POST['city']),
            'state'       => implode(',', $_POST['state']),
            'country'     => implode(',', $_POST['country']),
            'pincode'     => implode(',', $_POST['pincode'])
        ];


        if ($model->saveWorkshopSubmission($mainData, $authorData)) {

        ?>
<script type="text/javascript">
alert("Thank you for your submission. We will be in touch with you soon.");
window.location.assign('index.php?controller=participant&action=workshop_view');
</script>
<?php
            
        } else {
        ?>
<script type="text/javascript">
alert("Not submitted.");
window.location.assign('index.php?controller=participant&action=workshop_submission');
</script>
<?php
                
                }
    }


    // View Abstracts
    public function abstract_view() {
        // Authentication check
        if ($this->isAuth()) {
            $user_type = $_SESSION['usertype'];
             $participantId = $_SESSION['user_id'];
              $model = new ParticipantModel;
        $abstracts = $model->getAbstractsByParticipant($participantId);

        // Load the View
        $content_file = __DIR__ . '/../views/participant/abstract_view.php';
            require_once __DIR__ . '/../views/main.php';
           
        }

       
    }

    // Abstract Details View
    public function abstract_details()
    {
        // session_start();
        $id = $_GET['id'] ?? '';
        if (!$id) header('location:index.php');
        $user_type = $_SESSION['usertype'];
        $model = new ParticipantModel();
        $data['details'] = $model->getAbstractDetailsById($id);
        $data['authors'] = $model->getAuthorsByAbstractId($id);
        // $data['comments'] = $model->getReviewerComments($id);
        // $data['reviewers'] = $model->getAvailableReviewers();

        // Load View

        $content_file = __DIR__ . '/../views/participant/abstract_details.php';
        require_once __DIR__ . '/../views/main.php';
    }


    // Abstract Creation View
    public function abstract_create(){
        if ($this->isAuth()) {
            $userid = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $email = $_SESSION['email'];
            $content_file = __DIR__ . '/../views/participant/abstract_create.php';
            require_once __DIR__ . '/../views/main.php';
        }

    }

    // Save Abstract Submission
    public function abstract_save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

         // Validate CSRF token
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        // session_start();

        $model = new ParticipantModel;

        // Prepare main data
       // Prepare Main Abstract Data
        $mainData = [
            'register_id'       => $_POST['register_id'],
            'abstract_id'       => $model->generateAbstractId(), // Using your ID generator
            'sub_themes'        => $_POST['sub_themes'],
            'type_presentation' => $_POST['type_presentation'],
            'cat_presentation'  => $_POST['cat_presentation'],
            'title_paper'       => $_POST['title_paper'],
            'keywords'          => $_POST['keywords'],
            'abstract_details'  => $_POST['abtract_details'], // Note: Model handles escaping
            'created_by'        => $_SESSION['user_id'],
            'created_on'        => date('d-m-Y')
        ];

        // Prepare Comma-Separated Author Data
        $authorData = [
            'prefix'      => implode(',', $_POST['prefix']),
            'first_name'  => implode(',', $_POST['first_name']),
            'middle_name' => implode(',', $_POST['middle_name']),
            'last_name'   => implode(',', $_POST['last_name']),
            'email'       => implode(',', $_POST['email']),
            'type'        => implode(',', $_POST['type_author']),
            'designation' => implode(',', $_POST['designation']),
            'institution' => implode(',', $_POST['institution']),
            'city'        => implode(',', $_POST['city']),
            'state'       => implode(',', $_POST['state']),
            'country'     => implode(',', $_POST['country_name']),
            'pincode'     => implode(',', $_POST['pincode'])
        ];


        if ($model->saveAbstractSubmission($mainData, $authorData)) {

        ?>
<script type="text/javascript">
alert("Thank you for your submission. We will be in touch with you soon.");
window.location.assign('index.php?controller=participant&action=abstract_view');
</script>
<?php
                    
                } else {
                ?>
<script type="text/javascript">
alert("Not submitted.");
window.location.assign('index.php?controller=participant&action=abstract_submission');
</script>
<?php
                
                }
    }


    // View Certificates
    public function certificates_view() {
        // Auth check
        if ($this->isAuth()) {
             $user_type = $_SESSION['usertype'];
           $userId = $_SESSION['user_id'];
           $model = new ParticipantModel;
        
        // Prepare Data for View
        $data['generated_certs'] = array_column($model->getUserGeneratedCerts($userId), 'certificate_type');
        $data['has_paper'] = $model->hasPaperPresentation($userId);
        $data['has_poster'] = $model->hasPosterPresentation($userId);
        $data['has_yenvision'] = $model->hasYenvisionPresentation($userId);

        // Helper function for the view
        function isGenerated($type, $list) {
            return in_array($type, $list);
        
        }

        $content_file = __DIR__ . '/../views/participant/certificates_view.php';
            require_once __DIR__ . '/../views/main.php';
        }

        
    }

    public function co_author_certificates(){
         if ($this->isAuth()) {
             $user_type = $_SESSION['usertype'];
           $userId = $_SESSION['user_id'];
           $model = new ParticipantModel;
           $coauthor_result = $model->coAuthorDetails($userId);

            // if(mysqli_num_rows($coauthor_result) > 0){
            //     while ($row = mysqli_fetch_assoc($coauthor_result)){

            //         $first_names  = explode(',', $row['first_name']);
            //         $middle_names = explode(',', $row['middle_name']);
            //         $last_names   = explode(',', $row['last_name']);

            //         // Remove first element (Present Author)
            //         array_shift($first_names);
            //         array_shift($middle_names);
            //         array_shift($last_names);

            //         // Get count of co-authors
            //         $count = count($first_names);

            //         for ($i = 0; $i < $count; $i++){


            //             $fname = trim($first_names[$i]);
            //             $mname = trim($middle_names[$i]);
            //             $lname = trim($last_names[$i]);

                        
            //             $full_name = 'Dr.'. ' ' . $fname . ' ' . $mname . ' ' . $lname;

            //         }

            


            //     }

            // }
            
        $coAuthors = [];
        if ($coauthor_result) {
            while ($row = mysqli_fetch_assoc($coauthor_result)) {
                $firstNames  = array_map('trim', explode(',', $row['first_name']));
                $middleNames = array_map('trim', explode(',', $row['middle_name']));
                $lastNames   = array_map('trim', explode(',', $row['last_name']));

                // Remove first element (main/presenting author)
                array_shift($firstNames);
                array_shift($middleNames);
                array_shift($lastNames);

                $count = count($firstNames);
                for ($i = 0; $i < $count; $i++) {
                    $fname = $firstNames[$i] ?? '';
                    $mname = $middleNames[$i] ?? '';
                    $lname = $lastNames[$i] ?? '';
                    if ($fname !== '') {
                        $fullName = trim('Dr. ' . $fname . ' ' . $mname . ' ' . $lname);
                        $coAuthors[] = ['full_name' => $fullName];
                    }
                }
            }
        }


            
        $content_file = __DIR__ . '/../views/participant/co_author_certificates.php';
            require_once __DIR__ . '/../views/main.php';

         }
    }
}    