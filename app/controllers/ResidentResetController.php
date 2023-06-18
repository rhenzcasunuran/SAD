<?php

namespace App\Controllers;
use App\Controllers\ManageRedirectController;

require_once 'app/controllers/ManageRedirectController.php';

class ResidentResetController extends ManageRedirectController {
    private $residentResetModel;

    public function __construct($residentResetModel) 
    {
        $this->residentResetModel = $residentResetModel;
    }

    public function loginResetSelect() 
    {
        $this->residentCheckIfSession();

        // Include the login view
        require_once 'app/views/resident-select-contact.php';
    }

    public function emailResetPassword() 
    {
        $this->residentCheckIfSession();

        // Function to generate a random OTP
        function generateOTP($length = 6) {
            $otp = "";
            $characters = "0123456789";
            $charLength = strlen($characters);

            for ($i = 0; $i < $length; $i++) {
                $otp .= $characters[rand(0, $charLength - 1)];
            }

            return $otp;
        }

        // Function to generate a unique token
        function generateUniqueToken() {
            $token = bin2hex(random_bytes(32)); // Generates a 64-character token

            return $token;
        }

        if (isset($_POST['email-submit-btn'])) {
            $email = $_POST['email'];

            $result = $this->residentResetModel->sendEmailToResident(generateOTP(), generateUniqueToken(), $email);

            if($result) {
                // Redirect to the OTP confirmation page
                header("Location: index.php?page=resident-email-confirmation&token=" . urlencode($this->residentResetModel->getToken()) . "&id=" . $this->residentResetModel->getResidentId());
                exit();
            } else {
                echo "Error sending email. Please try again later.";
            }
        }

        // Include the login view
        require_once 'app/views/resident-forgot-password-email.php';
    }

    public function emailCodeVerification() 
    {
        $this->residentCheckIfSession();

        if(isset($_POST['email-confirmation-btn'])) {
            // Check if the required query parameters are present
            $otp = $_POST['code'];
        
            if(isset($_GET['token'], $_GET['id'])) {
                $token = $_GET['token'];
                $resident_id = $_GET['id'];
        
                $result = $this->residentResetModel->verifyEmailCode($otp, $token, $resident_id);

                if (count($result) > 0) {
                    // Entry exists in the database, proceed with further logic
        
                    // Fetch the row from the result set
                    $row = $result[0];
        
                    // Retrieve the expiration time from the row
                    $expirationTime = $row['expiration_time'];
                    $is_used = $row['is_used'];
        
                    // Check if the expiration time has passed
                    if ((strtotime($expirationTime) <= time()) || $is_used === 1) {
                        // Entry has expired
                        echo "The link has expired. Please request a new password reset link.";
                    } else {
                        // Entry has not expired, continue with password reset or other actions
                        header("Location: index.php?page=resident-new-password&token=$token&otp=$otp&id=$resident_id");
                        exit();
                    }
                } else {
                    // Entry not found in the database
                    echo "Invalid or expired code.";
                }
            } else {
                // Missing query parameters
                echo "Invalid request. Please try again.";
            }
        }

        // Include the login view
        require_once 'app/views/resident-email-confirmation.php';
    }

    public function requestNewPassword() 
    {
        $this->residentCheckIfSession();

        $token = $_GET['token'];
        $otp = $_GET['otp'];
        $resident_id = $_GET['id'];

        // Check if the required variables are present
        if (isset($token, $otp, $resident_id)) {

            $result = $this->residentResetModel->checkTokenValidity($otp, $token, $resident_id);

            // Check if a valid entry exists in the database
            if (count($result) > 0) {
        
                // Fetch the row from the result set
                $row = $result[0];

                // Retrieve the expiration time from the row
                $expirationTime = $row['expiration_time'];
                $is_used = $row['is_used'];
                
                // Check if the expiration time has passed
                if ((strtotime($expirationTime) <= time()) || $is_used === 1) {
                    // Entry has expired or is no longer active
                    // Redirect the user back to resident-forgot-password-email.php
                    echo "Token has expired or is no longer active";
                    header("Location: index.php?page=resident-forgot-password-email");
                    exit();
                } else {
                    // Valid entry exists and has not expired, proceed with further logic
                    if(isset($_POST['confirm-new-password-btn'])) {
                        $new_password = md5($_POST['newPassword']);
                        $confirm_password = md5($_POST['confirmNewPassword']);
                        $result2 = $this->residentResetModel->verifiedTakeUserId($resident_id);

                        if(count($result2) > 0) {
                            if($new_password == $confirm_password) {
                                $result3 = $this->residentResetModel->verifiedSetNewPassword($resident_id, $new_password, $token, $otp);
                                if ($result3) {
                                    header("Location: index.php?page=resident-login");
                                    exit();
                                } else {
                                    echo "Something went wrong";
                                }
                            } else {
                                // passwords don't match, display error message
                                echo "Passwords don't match";
                            }
                        } else {
                            // resident_id not found, display error message
                            echo "Something went wrong";
                            header("Location: index.php?page=resident-forgot-password-email");
                            exit();
                        }        
                    }
                }
            } else {
                // Entry has expired or is no longer active
                // Redirect the user back to resident-forgot-password-email.php
                echo "Token has expired or is no longer active";
                header("Location: index.php?page=resident-forgot-password-email");
                exit();
            }
        } else {
            // Entry has expired or is no longer active
            // Redirect the user back to resident-forgot-password-email.php
            echo "Token has expired or is no longer active";
            header("Location: index.php?page=resident-forgot-password-email");
            exit();
        }

        // Include the login view
        require_once 'app/views/resident-new-password.php';
    }
};