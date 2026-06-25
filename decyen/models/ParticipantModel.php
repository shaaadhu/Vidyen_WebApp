<?php
class ParticipantModel
{
    private $conn;

    public function __construct()
    {

        $config = new Config();
        // Grab the connection property
        $this->conn = $config->db_conn;
    }

    // fetch participant details by user id
    public function getParticipantDetails($userid)
    {
        $sql = "SELECT * FROM registration WHERE registration_code = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // fetch all submitted pre-conference by user id
    public function getSubmissionsByUserId($userId)
    {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT * FROM pre_conference WHERE registration_id = '$userId'";
        $result = mysqli_query($this->conn, $query);

        $submissions = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // Logic moved from View to Model
            $row['display_status'] = ($row['status'] == 2) ? "Evaluated" : (($row['status'] == 3) ? "Rejected" : "Not Evaluated");
            $submissions[] = $row;
        }
        return $submissions;
    }

    // fetch pre-conference details by pre-conference id
    public function getPreConferenceDetailsById($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $res = mysqli_query($this->conn, "SELECT * FROM pre_conference WHERE pre_confernce_id = '$id'");
        return mysqli_fetch_assoc($res);
    }

    // fetch author details by abstract id
    public function getAuthorsByAbstractId($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $res = mysqli_query($this->conn, "SELECT * FROM author_details WHERE abstract_id = '$id'");
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    // fetch reviewer comments by abstract id
    public function getReviewerComments($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $res = mysqli_query($this->conn, "SELECT comments FROM assign_reviewer WHERE abstract_id = '$id'");
        $row = mysqli_fetch_assoc($res);
        return $row['comments'] ?? '';
    }

    // fetch available reviewers for pre-conference submission
    public function getAvailableReviewers()
    {
        $res = mysqli_query($this->conn, "SELECT * FROM reviewer WHERE review_type = 'PreConference Reviewer'");
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

   
    public function generatePreConferenceId()
{
    $year = date('Y');
    $prefix = 'PRE' . $year;

    $query = "SELECT pre_confernce_id
              FROM pre_conference
              WHERE pre_confernce_id LIKE '$prefix%'
              ORDER BY pre_confernce_id DESC
              LIMIT 1";

    $result = mysqli_query($this->conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        return $prefix . '01';
    }

    $lastNumber = (int)substr($data['pre_confernce_id'], strlen($prefix));
    $nextNumber = $lastNumber + 1;

    return $prefix . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
}

   
    //   Saves both the submission and the author details
    public function savePreconferenceSubmission($mainData, $authorData)
    {
        // Start Transaction to ensure both tables are updated or neither is
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Insert into pre_conference
            $stmt = mysqli_prepare($this->conn, "INSERT INTO pre_conference (registration_id, pre_confernce_id, sub_theme, title_paper, keywords, abstract_background, abstract_rationale, abstract_objective, abstract_outcome, abstract_structure, abstract_description, participant, participant_description, max_participants, workshop_overview, created_by, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param(
                $stmt,
                "sssssssssssssssss",
                $mainData['participant_id'],
                $mainData['pre_confernce_id'],
                $mainData['sub_theme'],
                $mainData['paper_title'],
                $mainData['keywords'],
                $mainData['background'],
                $mainData['rationale'],
                $mainData['objective'],
                $mainData['outcome'],
                $mainData['structure'],
                $mainData['description'],
                $mainData['participant'],
                $mainData['participant_desc'],
                $mainData['max_participants'],
                $mainData['workshop_overview'],
                $mainData['created_by'],
                $mainData['created_on']
            );
            mysqli_stmt_execute($stmt);

            // 2. Insert into author_details
            $stmt2 = mysqli_prepare($this->conn, "INSERT INTO author_details (registration_id, abstract_id, first_name, middle_name, last_name, author_email, author_type, designation, author_institution, author_city, author_state, author_country, author_pincode, created_by, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param(
                $stmt2,
                "sssssssssssssss",
                $mainData['participant_id'],
                $mainData['pre_confernce_id'],
                $authorData['first_name'],
                $authorData['middle_name'],
                $authorData['last_name'],
                $authorData['email'],
                $authorData['type'],
                $authorData['designation'],
                $authorData['institution'],
                $authorData['city'],
                $authorData['state'],
                $authorData['country'],
                $authorData['pincode'],
                $mainData['created_by'],
                $mainData['created_on']
            );
            mysqli_stmt_execute($stmt2);

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            return false;
        }
    }

    // fetch all submitted workshops by user id   
    public function getWorkshopSubmissions($userId)
    {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT * FROM workshop WHERE registration_id = '$userId'";
        $result = mysqli_query($this->conn, $query);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // Logic moved from HTML to Model
            $row['display_status'] = ($row['status'] == 2) ? "Evaluated" : (($row['status'] == 3) ? "Rejected" : "Not Evaluated");
            $data[] = $row;
        }
        return $data;
    }

