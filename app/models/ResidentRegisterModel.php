<?php

namespace App\Models;
use PDO;

class ResidentRegisterModel {
    private $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function checkRegisterValidity($username, $email_address, $phone_number) 
    {
        // Check if username, email, and phone number already exist
        $checkQuery = "SELECT ru.resident_username, rac.phone_number, rac.email_address 
        FROM resident_users AS ru
        INNER JOIN resident_address_contact AS rac 
        ON ru.resident_id = rac.resident_id
        WHERE ru.resident_username = ? OR rac.email_address = ? OR rac.phone_number = ?";

        $stmt = $this->conn->prepare($checkQuery);
        $stmt->execute([$username, $email_address, $phone_number]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {
            return false;
        } else {
            return true;
        }
    }

    public function registerResidentUser($username, $password, $current_date_time) 
    {
        $insert = "INSERT INTO resident_users (resident_username, resident_password, account_creation_date)
        VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($insert);
        $stmt->execute([$username, $password, $current_date_time]);
        $resident_id = $this->conn->lastInsertId(); // Retrieve the inserted resident_id

        return $resident_id;
    }

    public function registerResidentDetails($resident_id, $first_name, $middle_name, $last_name, $suffix, $birthdate, $place_of_birth, $sex, $civil_status) 
    { 
        $insert2 = "INSERT INTO resident_personal_details (resident_id, first_name, middle_name, last_name, suffix, birth_date, birth_place, sex, civil_status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($insert2);
        $stmt->execute([$resident_id, $first_name, $middle_name, $last_name, $suffix, $birthdate, $place_of_birth, $sex, $civil_status]);
        return true;
    }

    public function registerResidentContact($resident_id, $street_building_house, $province, $city, $barangay, $zipcode, $phone_number, $email_address) 
    { 
        $insert3 = "INSERT INTO resident_address_contact (resident_id, street_building_house, province, city, barangay, zipcode, phone_number, email_address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($insert3);
        $stmt->execute([$resident_id, $street_building_house, $province, $city, $barangay, $zipcode, $phone_number, $email_address]);
        return true;
    }

    public function registerResidentId($resident_id, $valid_id_type, $valid_id_number, $valid_id_issued) 
    { 
        $insert4 = "INSERT INTO resident_id_verification (resident_id, valid_id_type, valid_id_number, id_issued_date)
        VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($insert4);
        $stmt->execute([$resident_id, $valid_id_type, $valid_id_number, $valid_id_issued]);
        return true;
    }
};