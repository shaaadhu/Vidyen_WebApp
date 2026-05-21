<?php
class AdminModel
{
    private $conn;

    public function __construct()
    {

        $config = new Config();
        // Grab the connection property
        $this->conn = $config->db_conn;
    }

    //FOR REGISTRATION VIEW                                     (1.REGISTRATION)
    public function getAllParticipants($year)
    {
        $query = "SELECT * FROM registration WHERE year=$year ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //personal details view of registered candidates
    public function getRegistrationDetails($id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM registration WHERE registration_code=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        return $data;
    }
    // activate user by admin
    public function activateUser($userid)
    {
        $stmt = $this->conn->prepare("UPDATE registration SET status=1 WHERE registration_code=?");
        $stmt->bind_param("s", $userid);
        return $stmt->execute();
    }

    // to get data for excel export 
    public function getAllRegistration()
    {
        $query = "SELECT * FROM registration";
        return $this->conn->query($query);
    }

    // get pre-conference submitted details for admin view     (2. PRE-CONFERENCE)
    public function getAll_preConference($year)
    {
        $query = "SELECT * FROM pre_conference WHERE YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year";
        return $this->conn->query($query);
    }


     // get details of preconference submission of candidate
    public function getConferenceById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pre_conference WHERE pre_confernce_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

     // get Authors details 
    public function getAuthorDetails($abstract_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM author_details WHERE abstract_id = ?");
        $stmt->bind_param("s", $abstract_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // get reviewer comments 
    public function getReviewerComments($abstract_id)
    {
        $stmt = $this->conn->prepare("SELECT comments FROM assign_reviewer WHERE abstract_id = ?");
        $stmt->bind_param("s", $abstract_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['comments'] : "";
    }

    // get list of reviewers for pre-conference
    public function getPreconferenceReviewers()
    {
        return $this->conn->query("SELECT * FROM reviewer WHERE review_type = 'PreConference Reviewer'");
    }

    // assign reviewer to pre-conference submission by admin
    public function assignPreConferenceReviewer($participantId, $preconferencetId, $reviewerId) 
    {
        // Start transaction to ensure both queries succeed
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Insert into assign_reviewer
            $stmt1 = mysqli_prepare($this->conn, "INSERT INTO assign_reviewer (registration_id, abstract_id, reviewer_id) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt1, "sss", $participantId, $preconferencetId, $reviewerId);
            mysqli_stmt_execute($stmt1);

            // 2. Update status in pre_conference
            $stmt2 = mysqli_prepare($this->conn, "UPDATE pre_conference SET status = 1 WHERE pre_confernce_id = ?");
            mysqli_stmt_bind_param($stmt2, "s", $preconferencetId);
            mysqli_stmt_execute($stmt2);

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            return false;
        }
    }

    
    // get all workshop details for admin view                       (3. WORKSHOP)
    public function getAllWorkshops($year)
    {
        $query = "SELECT * FROM `workshop` WHERE YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year";
        $result = mysqli_query($this->conn, $query);

        $workshops = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status_text'] = $this->formatStatus($row['status']);
            $workshops[] = $row;
        }
        return $workshops;
    }

    private function formatStatus($status)
    {
        switch ($status) {
            case '1':
                return "Assigned";
            case '2':
                return "Reviewed";
            default:
                return "Not Assigned";
        }
    }


    // get details of workshop submission of candidate
    public function getWorkshopById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM workshop WHERE workshop_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

     // get list of reviewers for workshop
    public function getWorkshopReviewers()
    {
        return $this->conn->query("SELECT * FROM reviewer WHERE review_type = 'Workshop Reviewer'");
    }

     // assign reviewer to workshop submission by admin
    public function assignWorkshopReviewer($participantId, $abstractId, $reviewerId) {
        // Start a transaction
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Insert into assign_reviewer table
            $stmt1 = mysqli_prepare($this->conn, "INSERT INTO assign_reviewer (registration_id, abstract_id, reviewer_id) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt1, "sss", $participantId, $abstractId, $reviewerId);
            mysqli_stmt_execute($stmt1);

            // 2. Update status in workshop table
            $stmt2 = mysqli_prepare($this->conn, "UPDATE workshop SET status = 1 WHERE workshop_id = ?");
            mysqli_stmt_bind_param($stmt2, "s", $abstractId);
            mysqli_stmt_execute($stmt2);

            // If both succeed, commit the changes
            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            // If anything fails, undo all changes
            mysqli_rollback($this->conn);
            return false;
        }
    }

    // get all abstract details for admin view                       (4. ABSTRACT)
    public function getAllAbstracts($year)
    {
       
        $query = "SELECT a.*, 
              (SELECT r.name 
               FROM assign_reviewer ar 
               JOIN reviewer r ON ar.reviewer_id = r.reviewer_code 
               WHERE ar.abstract_id = a.abstract_id 
               LIMIT 1) as reviewer_name 
              FROM abstract a WHERE YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year";
        // $query ="SELECT * FROM abstract";     

        $result = mysqli_query($this->conn, $query);
        $abstracts = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $row['status_html'] = $this->abstrcatformatStatus($row['status'], $row['reviewer_name']);
            $abstracts[] = $row;
        }
        return $abstracts;
    }

    private function abstrcatformatStatus($status, $reviewerName)
    {
        if ($status == 0) {
            return "<span style='color: red;'><strong>Not Assigned</strong></span>";
        }

        $label = ($status == 1) ? "Assigned" : "Reviewed";
        $color = ($status == 1) ? "orange" : "green";
        $name = $reviewerName ?? "No reviewer assigned";

        return "<span style='color: $color;'><strong>$label</strong></span><br>$name";
    }

    // data for abstract excel export
    public function getExportData()
    {
        // We remove the GROUP BY and use a subquery for comments to ensure 1 abstract = 1 row
        $query = "SELECT a.*, b.*, 
              (SELECT c.comments 
               FROM assign_reviewer c 
               WHERE c.abstract_id = a.abstract_id 
               LIMIT 1) as reviewer_comments
              FROM abstract a 
              LEFT JOIN author_details b ON a.abstract_id = b.abstract_id";

        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            throw new Exception(mysqli_error($this->conn));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // Parse the comma-separated author data using the helper method
            $authors = $this->formatAuthorData($row);

            $data[] = [
                $row['registration_id'] ?? '',
                $row['abstract_id'] ?? '',
                $row['sub_theme'] ?? '',
                $row['type_of_presentation'] ?? '',
                $row['category_presentation'] ?? '',
                $row['paper_title'] ?? '',
                $row['paper_abstract'] ?? '',
                $authors['names'],
                $authors['emails'],
                $row['designation'] ?? '',
                $row['reviewer_comments'] ?? '' // Use the subquery alias here
            ];
        }
        return $data;
    }

    private function formatAuthorData($row)
    {
        $firstNames = explode(",", $row['first_name'] ?? '');
        $middleNames = explode(",", $row['middle_name'] ?? '');
        $lastNames = explode(",", $row['last_name'] ?? '');
        $emails = explode(",", $row['author_email'] ?? '');
        $types = explode(",", $row['author_type'] ?? '');

        $nameArr = [];
        $emailArr = [];
        $max = max(count($firstNames), count($emails));

        for ($i = 0; $i < $max; $i++) {
            $f = trim($firstNames[$i] ?? '');
            $m = trim($middleNames[$i] ?? '');
            $l = trim($lastNames[$i] ?? '');
            $t = trim($types[$i] ?? '');

            if ($f || $m || $l) {
                $nameArr[] = trim("$f $m $l") . ($t ? " ($t)" : "");
            }
            if (!empty($emails[$i])) {
                $emailArr[] = trim($emails[$i]) . ($t ? " ($t)" : "");
            }
        }

        return [
            'names' => implode(', ', $nameArr),
            'emails' => implode(', ', $emailArr)
        ];
    }

    // get details of abstract submission of candidate
    public function getAbstractById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM abstract WHERE abstract_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    // get list of reviewers for abstract
    public function getAbstractReviewers()
    {
        $query = "SELECT reviewer_code, name, designation FROM `reviewer` WHERE review_type = 'Abstract Reviewer'";
        $result = mysqli_query($this->conn, $query);
        $reviewers = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reviewers[] = $row;
        }
        return $reviewers;
    }

