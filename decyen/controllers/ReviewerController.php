<?php
require_once __DIR__ . '/../models/ReviewerModel.php';

class ReviewerController
{

    public function isAuth()
    {
        // session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] !== 'reviewer' || $_SESSION['user_id'] === '') {
            header('location:login.php');
            exit;
        }
        return true;
    }

    //reviewer abstract view 
    public function abstract_view()
    {
        if ($this->isAuth()) {
            $userid = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $rev_type = 'Abstract Reviewer';
            $model = new ReviewerModel();
            $abstracts = $model->getAssignedAbstracts($userid);


            // 3. Load View
            $content_file = __DIR__ . '/../views/reviewer/abstract_view.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

    //reviewer abstract verify 
    public function abstract_verify()
    {
        $id = $_GET['id'] ?? '';

        if (!$id) {
            echo "Invalid Abstract ID";
            return;
        }
        $model = new ReviewerModel();
        $abstract = $model->getAbstractForEvaluation($id);

        if ($abstract) {
            // Include the partial view file
            require_once __DIR__ . '/../views/reviewer/abstract_verify.php';
        } else {
            echo "No data found for this abstract.";
        }
    }


    // save abstract comment
    public function save_abstract_comment()
    {
        // 1. Auth Check (Reviewer only)
        if ($this->isAuth()) {

            $abstractCode = $_POST['abstract_code'] ?? '';
            $comment = $_POST['comment'] ?? '';

            if (empty($abstractCode) || empty($comment)) {
                echo json_encode(['status' => 'error', 'message' => 'Missing data']);
                exit;
            }

            $token = Csrf::getTokenFromRequest();
            if (!Csrf::validateToken($token)) {
                die("Security error: Invalid CSRF token");
            }
            // 3. Logic: Update DB
            $model = new ReviewerModel();
            $success = $model->saveEvaluation($abstractCode, $comment);

            // 4. Response
            if ($success) {
                echo "Successfully updated";
            } else {
                echo "Unable to update database";
            }
        }
        // 2. Get Input

    }

     //reviewer preconference view 
    public function preconference_view()
    {
        // 1. Authentication Check
        if ($this->isAuth()) {
            $userId = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $rev_type = 'PreConference Reviewer';
            $model = new ReviewerModel();
            $assignments = $model->getPreConferenceAssignments($userId);

            // 3. Load View
            $content_file = __DIR__ . '/../views/reviewer/preconference_view.php';
            require_once __DIR__ . '/../views/main.php';
        }
        // 2. Data Retrieval

    }

    //reviewer preconference verify 
    public function preconfernce_verify()
    {
        $id = $_GET['id'] ?? '';

        if (empty($id)) {
            echo "Invalid ID";
            return;
        }
        $model = new ReviewerModel();
        $data = $model->getPreConferenceForReview($id);

        if ($data) {
            // Include the specific View fragment
            require_once __DIR__ . '/../views/reviewer/preconference_verify.php';
        } else {
            echo "Data not found.";
        }
    }

     // save preconference comment
    public function save_preconference_comment()
    {
        if ($this->isAuth()) {

            $abstractCode = $_POST['abstract_code'] ?? '';
            $comment = $_POST['comment'] ?? '';

            if (empty($abstractCode) || empty($comment)) {
                echo "Missing required information";
                exit;
            }

            // 3. Process Logic

            $token = Csrf::getTokenFromRequest();
            if (!Csrf::validateToken($token)) {
                die("Security error: Invalid CSRF token");
            }
            
            $model = new ReviewerModel();
            $result = $model->submitPreConferenceEvaluation($abstractCode, $comment);

            // 4. Return Response
            if ($result) {
                echo "successfully updated";
            } else {
                echo "unable to update database";
            }
        }

        // 2. Capture Input

    }

    //reviewer workshop view 
    public function workshop_view()
    {
        // 1. Auth Check
        if ($this->isAuth()) {

            // 2. Data Retrieval
            $reviewerId = $_SESSION['user_id'];
            $user_type = $_SESSION['usertype'];
            $rev_type = 'Workshop Reviewer';

            $model = new ReviewerModel();
            $assignments = $model->getWorkshopAssignments($reviewerId);

            // 3. Load View
            $content_file = __DIR__ . '/../views/reviewer/workshop_view.php';
            require_once __DIR__ . '/../views/main.php';
        }
    }

     //reviewer workshop verify 
    public function workshop_verify()
    {
        // Ensure user is a reviewer
        if ($this->isAuth()) {



            $id = $_GET['id'] ?? '';
            if (empty($id)) {
                echo "Invalid Workshop ID";
                return;
            }

            $model = new ReviewerModel();
            $data = $model->getWorkshopForReview($id);

            if ($data) {
                // Load the partial view
                require_once __DIR__ . '/../views/reviewer/workshop_verify.php';
            } else {
                echo "Workshop details not found.";
            }
        }
    }

    // save workshop comment
    public function save_workshop_comment()
    {
        // 1. Authorization check
        if ($this->isAuth()) {

            // 2. Capture and validate input
            $workshopId = $_POST['workshop_id'] ?? ''; // or 'abstract_code' based on your form
            $comment = $_POST['comment'] ?? '';

            if (empty($workshopId) || empty($comment)) {
                echo "Missing required information";
                exit;
            }

            $token = Csrf::getTokenFromRequest();
            if (!Csrf::validateToken($token)) {
                die("Security error: Invalid CSRF token");
            }

            // 3. Model Logic
            $model = new ReviewerModel();
            $result = $model->submitWorkshopEvaluation($workshopId, $comment);

            // 4. Return Response
            if ($result) {
                echo "successfully updated";
            } else {
                echo "unable to update database";
            }
        }
    }
}
