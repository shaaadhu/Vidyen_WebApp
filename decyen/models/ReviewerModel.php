<?php
class ReviewerModel {
    private $conn; 

    public function __construct()
    {

        $config = new Config();
        $this->conn = $config->db_conn;
    }

    // get assigned abstract details
    public function getAssignedAbstracts($reviewerId) {
        $reviewerId = mysqli_real_escape_string($this->conn, $reviewerId);
        $query = "SELECT * FROM assign_reviewer WHERE reviewer_id = '$reviewerId'";
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
        $query = "SELECT registration_id, sub_theme, type_of_presentation, paper_title, keywords, paper_abstract 
                  FROM abstract WHERE abstract_id = '$id'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    // save abstract evaluation
    public function saveEvaluation($abstractCode, $comment) {
        // Start Transaction
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Update assign_reviewer table
            $stmt1 = mysqli_prepare($this->conn, "UPDATE assign_reviewer SET comments = ?, status = 1 WHERE abstract_id = ?");
            mysqli_stmt_bind_param($stmt1, "ss", $comment, $abstractCode);
            mysqli_stmt_execute($stmt1);

            // 2. Update abstract table status to 'Evaluated' (2)
            $stmt2 = mysqli_prepare($this->conn, "UPDATE abstract SET status = 2 WHERE abstract_id = ?");
            mysqli_stmt_bind_param($stmt2, "s", $abstractCode);
            mysqli_stmt_execute($stmt2);

            // Commit changes
            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            // Rollback if anything fails
            mysqli_rollback($this->conn);
            return false;
        }
    }

    // get assigned PreConference details
    public function getPreConferenceAssignments($reviewerId) {
        $reviewerId = mysqli_real_escape_string($this->conn, $reviewerId);
        // We select the assignments specifically for this reviewer
        $query = "SELECT * FROM assign_reviewer WHERE reviewer_id = '$reviewerId'";
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
    public function getWorkshopAssignments($reviewerId) {
        $reviewerId = mysqli_real_escape_string($this->conn, $reviewerId);
        $query = "SELECT * FROM assign_reviewer WHERE reviewer_id = '$reviewerId'";
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