<?php

class ResidentLoginController {
    public function index() {        
        if (isset($_SESSION['session_resident_id'])) {
            header('Location: index.php?page=personal-information');
        }

        // Include the login view
        require_once 'app/views/resident-login.php';
    }
}
