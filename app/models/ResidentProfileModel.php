<?php

namespace App\Models;
use PDO;

class ResidentProfileModel {
    private $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function getResidentProfileInfo($user_session_id) 
    {
        // Prepare the SQL statement with a parameter placeholder
        $sql = "SELECT ru.*, rpd.*, rac.*, riv.*
                FROM resident_users AS ru
                INNER JOIN resident_personal_details AS rpd ON ru.resident_id = rpd.resident_id
                INNER JOIN resident_address_contact AS rac ON ru.resident_id = rac.resident_id
                INNER JOIN resident_id_verification AS riv ON ru.resident_id = riv.resident_id
                WHERE ru.resident_id = :user_session_id;";
    
        // Create a prepared statement
        $stmt = $this->conn->prepare($sql);
    
        // Bind the parameter to the statement
        $stmt->bindValue(':user_session_id', $user_session_id, PDO::PARAM_INT);
    
        // Execute the statement
        $stmt->execute();
    
        // Get the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }    

    public function getResidentAddressBook($user_session_id) 
    {
        // Get addresses
        $get_addresses = "SELECT ru.resident_id, rab.resident_id,
            rab.street_building_house, rab.barangay, rab.province, rab.city_municipality,
            rab.zipcode 
            FROM `resident_address_book` AS rab 
            INNER JOIN `resident_users` AS ru 
            ON ru.resident_id = rab.resident_id 
            WHERE rab.resident_id = :resident_id";
    
        // Create a prepared statement
        $stmt = $this->conn->prepare($get_addresses);
    
        // Bind the parameter
        $stmt->bindParam(':resident_id', $user_session_id, PDO::PARAM_INT);
    
        // Execute the statement
        $stmt->execute();
    
        // Fetch the result set
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }    

    public function getResidentPermanentAddress($user_session_id) 
    {
        // Get permanent address
        $get_permanent_address = "SELECT ru.resident_id, rac.street_building_house, rac.barangay, rac.province, rac.city, rac.zipcode 
            FROM `resident_address_contact` AS rac 
            INNER JOIN `resident_users` AS ru 
            ON ru.resident_id = rac.resident_id 
            WHERE rac.resident_id = :resident_id";
            
        // Create a prepared statement
        $stmt = $this->conn->prepare($get_permanent_address);
    
        // Bind the parameter
        $stmt->bindParam(':resident_id', $user_session_id, PDO::PARAM_INT);
    
        // Execute the statement
        $stmt->execute();
    
        // Fetch the row
        $permanentAddressRow = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Concatenate the values into a single string
        $permanent_address = $permanentAddressRow['street_building_house'] . ', ' . $permanentAddressRow['barangay'] . ', ' . $permanentAddressRow['city'] . ', ' . $permanentAddressRow['province'] . ', ' . $permanentAddressRow['zipcode'];
    
        return $permanent_address;
    } 

    public function addAddress($resident_id, $address, $province, $city, $barangay, $zipcode, $phone)
    {
        $insertAddress = "INSERT INTO resident_address_book (resident_id, street_building_house, province, city_municipality, barangay, zipcode, phone_number) 
                        VALUES (:resident_id, :address, :province, :city, :barangay, :zipcode, :phone)";

        $stmt = $this->conn->prepare($insertAddress);

        $stmt->bindParam(':resident_id', $resident_id, PDO::PARAM_INT);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':province', $province, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':barangay', $barangay, PDO::PARAM_STR);
        $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getResidentAccountInfo($user_session_id)
    {
        // Prepare the SQL statement with a parameter placeholder
        $sql = "SELECT ru.*, rpd.*, rac.email_address 
                FROM resident_users AS ru
                INNER JOIN resident_personal_details AS rpd ON ru.resident_id = rpd.resident_id
                INNER JOIN resident_address_contact AS rac ON ru.resident_id = rac.resident_id
                WHERE ru.resident_id = :resident_id;";
    
        // Create a prepared statement
        $stmt = $this->conn->prepare($sql);
    
        // Bind the parameter to the statement
        $stmt->bindParam(':resident_id', $user_session_id, PDO::PARAM_INT);
    
        // Execute the statement
        $stmt->execute();
    
        // Fetch a single row from the result set
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row;
    }    

    public function resetPasswordAccount($user_session_id, $oldPassword, $newPassword) 
    {
        // Check if the old password matches the one in the database
        $checkOldPassword = "SELECT resident_password FROM resident_users WHERE resident_id = :resident_id";
        $stmt = $this->conn->prepare($checkOldPassword);
        $stmt->bindParam(':resident_id', $user_session_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $old_password_from_db = $row['resident_password'];
    
        if ($old_password_from_db === $oldPassword) {
            $updatePassword = "UPDATE resident_users SET resident_password = :new_password WHERE resident_id = :resident_id";
            $stmt = $this->conn->prepare($updatePassword);
            $stmt->bindParam(':new_password', $newPassword);
            $stmt->bindParam(':resident_id', $user_session_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }    
};