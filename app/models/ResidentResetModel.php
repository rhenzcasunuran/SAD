<?php

namespace App\Models;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ResidentResetModel {
    private $conn;
    private $token;
    private $resident_id;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function getToken() 
    {
        return $this->token;
    }

    public function getResidentId() 
    {
        return $this->resident_id;
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
}
