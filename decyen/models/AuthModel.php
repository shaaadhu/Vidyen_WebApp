<?php
class AuthModel {
    private $conn;

    public function __construct() {
        
        $config = new Config();
        // Grab the connection property
        $this->conn = $config->db_conn;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM login WHERE user_email=? AND password=?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // updating password and setting status to 2 for reset password
    public function update_password($newpassword, $userid){
       $query = "UPDATE `login` SET `password`='$newpassword',`status`='2' WHERE `user_id`='$userid'";
        if (mysqli_query($this->conn, $query)) {
            return true;
        } else {
           return false;
        }
    }

}