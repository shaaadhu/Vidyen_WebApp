<?php
require_once __DIR__ . '/../models/AuthModel.php';
require_once __DIR__ . '/../models/DashboardModel.php';
require_once __DIR__ . '/../../core/Csrf.php';
class AuthenticationController
{
   public function login()
    {
        
        require_once __DIR__ . '/../views/login.php';
    }

    // authenticate user and redirect to dashboard
  
    public function authenticate()
    {
        // session_start();
        
        // Validate CSRF token FIRST (before session regeneration)
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Invalid CSRF token");
        }

        $recaptchaToken = Recaptcha::getToken();
        if (!Recaptcha::validateToken($recaptchaToken)) {
            die("reCAPTCHA verification failed. Please try again.");
        }
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $model = new AuthModel;
        $row = $model->login($username, $password);
        
        if ($row) {
            $status = $row['status'];
            if ($status == '0') {
            ?>
                <script>
                    alert('Account approval is in process.');
                    window.location.assign('index.php?controller=authentication&action=login');
                </script>;
            <?php
            } elseif ($status == '1') {
                $userid = $row['user_id'];
                require_once __DIR__ . '/../views/update_password.php';
            } elseif ($status == '2') {
                // Now regenerate session AFTER validation
                session_regenerate_id(true);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['user_name'];
                $_SESSION['usertype'] = $row['usertype'];
                header('location:index.php?controller=authentication&action=dashboard');
                session_write_close();
            }
        } else {
            ?>
            <script>
                alert('Invalid Username/Password.');
                window.location.assign('index.php?controller=authentication&action=login');
            </script>;
            <?php
        }
    }

    // main dashboard for all users with stats
    public function dashboard()
    {
        
        // session_start();

        if (isset($_SESSION['user_id']) && ($_SESSION['usertype'] == '') || ($_SESSION['usertype'] == '')) {
            header('location:index.php?controller=authentication&action=login');
        }
        $user_type = $_SESSION['usertype'];
        $userid = $_SESSION['user_id'];
        $model = new DashboardModel();
        $data = [];
        // $year = $_GET['filter_year'] ?? '2025';
         $currentYear = (int)date('Y');
         $year = isset($_GET['filter_year']) ? $_GET['filter_year'] : (string)$currentYear;

        // Pass year options to view: current year + 2 previous years
        $data['year_options'] = [
            (string)$currentYear      => (string)$currentYear,
            (string)($currentYear - 1) => (string)($currentYear - 1)
            // (string)($currentYear - 2) => (string)($currentYear - 2),
        ];
        $data['selected_year'] = $year;

        $data['rooms'] = $model->getConferenceRooms($year);
        if ($user_type == 'admin') {
            
            $data['stats'] = [
                'Total Registration' => $model->getCount('registration','year='.$year),
                'Pre-Conference Submitted' => $model->getCount('pre_conference', "YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year"),
                'Abstract Submitted' => $model->getCount('abstract', "YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year"),
                'Workshop Submitted' => $model->getCount('workshop', "YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year")
            ];
        } elseif ($user_type == 'participant') {
            $data['stats'] = [
                'Pre-Conference Submitted' => $model->getCount('pre_conference', "registration_id='$userid'"),
                'Pre-Conference Evaluated' => $model->getCount('pre_conference', "registration_id='$userid' AND status='2'"),
                'Pre-Conference Pending'   => $model->getCount('pre_conference', "registration_id='$userid' AND status!='2'"),
                'Abstract Submitted'       => $model->getCount('abstract', "registration_id='$userid'"),
                'Abstract Evaluated'       => $model->getCount('abstract', "registration_id='$userid' AND status='2'"),
                'Abstract Pending'         => $model->getCount('abstract', "registration_id='$userid' AND status!='2'"),
                'Workshop Submitted'       => $model->getCount('workshop', "registration_id='$userid'"),
                'Workshop Evaluated'       => $model->getCount('workshop', "registration_id='$userid' AND status='2'"),
                'Workshop Pending'         => $model->getCount('workshop', "registration_id='$userid' AND status!='2'")
            ];
        } elseif ($user_type == 'reviewer') {
            $rev_type = $model->getReviewer($userid);
            // Simple logic to clean up labels
            $label = str_replace(' Reviewer', '', $rev_type);
            $data['reviewer_label'] = $label;
            $data['stats'] = [
                "Total $label"    => $model->getCount('assign_reviewer', "reviewer_id='$userid'"),
                "Pending $label"  => $model->getCount('assign_reviewer', "reviewer_id='$userid' AND status!=1"),
                "Reviewed $label" => $model->getCount('assign_reviewer', "reviewer_id='$userid' AND status=1")
            ];
        } 
        $action='dashboard';
        $content_file = __DIR__ . '/../views/dashboard.php';
        require_once __DIR__ . '/../views/main.php';
        exit;
    }
    

    // updating password
   
    public function ajaxUpdatePassword()
    {
        // session_start();
        
        // Validate CSRF token
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }
        
        $username = $_POST['useremail'];
        $newpassword = $_POST['new_password'];
        $userid = $_POST['userid'];
        $model = new AuthModel;

        $result = $model->update_password($newpassword, $userid);
        if ($result) {
        ?>
            <script>
                alert('Password Reset Successful.');
                window.location.assign('index.php?controller=authentication&action=login');
            </script>;
        <?php
        } else {
            echo "Failed to update password.";
        }
    }


    
    public function logout()
    {
        // Destroy session and clear session cookie
        $_SESSION = [];
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        
        // Redirect to login with fresh session
        header('location:index.php?controller=authentication&action=login');
        exit;
    }
}