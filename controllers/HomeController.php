<?php
require_once __DIR__ . '/../models/RegistrationModel.php';

class HomeController
{
    public function home()
    {
        $action = 'home';
        $this->view($action);
    }

    public function about()
    {
        $action = 'about';
        $this->view($action);
    }

    public function organizing_committee()
    {
        $action = 'organizing_committee';
        $this->view($action);
    }

    public function advisory_committee()
    {
        $action = 'advisory_committee';
        $this->view($action);
    }

    public function virtual_booth()
    {
        $action = 'virtual_booth';
        $this->view($action);
    }

    public function theme_sub_theme()
    {
        $action = 'theme_sub_theme';
        $this->view($action);
    }

    public function scientific_guidelines()
    {
        $action = 'scientific_guidelines';
        $this->view($action);
    }

    public function scientific_brochure()
    {
        $action = 'scientific_brochure';
        $this->view($action);
    }

    public function keynote_speakers()
    {
        $action = 'keynote_speakers';
        $this->view($action);
    }

    public function symposium()
    {
        $action = 'symposium';
        $this->view($action);
    }

    public function scientific_schedule()
    {
        $action = 'scientific_schedule';
        $this->view($action);
    }

    public function previous_conference()
    {
       $version = $_GET['version'] ?? '1';

       $versionConfig = [
    '1' => [
        'souvenir'    => 65,
        'newsletter'  => 27,
        'schedule'    => 5,
        'winner'      => 2,
    ],
    '2' => [
        'souvenir'    => 1,
        'newsletter'  => 21,
        'schedule'    => 9,
        'winner'      => 13,
    ],
    '3' => [
        'souvenir'    => 1,
        'newsletter'  => 23,
        'schedule'    => 1,
        'winner'      => 1,
    ],
];

$config = $versionConfig[$version] ?? $versionConfig['1']; // fallback to 1
       
        $data = [
    'souvenir_images'   => $this->getGalleryImages("{$version}_souvenir",    "VIDYEN Sovenir_page-",         $config['souvenir']),
    'newsletter_images' => $this->getGalleryImages("{$version}_newsletter",  "VIDYEN newsletter_page-",   $config['newsletter']),
    'schedule_images'   => $this->getGalleryImages("{$version}_schedule",    "Vidyen schedule_page-",        $config['schedule']),
    'winner_images'     => $this->getGalleryImages("{$version}_winner",       "Winners list_page-",           $config['winner']),
];

        $action = 'previous_conference';
        $this->view($action, $data);
    }
   


    

    public function contact()
    {
        $action = 'contact';
        $this->view($action);
    }

    public function save_contact()
    {
         $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        // Validate reCAPTCHA
        $recaptchaToken = Recaptcha::getToken();
        if (!Recaptcha::validateToken($recaptchaToken)) {
            die("reCAPTCHA verification failed. Please try again.");
        }

        $model = new RegistrationModel();
        $saved = $model->saveContact();
        if ($saved) {
        
        ?>
            <script>
                alert('Your message has been Submitted');
                window.location.assign('index.php?controller=home&action=contact');
            </script>;
        <?php
        } else {
        ?>
            <script>
                alert('Something went wrong...');
                window.location.assign('index.php?controller=home&action=contact');
            </script>;
        <?php
        }
       
    }


    public function registration_details()
    {
        $action = 'registration_details';
        $this->view($action);
    }

    public function registration()
    {
        $action = 'registration';
        $this->view($action);
    }


    public function check_email()
    {
         // Validate CSRF token
         $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Invalid CSRF token");
        }
        
        $email = $_POST['email'];
        $model = new RegistrationModel();
        $available = $model->emailAvailabale($email);
        if ($available) {
            $response = "<span style='color: green;'>Available.</span><input type='hidden'type='text' id='email_exist'value='0'>";
        } else {
            $response = "<span style='color: red;'>Email Id already exists. Try another Email Id</span><input type='hidden'type='text' id='email_exist'value='1'>";
        }

        echo $response;
    }

    
    public function register_user()
    {
        $token = Csrf::getTokenFromRequest();
        if (!Csrf::validateToken($token)) {
            die("Security error: Invalid CSRF token");
        }

        $recaptchaToken = Recaptcha::getToken();
        if (!Recaptcha::validateToken($recaptchaToken)) {
            die("reCAPTCHA verification failed. Please try again.");
        }
        
        $model = new RegistrationModel();
        // Prepare data from $_POST
        // $pre_type = !empty($_POST['pre_type']) ? implode(',', $_POST['pre_type']) : '';
        $presentation = !empty($_POST['presentation']) ? implode(',', $_POST['presentation']) : '';

        $formData = $_POST;
        // $formData['podium_lecture'] = $pre_type;
        $formData['presentation'] = $presentation;
        $formData['code'] = $model->generateRegisterCode();

        if ($model->registerUser($formData)) {

            ob_start();      
            $user_name = $formData['full_name'];
            $register_code = $formData['code'];  // FIX: Use from $formData      
            $Amt1 = ($formData['delegate_type'] == 'National') ? '5000' : '10000'; 
            $link = 'https://rzp.io/rzp/v96ZKQn';  //            
            $delegate_type = $formData['delegate_type'];
            $email = $formData['email'];
            $mobile = $formData['mobile'];
            include __DIR__ . '/../views/registration_email.php';
            $body = ob_get_clean();

            $mailService = new MailService();
            $mailService->sendMail(
                $formData['email'],
                $formData['full_name'],
                "VIDYEN Conference Karnataka 2025 - Yenepoya Dental College",
                $body
            );

            echo "success";
        } else {
            echo "error";
        }
        exit;
    }



    public static function getGalleryImages($folder, $prefix, $totalCount)
    {
        $images = array();
        // Path relative to your public index.php
        $basePath = "assets/images/previous_conference/$folder/";

        for ($i = 1; $i <= $totalCount; $i++) {
            $page_num = str_pad($i, 4, '0', STR_PAD_LEFT);
            $fileName = $prefix . $page_num . ".jpg";
            $images[] = $basePath . $fileName;
        }
        return $images;
    }



    protected function view($action, $data = [])
    {
        // 1. extract data only if it exists
        if (!empty($data)) {
            extract($data);
        }
        
        $file = __DIR__ . '/../views/' . $action . '.php';
        require_once __DIR__ . '/../views/main.php';

       
    }
}