<?php
class CertificateModel
{
    private $conn;
    private $uploadDir;

    public function __construct()
    {

        $config = new Config();
        // Grab the connection property
        $this->conn = $config->db_conn;
        $this->uploadDir = __DIR__ . '/../assets/certificates/';
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }        
    }



    public function getParticipantData($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT honorofic, full_name FROM registration WHERE registration_code = '$userId'";
        $res = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($res);
    }

    public function getAbstractDetails($userId, $types) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        // $types is an array of allowed presentation types
        $typeList = "'" . implode("','", $types) . "'";
        $query = "SELECT paper_title FROM abstract WHERE registration_id = '$userId' 
                  AND type_of_presentation IN ($typeList) LIMIT 1";
        $res = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($res);
    }

    public function isCertificateGenerated($userId, $certType) {
    $userId = mysqli_real_escape_string($this->conn, $userId);
    $certType = mysqli_real_escape_string($this->conn, $certType);
    
    $query = "SELECT id FROM certificate_generated 
              WHERE registration_code = '$userId' AND certificate_type = '$certType'";
    $res = mysqli_query($this->conn, $query);
    return mysqli_num_rows($res) > 0;
}

public function getExistingCertificate($baseName) {
        $extensions = ['png', 'jpg', 'jpeg'];
        foreach ($extensions as $ext) {
            $path = $this->uploadDir . $baseName . '.' . $ext;
            if (file_exists($path)) {
                return 'certificates/' . $baseName . '.' . $ext;
            }
        }
        return null;
    }

    /**
     * Save the new template and clean up old extensions
     */
    public function saveCertificateImage($tmpName, $extension, $baseName) {
        $targetFile = $this->uploadDir . $baseName . '.' . $extension;
        
        // 1. Remove old versions to prevent having both .jpg and .png for the same cert
        $extensions = ['png', 'jpg', 'jpeg'];
        foreach ($extensions as $ext) {
            $oldFile = $this->uploadDir . $baseName . '.' . $ext;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        // 2. Move the new file
        return move_uploaded_file($tmpName, $targetFile);
    }

}