    // assign reviewer to abstract submission by admin
    public function assignAbstractReviewer($participant_id, $abstract_code, $reviewer_id)
    {
        // Start Transaction
        mysqli_begin_transaction($this->conn);

        try {
            // 1. Insert into assign_reviewer table
            $stmt1 = $this->conn->prepare("INSERT INTO `assign_reviewer` (`registration_id`, `abstract_id`, `reviewer_id`) VALUES (?, ?, ?)");
            $stmt1->bind_param("sss", $participant_id, $abstract_code, $reviewer_id);
            $stmt1->execute();

            // 2. Update abstract status to 1 (Assigned)
            $stmt2 = $this->conn->prepare("UPDATE `abstract` SET `status` = 1 WHERE `abstract_id` = ?");
            $stmt2->bind_param("s", $abstract_code);
            $stmt2->execute();

            // Commit changes
            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            // Rollback if any query fails
            mysqli_rollback($this->conn);
            return false;
        }
    }

    // get all reviewers for admin view                       (5. REVIEWER)
    public function getAllReviewers()
    {
        $query = "SELECT * FROM reviewer";
        $result = mysqli_query($this->conn, $query);
        $reviewers = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $reviewers[] = $row;
        }
        return $reviewers;
    }


    // to generate unique reviewer code
    public function getLastReviewerCode()
    {
        $query = "SELECT reviewer_code FROM reviewer ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['reviewer_code'];
        }
        return null;
    }


    // save reviewer details from admin input
    public function saveReviewer($data)
    {
        mysqli_begin_transaction($this->conn);
        try {
            // 1. Insert into Reviewer Table
            $stmt1 = $this->conn->prepare("INSERT INTO `reviewer` (`reviewer_code`, `name`, `phone_number`, `email`, `designation`, `institution`, `address`, `review_type`, `created_by`, `created_on`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->bind_param(
                "ssssssssss",
                $data['code'],
                $data['name'],
                $data['phone'],
                $data['email'],
                $data['designation'],
                $data['institution'],
                $data['address'],
                $data['type'],
                $data['created_by'],
                $data['created_on']
            );
            $stmt1->execute();

            // 2. Insert into Login Table (using data from the same array)
            $stmt2 = $this->conn->prepare("INSERT INTO `login` (`user_id`, `user_name`, `user_email`, `password`, `usertype`, `status`) VALUES (?, ?, ?, ?, 'reviewer', '1')");
            $stmt2->bind_param(
                "ssss",
                $data['code'],
                $data['name'],
                $data['code'],
                $data['phone']
            );
            $stmt2->execute();

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            return false;
        }
    }



    // get details of each reviewer 
    public function getReviewerById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reviewer WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    
    // get all conference room details for admin view                         (6. CONFERENCE ROOM)
    public function getAllActiveRooms() {
        $query = "SELECT * FROM conference_room WHERE deleted = 0";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    // insert conference room details by admin
    public function insertRoom($data, $userId) {
        $name  = mysqli_real_escape_string($this->conn, $data['room_name']);
        $type  = mysqli_real_escape_string($this->conn, $data['room_type']);
        $links = mysqli_real_escape_string($this->conn, $data['room_links']);
        
        // Formatting date to Y-m-d is usually better for SQL storage
        $created_on = date('Y-m-d'); 

        $query = "INSERT INTO `conference_room` (`name`, `type`, `links`, `created_by`, `created_on`, `deleted`) 
                VALUES ('$name', '$type', '$links', '$userId', '$created_on', 0)";
        
        return mysqli_query($this->conn, $query);
}


// get details of conference room by id for view and edit
public function getRoomById($id) {
    $id = mysqli_real_escape_string($this->conn, $id);
    $query = "SELECT * FROM conference_room WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_assoc($result);
}

// soft update conference room by admin
public function updateRoom($data) 
{
        $id    = mysqli_real_escape_string($this->conn, $data['id']);
        $name  = mysqli_real_escape_string($this->conn, $data['room_name']);
        $type  = mysqli_real_escape_string($this->conn, $data['room_type']);
        $links = mysqli_real_escape_string($this->conn, $data['room_links']);

        $query = "UPDATE conference_room SET 
                  name = '$name', 
                  type = '$type', 
                  links = '$links' 
                  WHERE id = '$id'";
        
        return mysqli_query($this->conn, $query);
}
    
// soft delete conference room by admin
public function deleteRoom($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "UPDATE conference_room SET deleted = 1 WHERE id = '$id'";
        return mysqli_query($this->conn, $query);
}


// get all participants for certificate generation
public function getParticipants($year) 
{
        $query = "SELECT registration_code, honorofic, full_name, email 
                  FROM registration 
                  WHERE year = $year
                  ORDER BY full_name ASC";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// get all co-authors for certificate generation
public function getCoAuthors($year) 
{
        $sql = "SELECT 
                registration_id,
                CONCAT(
                    SUBSTRING_INDEX(first_name, ',', 1), ' ',
                    SUBSTRING_INDEX(middle_name, ',', 1), ' ',
                    SUBSTRING_INDEX(last_name, ',', 1)
                ) AS full_name,
                SUBSTRING_INDEX(author_email, ',', 1) AS author_email
              FROM author_details
              WHERE LOWER(author_type) LIKE '%co author%'
              AND YEAR(STR_TO_DATE(created_on, '%d-%m-%Y')) = $year";

        return mysqli_query($this->conn, $sql);
    
}



// Check if a certificate has already been generated (for the AJAX call)
public function checkStatus($userId, $certType) 
{
    $userId = mysqli_real_escape_string($this->conn, $userId);
    $certType = mysqli_real_escape_string($this->conn, $certType);
    
    // This assumes you have a table tracking generated certificates
    $query = "SELECT generation_date FROM generated_certificates 
                WHERE user_id = '$userId' AND cert_type = '$certType'";
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_assoc($result);
}

// Get the generation status for a specific registration code and certificate type
public function getGenerationStatus($regCode, $certType) 
{
    $stmt = mysqli_prepare($this->conn, "SELECT generated_date FROM certificate_generated WHERE registration_code = ? AND certificate_type = ?");
    mysqli_stmt_bind_param($stmt, "ss", $regCode, $certType);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    return $data; // Returns array or null
}


// Batch generate certificates for multiple users (for the AJAX call)
public function batchGenerate($users, $certType, $adminId)
    {
    $count = 0;
    
    // Prepare the statement once for better performance
    $query = "INSERT INTO certificate_generated (registration_code, certificate_type, generated_by) 
                VALUES (?, ?, ?) 
                ON DUPLICATE KEY UPDATE generated_by = ?, generated_date = NOW()";
    
    $stmt = mysqli_prepare($this->conn, $query);

    foreach ($users as $registration_code) {
        mysqli_stmt_bind_param($stmt, "ssss", $registration_code, $certType, $adminId, $adminId);
        if (mysqli_stmt_execute($stmt)) {
            $count++;
        }
    }

    mysqli_stmt_close($stmt);
    return $count;
}

// Get the list of generated certificates with optional filtering by type and search term
public function getGeneratedList($type = 'all', $search = '') 
{
    $where_conditions = [];
    if ($type != 'all') {
        $where_conditions[] = "cg.certificate_type = '" . mysqli_real_escape_string($this->conn, $type) . "'";
    }
    if (!empty($search)) {
        $term = mysqli_real_escape_string($this->conn, $search);
        $where_conditions[] = "(r.full_name LIKE '%$term%' OR r.registration_code LIKE '%$term%' OR r.email LIKE '%$term%')";
    }

    $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";
    
    $query = "SELECT cg.*, r.full_name, r.honorofic, r.email, r.registration_code 
                FROM certificate_generated cg 
                LEFT JOIN registration r ON cg.registration_code = r.registration_code 
                $where_clause
                ORDER BY cg.generated_date DESC";
                
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Get statistics for generated certificates by type (for dashboard display)
public function getCertificateStats() 
{
    $query = "SELECT certificate_type, COUNT(*) as count FROM certificate_generated GROUP BY certificate_type";
    $result = mysqli_query($this->conn, $query);
    
    $stats = [];
    while($row = mysqli_fetch_assoc($result)) {
        $stats[$row['certificate_type']] = $row['count'];
    }
    return $stats;
}

// total count of generated certificates (for dashboard display)
public function getTotalCount()
{
    $res = mysqli_query($this->conn, "SELECT COUNT(*) as total FROM certificate_generated");
    $data = mysqli_fetch_assoc($res);
    return $data['total'];
}

// data for certificate excel export

public function getCertificateExportData($type, $search)
{
    $where_conditions = [];

    // Filter: certificate type
    if ($type != 'all') {
        $type = mysqli_real_escape_string($this->conn, $type);
        $where_conditions[] = "cg.certificate_type = '$type'";
    }

    // Filter: search
    if (!empty($search)) {
        $search_term = mysqli_real_escape_string($this->conn, $search);
        $where_conditions[] = "(
            r.full_name LIKE '%$search_term%' 
            OR r.registration_code LIKE '%$search_term%' 
            OR r.email LIKE '%$search_term%'
        )";
    }

    // Build WHERE clause
    $where_clause = !empty($where_conditions) 
        ? "WHERE " . implode(" AND ", $where_conditions) 
        : "";

    // Query
    $query = "
        SELECT 
            cg.*, 
            r.full_name, 
            r.honorofic, 
            r.email, 
            r.registration_code 
        FROM certificate_generated cg 
        LEFT JOIN registration r 
            ON cg.registration_code = r.registration_code 
        $where_clause
        ORDER BY cg.generated_date DESC
    ";

    $result = mysqli_query($this->conn, $query);

    if (!$result) {
        throw new Exception(mysqli_error($this->conn));
    }

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'registration_code' => $row['registration_code'],
            'honorofic' => $row['honorofic'],
            'full_name' => $row['full_name'],
            'email' => $row['email'],
            'certificate_type' => $row['certificate_type'],
            'generated_date' => $row['generated_date'],
            'generated_by' => $row['generated_by'] ?? ''
        ];
    }

    return $data;
}

