<?php
class ReviewerModel {
    private $conn; 

    public function __construct()
    {

        $config = new Config();
        $this->conn = $config->db_conn;
    }

    private function createConferenceRoom($session) {
        // Clean the input variable
        $currentDate = date('d-m-Y');
        $session = mysqli_real_escape_string($this->conn, $session);
        $currentDate = mysqli_real_escape_string($this->conn, $currentDate);
        
        //  Check if it already exists
        $checkQuery = "SELECT id FROM conference_room 
                    WHERE name = '$session' 
                        AND type = 'Scientific Session Rooms' 
                    LIMIT 1";
                    
        $checkResult = mysqli_query($this->conn, $checkQuery);
        
        if (!$checkResult) {
           return false;
        }
        
        //  If it already exists, just return false (avoid inserting)
        if (mysqli_num_rows($checkResult) > 0) {
            return true; 
        }
        
        // If it doesn't exist, run the INSERT query
        // NOTE: Change 'deleted', 'created_on' or other columns to match your table fields
        $insertQuery = "INSERT INTO conference_room (name, type,created_by,created_on) 
                        VALUES ('$session', 'Scientific Session Rooms','admin','$currentDate')";
                        
        $insertResult = mysqli_query($this->conn, $insertQuery);
        
        if (!$insertResult) {
            return false;
        }
        
        return true; // Successfully inserted!
    }

   

    // get assigned abstract details
    public function getAssignedAbstracts($reviewerId,$year) {
        $reviewerId = mysqli_real_escape_string($this->conn, $reviewerId);
        $year = mysqli_real_escape_string($this->conn, $year);
        $query = "SELECT * FROM assign_reviewer WHERE reviewer_id = '$reviewerId' AND year = '$year'";
        $result = mysqli_query($this->conn, $query);
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // Normalize status for the view
            $row['status'] = isset($row['status']) ? (int)$row['status'] : 0;
            $data[] = $row;
        }
        return $data;
    }

    // get abstract details for evaluation
    public function getAbstractForEvaluation($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "SELECT * FROM abstract WHERE abstract_id = '$id'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    // save abstract evaluation
    public function saveEvaluation($abstractCode, $comment, $session_name, $decision) {
        // Start Transaction
        mysqli_begin_transaction($this->conn);
       
        try {
            // Update assign_reviewer table
            $stmt1 = mysqli_prepare($this->conn, "UPDATE assign_reviewer SET comments = ?, status = 1 WHERE abstract_id = ?");
            mysqli_stmt_bind_param($stmt1, "ss", $comment, $abstractCode);
            mysqli_stmt_execute($stmt1);

            // Determine status and whether a room needs to be created
            $status = ($decision === 'accept') ? 2 : 3;

            // Update abstract table status (works for both 2 or 3)
            $stmt2 = mysqli_prepare($this->conn, "UPDATE abstract SET status = ? WHERE abstract_id = ?");
            mysqli_stmt_bind_param($stmt2, "is", $status, $abstractCode); // "i" for integer status, "s" for string code
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);

            // Only handle conference room logic if the decision was 'accept'
            if ($decision === 'accept') {
                $roomCreated = $this->createConferenceRoom($session_name);
                if (!$roomCreated) {
                    throw new Exception("Conference room creation failed.");
                }
            }

            // Commit changes (handles both acceptance and rejection states cleanly)
            mysqli_commit($this->conn);
            return true;

            
        } catch (Exception $e) {
            // Rollback if anything fails
            mysqli_rollback($this->conn);
            return false;
        }
    }

    // get assigned PreConference details
    public function getPreConferenceAssignments($reviewerId, $year) {
        $reviewerId = mysqli_real_escape_string($this->conn, $reviewerId);
        // We select the assignments specifically for this reviewer
        $query = "SELECT * FROM assign_reviewer WHERE reviewer_id = '$reviewerId' AND year = '$year'";
        $result = mysqli_query($this->conn, $query);
        
        $assignments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $assignments[] = $row;
        }
        return $assignments;
    }

    // get PreConference details for evaluation
    public function getPreConferenceForReview($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "SELECT registration_id, sub_theme, title_paper, keywords, abstract_background 
                  FROM pre_conference WHERE pre_confernce_id = '$id'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

     // save PreConference evaluation
    public function submitPreConferenceEvaluation($abstractCode, $comment) {
        // Start Transaction
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Update assignment table
            $stmt1 = mysqli_prepare($this->conn, "UPDATE assign_reviewer SET comments = ?, status = 1 WHERE abstract_id = ?");
            mysqli_stmt_bind_param($stmt1, "ss", $comment, $abstractCode);
            mysqli_stmt_execute($stmt1);

            // 2. Update pre_conference table status to 'Evaluated' (2)
            $stmt2 = mysqli_prepare($this->conn, "UPDATE pre_conference SET status = 2 WHERE pre_confernce_id = ?");
            mysqli_stmt_bind_param($stmt2, "s", $abstractCode);
            mysqli_stmt_execute($stmt2);

            // Commit changes
            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            // Rollback if any query fails
            mysqli_rollback($this->conn);
            return false;
        }
    }

    // get assigned Workshop details
    public function getWorkshopAssignments($reviewerId, $year) {
        $reviewerId = mysqli_real_escape_string($this->conn, $reviewerId);
        $year = mysqli_real_escape_string($this->conn, $year);
        $query = "SELECT * FROM assign_reviewer WHERE reviewer_id = '$reviewerId' AND year = '$year'";
        $result = mysqli_query($this->conn, $query);
        
        $assignments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $assignments[] = $row;
        }
        return $assignments;
    }

    // get Workshop details for evaluation
    public function getWorkshopForReview($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "SELECT registration_id, sub_theme, title_paper, keywords, abstract_background 
                  FROM workshop WHERE workshop_id = '$id'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

     // save Workshop evaluation
    public function submitWorkshopEvaluation($workshopId, $comment) {
        // Start Transaction
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Update reviewer assignment table
            $stmt1 = mysqli_prepare($this->conn, "UPDATE assign_reviewer SET comments = ?, status = 1 WHERE abstract_id = ?");
            mysqli_stmt_bind_param($stmt1, "ss", $comment, $workshopId);
            mysqli_stmt_execute($stmt1);

            // 2. Update workshop table status to 'Evaluated' (2)
            $stmt2 = mysqli_prepare($this->conn, "UPDATE workshop SET status = 2 WHERE workshop_id = ?");
            mysqli_stmt_bind_param($stmt2, "s", $workshopId);
            mysqli_stmt_execute($stmt2);

            // Commit all changes
            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            // Rollback if any query fails
            mysqli_rollback($this->conn);
            return false;
        }
    }

}