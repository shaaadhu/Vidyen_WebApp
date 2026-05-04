<?php
define('ROOT', Env::get('MAIN_URL'));
define('BASE', Env::get('DASHBOARD_URL'));

define('DB_HOST', Env::get('DB_HOST'));
define('DB_USER', Env::get('DB_USER'));
define('DB_PASS', Env::get('DB_PASS'));
define('DB_NAME', Env::get('DB_NAME'));



class Config{

    public $db_conn;

    function __construct(){
        $this->db_conn=$this->connection();
    }
  

private function connection(){
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}else{
   
    return $conn;
}
}




}