    // fetch workshop details by workshop id
    public function getWorkshopDetailsById($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $res = mysqli_query($this->conn, "SELECT * FROM workshop WHERE workshop_id = '$id'");
        return mysqli_fetch_assoc($res);
    }

    

    public function generateWorkshopId()
{
    $year = date('Y');
    $prefix = 'WRK' . $year;

    $query = "SELECT workshop_id
              FROM workshop
              WHERE workshop_id LIKE '$prefix%'
              ORDER BY workshop_id DESC
              LIMIT 1";

    $result = mysqli_query($this->conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        return $prefix . '01';
    }

    $lastNumber = (int)substr($data['workshop_id'], strlen($prefix));
    $nextNumber = $lastNumber + 1;

    return $prefix . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
}

    // Saves both the workshop submission and the author details
    public function saveWorkshopSubmission($mainData, $authorData)
    {
        // Start Transaction to ensure both tables are updated or neither is
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Insert into pre_conference
            $stmt = mysqli_prepare($this->conn, "INSERT INTO workshop (registration_id, workshop_id, sub_theme, title_paper, keywords, abstract_background, abstract_rationale, abstract_objective, abstract_outcome, abstract_structure, abstract_description, participant, participant_description, max_participants, workshop_overview, created_by, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param(
                $stmt,
                "sssssssssssssssss",
                $mainData['participant_id'],
                $mainData['pre_confernce_id'],
                $mainData['sub_theme'],
                $mainData['paper_title'],
                $mainData['keywords'],
                $mainData['background'],
                $mainData['rationale'],
                $mainData['objective'],
                $mainData['outcome'],
                $mainData['structure'],
                $mainData['description'],
                $mainData['participant'],
                $mainData['participant_desc'],
                $mainData['max_participants'],
                $mainData['workshop_overview'],
                $mainData['created_by'],
                $mainData['created_on']
            );
            mysqli_stmt_execute($stmt);

            // 2. Insert into author_details
            $stmt2 = mysqli_prepare($this->conn, "INSERT INTO author_details (registration_id, abstract_id, first_name, middle_name, last_name, author_email, author_type, designation, author_institution, author_city, author_state, author_country, author_pincode, created_by, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param(
                $stmt2,
                "sssssssssssssss",
                $mainData['participant_id'],
                $mainData['pre_confernce_id'],
                $authorData['first_name'],
                $authorData['middle_name'],
                $authorData['last_name'],
                $authorData['email'],
                $authorData['type'],
                $authorData['designation'],
                $authorData['institution'],
                $authorData['city'],
                $authorData['state'],
                $authorData['country'],
                $authorData['pincode'],
                $mainData['created_by'],
                $mainData['created_on']
            );
            mysqli_stmt_execute($stmt2);

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            return false;
        }
    }


    // fetch all submitted abstracts by participant id
    public function getAbstractsByParticipant($participantId)
    {
        $participantId = mysqli_real_escape_string($this->conn, $participantId);
        $query = "SELECT * FROM abstract WHERE registration_id = '$participantId'";
        $result = mysqli_query($this->conn, $query);

        $abstracts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // Business Logic: Determine status string here
            $row['display_status'] = ($row['status'] == 2) ? "Evaluated" : (($row['status'] == 3) ? "Rejected" : "Not Evaluated");
            $abstracts[] = $row;
        }
        return $abstracts;
    }


    // fetch abstract details by abstract id
    public function getAbstractDetailsById($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $res = mysqli_query($this->conn, "SELECT * FROM abstract WHERE abstract_id = '$id'");
        return mysqli_fetch_assoc($res);
    }



    public function generateAbstractId()
{
    $year = date('Y');
    $prefix = 'AUT' . $year;

    $query = "SELECT abstract_id
              FROM abstract
              WHERE abstract_id LIKE '$prefix%'
              ORDER BY abstract_id DESC
              LIMIT 1";

    $result = mysqli_query($this->conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        return $prefix . '01';
    }

    $lastId = $row['abstract_id'];

    // Extract sequence after AUTYYYY
    $lastNumber = (int)substr($lastId, strlen($prefix));

    $newNumber = $lastNumber + 1;

    return $prefix . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
}

    // fetch count of abstracts submitted for a specific type and subtheme
    public function getSubmissionCount($type, $subtheme)
    {
        $query = "SELECT COUNT(*) as total
                FROM abstract
                WHERE type_of_presentation = '$type'
                AND sub_theme = '$subtheme'";

        $result = mysqli_query($this->conn, $query);

        $row = mysqli_fetch_assoc($result);

        return $row['total'];
    }
    // Saves both the abstract submission and the author details
    public function saveAbstractSubmission($mainData, $authorData)
    {
        // Start Transaction to ensure both tables are updated or neither is
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Insert into pre_conference
            $stmt = mysqli_prepare($this->conn, "INSERT INTO abstract  
            (`registration_id`, `abstract_id`, `sub_theme`, 
            `type_of_presentation`, `category_presentation`, 
            `paper_title`, `keywords`, `paper_abstract`,
            `session_name`,
            `created_by`, `created_on`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        mysqli_stmt_bind_param(
                            $stmt,
                            "sssssssssss",
                            $mainData['register_id'],
                            $mainData['abstract_id'],
                            $mainData['sub_themes'],
                            $mainData['type_presentation'],
                            $mainData['cat_presentation'],
                            $mainData['title_paper'],
                            $mainData['keywords'],
                            $mainData['abstract_details'],
                            $mainData['session_name'],
                            $mainData['created_by'],
                            $mainData['created_on']
                        );
            mysqli_stmt_execute($stmt);

            // 2. Insert into author_details
            $stmt2 = mysqli_prepare($this->conn, "INSERT INTO author_details (registration_id, abstract_id, first_name, middle_name, last_name, author_email, author_type, designation, author_institution, author_city, author_state, author_country, author_pincode, created_by, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param(
                $stmt2,
                "sssssssssssssss",
                $mainData['register_id'],
                $mainData['abstract_id'],
                $authorData['first_name'],
                $authorData['middle_name'],
                $authorData['last_name'],
                $authorData['email'],
                $authorData['type'],
                $authorData['designation'],
                $authorData['institution'],
                $authorData['city'],
                $authorData['state'],
                $authorData['country'],
                $authorData['pincode'],
                $mainData['created_by'],
                $mainData['created_on']

            );
            mysqli_stmt_execute($stmt2);

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            return false;
        }
    }

    
    public function getUserGeneratedCerts($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT certificate_type FROM certificate_generated WHERE registration_code = '$userId'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function hasPaperPresentation($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT id FROM abstract WHERE registration_id = '$userId' 
                  AND (type_of_presentation = 'Oral Presentations for research submission' 
                  OR type_of_presentation = 'Oral Presentations for Speciality Research') LIMIT 1";
        return mysqli_num_rows(mysqli_query($this->conn, $query)) > 0;
    }

    public function hasPosterPresentation($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT id FROM abstract WHERE registration_id = '$userId' 
                  AND type_of_presentation = 'Posters' LIMIT 1";
        return mysqli_num_rows(mysqli_query($this->conn, $query)) > 0;
    }

    public function hasYenvisionPresentation($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT id FROM abstract WHERE registration_id = '$userId' 
                  AND type_of_presentation = 'Yenvision- Lightning talk' LIMIT 1";
        return mysqli_num_rows(mysqli_query($this->conn, $query)) > 0;
    }

    public function coAuthorDetails($userId){
        $query = "SELECT *
        FROM author_details 
        WHERE registration_id = '$userId'
        AND FIND_IN_SET('Co Author', REPLACE(author_type, ', ', ','))";

        return $result = mysqli_query($this->conn, $query);

    }

}