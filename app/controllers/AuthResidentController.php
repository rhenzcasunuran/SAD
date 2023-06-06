<?php

class AuthResidentController {
    private $residentUserModel;

    public function __construct($residentUserModel) {
        $this->residentUserModel = $residentUserModel;
    }

    public function loginResidentUser() {
        // Check if the login form is submitted
        if (isset($_POST['login-btn'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            
            $result = $this->residentUserModel->authenticateResident($username, $password);
    
            if ($result !== false) {
                // Authentication successful
                $_SESSION['session_resident_id'] = $result;
                header('Location: index.php?page=personal-information');
                exit();
            } else {
                // Authentication failed
                $_SESSION['error'] = "Invalid username or password.";
                header('Location: index.php');
                exit();
            }
        }
    }    

    public function logoutResidentUser()
    {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Regenerate the session ID
        session_regenerate_id(true);

        // Redirect to the login page
        header('Location: index.php');
        exit();
    }
}