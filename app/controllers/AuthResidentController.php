<?php

namespace App\Controllers;
use App\Controllers\ManageRedirectController;

require_once 'app/controllers/ManageRedirectController.php';

class AuthResidentController extends ManageRedirectController {
    private $residentUserModel;

    public function __construct($residentUserModel) 
    {
        $this->residentUserModel = $residentUserModel;
    }

    public function loginResidentUser() 
    {
        // Check if the login form is submitted
        if (isset($_POST['login-btn'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            
            $result = $this->residentUserModel->authenticateResident($username, $password);
    
            if ($result !== false) {
                // Authentication successful

                // Enable secure session cookie
                ini_set('session.cookie_secure', 1);

                // Enable HTTP-only session cookie
                ini_set('session.cookie_httponly', 1);

                // Regenerate session ID upon successful authentication
                session_regenerate_id(true);

                // Set session expiration time
                $sessionLifetime = 60 * 60; // 1 hour
                session_set_cookie_params($sessionLifetime);

                $_SESSION['session_resident_id'] = $result;
                $this->redirectTo('personal-information');
                exit();
            } else {
                // Authentication failed
                $_SESSION['error'] = "Invalid username or password.";
                $this->redirectTo('index');
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
        $this->redirectTo('index');
        exit();
    }
}