<?php

namespace App\Models;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ResidentUserModel {
    private $conn;
    private $token;
    private $resident_id;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getToken() {
        return $this->token;
    }

    public function getResidentId() {
        return $this->resident_id;
    }

    public function authenticateResident($username, $password) {
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

    public function checkRegisterValidity($username, $email_address, $phone_number) {
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

    public function registerResidentUser($username, $password, $current_date_time) {
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

    public function sendEmailToResident($otp, $token, $email) 
    {
        try {
            $mail = new PHPMailer(true);
        
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
        
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'intramurosbase@gmail.com';
            $mail->Password = 'abqkfnzbsghaahcn';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('intramurosbase@gmail.com', 'Password Reset');
            $mail->addAddress($email);
            $mail->isHTML(true);
        
            $select = "SELECT ru.*, rac.* FROM resident_users AS ru
                        INNER JOIN resident_address_contact AS rac 
                        ON ru.resident_id = rac.resident_id WHERE rac.email_address = :email";
        
            $stmt = $this->conn->prepare($select);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                // Email found, fetch the resident ID
                $resident_id = $result['resident_id'];
        
                // Store the resident ID, OTP, and token in the database
                $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set expiration time to 1 hour from now
                $insert = "INSERT INTO forgot_password_users (resident_id, token, otp, expiration_time, is_used) VALUES (?, ?, ?, ?, 0)";
                $stmt = $this->conn->prepare($insert);
                $stmt->execute([$resident_id, $token, $otp, $expirationTime]);
        
                // Prepare the email
                $subject = "Password Reset";
                $message = "Your OTP for password reset is: " . $otp;
                $resetLink = "http://localhost/SAD-DEV-MVC/index.php?page=resident-new-password&token=" . urlencode($token) . "&otp=" . urlencode($otp) . "&id=" . $resident_id;
                $message .= "<br><br>Click the following link to reset your password: <a href='" . $resetLink . "'>" . $resetLink . "</a>";
        
                // Configure PHPMailer
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;
        
                // Send the email
                if ($mail->send()) {
                    $this->token = $token;
                    $this->resident_id = $resident_id;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
                echo "User with that email is not found";
            }
        } catch (Exception $e) {
            return false;
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }        
    }

    public function verifyEmailCode($otp, $token, $resident_id) 
    {

        // Prepare the SELECT statement to check if the entry exists in the database
        $select = "SELECT * FROM forgot_password_users WHERE token = :token AND otp = :otp AND resident_id = :resident_id AND is_used = 0";
        $stmt = $this->conn->prepare($select);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':otp', $otp);
        $stmt->bindParam(':resident_id', $resident_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function checkTokenValidity($otp, $token, $resident_id) 
    {
        // Prepare the SELECT statement to check if the entry is valid
        $select = "SELECT * FROM forgot_password_users WHERE token = :token AND otp = :otp AND resident_id = :resident_id AND is_used = 0";
        $stmt = $this->conn->prepare($select);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':otp', $otp);
        $stmt->bindParam(':resident_id', $resident_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function verifiedTakeUserId($resident_id)  
    {
        $select = "SELECT ru.*, rac.* FROM resident_users AS ru
        INNER JOIN resident_address_contact AS rac 
        ON ru.resident_id = rac.resident_id WHERE ru.resident_id = :resident_id";

        $stmt = $this->conn->prepare($select);
        $stmt->bindParam(':resident_id', $resident_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function verifiedSetNewPassword($resident_id, $new_password, $token, $otp)  
    {
        // Passwords match, update user's password in the database
        $update = "UPDATE resident_users SET resident_password = :new_password WHERE resident_id = :resident_id";
        $stmt = $this->conn->prepare($update);
        $stmt->bindParam(':new_password', $new_password);
        $stmt->bindParam(':resident_id', $resident_id);
        $stmt->execute();

        // Set is_used to 1
        $update_flags = "UPDATE forgot_password_users SET is_used = 1 WHERE token = :token AND otp = :otp AND resident_id = :resident_id";
        $stmt = $this->conn->prepare($update_flags);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':otp', $otp);
        $stmt->bindParam(':resident_id', $resident_id);
        $stmt->execute();

        return true;
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

    public function resetPasswordAccount($user_session_id, $oldPassword, $newPassword) {
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
}
