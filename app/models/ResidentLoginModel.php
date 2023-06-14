<?php

namespace App\Models;

class ResidentLoginModel {
    private $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function authenticateResident($username, $password) 
    {
        $select = "SELECT * FROM resident_users WHERE resident_username = ? AND resident_password = ?";
        $stmt = $this->conn->prepare($select);

        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$username, $password]);
            $result = $stmt->fetch();

            if ($result) {
                return $result['resident_id'];
            } else {
                return false;
            }
        }
    }
}