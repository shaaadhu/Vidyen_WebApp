<?php
class DashboardModel {
    private $db;

    public function __construct() {
        $config = new Config();
        // Grab the connection property
        $this->db = $config->db_conn;
    }

  
    public function getConferenceRooms($year) {
        if ($year) {
            $year = (int)$year; // sanitize
            $condition = "AND YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year";
        } else {
            $condition = ""; // show all years
        }

        $query = "SELECT * FROM conference_room 
                WHERE deleted = 0 
                $condition
                ORDER BY id ASC";

        $result = mysqli_query($this->db, $query);
        $rooms = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rooms[$row['type']][] = $row;
    }
    return $rooms;
}
    public function getCount($table, $where = "") {
        $query = "SELECT count(*) as total FROM `$table` " . ($where ? "WHERE $where" : "");
        $res = mysqli_query($this->db, $query);
        $row = mysqli_fetch_assoc($res);
        return $row['total'] ?? 0;
    }

    
    public function getReviewer($userid){
        $query="SELECT * FROM reviewer WHERE reviewer_code = '$userid' ";
        $rowcon=mysqli_query($this->db,$query);
        $row = mysqli_fetch_assoc($rowcon);
        return $row['review_type'] ;
    }

}