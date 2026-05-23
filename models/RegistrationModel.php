<?php

class RegistrationModel
{
    private $db;

    public function __construct()
    {
        $config = new Config();
        // Grab the connection property
        $this->db = $config->db_conn;
    }

    public function saveContact()
        {
        
        
            date_default_timezone_set("Asia/Calcutta");


            $enname = $_POST["name"];
            $phone_number = $_POST["phone_number"];
            $enemail = $_POST["email"];
            $subject = $_POST["subject"];
            $message = addslashes($_POST["message"]);

            $created_on = date('d-m-Y H:i:s A');

            $query = "INSERT INTO `contact`(`name`, `phone_number`, `email`, `subject`, `message`, `created_on`) VALUES ('$enname','$phone_number','$enemail','$subject','$message','$created_on')";
            if (mysqli_query($this->db, $query)) {

                return true;
                // echo "Successfully";
            } else {
                return false;
                // echo "Un Success";
            }
        }

    public function emailAvailabale($email)
    {
        if (isset($email)) {
            $email = mysqli_real_escape_string($this->db, $email);

            $query = "select count(*) as cntUser from registration where `email`='$email' AND `flag`= '0'";

            $result = mysqli_query($this->db, $query);
            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_array($result);

                $count = $row['cntUser'];

                if ($count > 0) {
                    return false;
                    // $response = "<span style='color: red;'>Email Id already exists. Try another Email Id</span><input type='hidden'type='text' id='email_exist'value='1'>";
                    // $rescount = "1";
                } else {
                    return true;
                    // $response = "<span style='color: green;'>Available.</span><input type='hidden'type='text' id='email_exist'value='0'>";

                    // $rescount = "0";
                }
            }

            // echo $response;
            // die;
        }
    }

    public function generateRegisterCode() {
        $query = "SELECT `registration_code` FROM registration ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($this->db, $query);
        
        if (mysqli_num_rows($result) <= 0) {
            return 'VIDYEN/1000001';
        } else {
            $data = mysqli_fetch_assoc($result);
            $cur_code = $data['registration_code'];
            return ++$cur_code; 
        }
    }

    public function registerUser($data) {
        // Sanitize all inputs
        foreach ($data as $key => $value) {
            $data[$key] = mysqli_real_escape_string($this->db, $value);
        }

        $query = "INSERT INTO `registration`(`registration_code`, `honorofic`, `full_name`, `age`, `gender`, `type_of_delegate`, `designation`, `college_name`, `university_name`, `full_address`, `city`, `state`, `country`, `pincode`, `email`, `phone_number`, `pre_conference`, `podium_lecture`, `scientific_presentation`,`year`) 
                  VALUES ('{$data['code']}','{$data['title1']}','{$data['full_name']}','{$data['age']}','{$data['gender']}','{$data['delegate_type']}','{$data['designation']}','{$data['college_name']}','{$data['university_name']}','{$data['full_address']}','{$data['city']}','{$data['state']}','{$data['country']}','{$data['pincode']}','{$data['email']}','{$data['mobile']}','{$data['pre_conference']}','{$data['podium_lecture']}','{$data['presentation']}','{$data['year']}')";

        if (mysqli_query($this->db, $query)) {
            // Also insert into login table
            $user_name = $data['title1'] . ' ' . $data['full_name'];
            $query_login = "INSERT INTO `login`( `user_id`, `user_name`, `user_email`, `password`,`usertype`) 
                            VALUES ('{$data['code']}','$user_name','{$data['email']}','{$data['mobile']}','participant')";
            return mysqli_query($this->db, $query_login);
        }else {
    // This will print the error to your Network Tab
    die(mysqli_error($this->db)); 
}
        return false;
    }

}