// get all contact messages for admin view                       (7. CONTACT)
public function getAllContacts()
{
    $query = "SELECT * FROM contact ORDER BY id DESC";
    $result = mysqli_query($this->conn, $query);
    $contacts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $contacts[] = $row;
    }
    return $contacts;
}

// get details of contact message by id for admin view
public function getContactById($id)
{
    $stmt = $this->conn->prepare("SELECT * FROM contact WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


    



    



   










//     /**
//      * Get counts per certificate type
//      */




//     public function deleteCertificate($id) {
//         $stmt = mysqli_prepare($this->conn, "DELETE FROM certificate_generated WHERE id = ?");
//         mysqli_stmt_bind_param($stmt, "i", $id);
//         $success = mysqli_stmt_execute($stmt);
//         mysqli_stmt_close($stmt);
        
//         return $success;
//     }

//     public function getExportcertificate($type = 'all', $search = '') {
//         $where_conditions = [];
//         if ($type != 'all') {
//             $where_conditions[] = "cg.certificate_type = '" . mysqli_real_escape_string($this->conn, $type) . "'";
//         }
//         if (!empty($search)) {
//             $term = mysqli_real_escape_string($this->conn, $search);
//             $where_conditions[] = "(r.full_name LIKE '%$term%' OR r.registration_code LIKE '%$term%' OR r.email LIKE '%$term%')";
//         }

//         $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";
        
//         $query = "SELECT cg.*, r.full_name, r.honorofic, r.email, r.registration_code 
//                   FROM certificate_generated cg 
//                   LEFT JOIN registration r ON cg.registration_code = r.registration_code 
//                   $where_clause
//                   ORDER BY cg.generated_date DESC";
                  
//         $result = mysqli_query($this->conn, $query);
//         // return $result; // Return the result set for memory-efficient iteration
//         return mysqli_fetch_all($result, MYSQLI_ASSOC);
//     }


    
}