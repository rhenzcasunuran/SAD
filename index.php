<?php
session_start();

// Load the database configuration
require_once 'config/database.php';

// Load the environment variables from config.ini
$config = parse_ini_file('config/config.ini', true);

// Create the ResidentUserModel instance
include_once 'app/models/ResidentUserModel.php';
$residentUserModel = new ResidentUserModel($conn);

$page = $_GET['page'] ?? '/';

switch ($page) {
    case '/':
        require_once 'app/controllers/ResidentLoginController.php';
        $controller = new ResidentLoginController($residentUserModel);
        $controller->index();
        break;
    case 'resident-auth':
        require_once 'app/controllers/AuthResidentController.php';
        $controller = new AuthResidentController($residentUserModel);
        $controller->loginResidentUser();
        break;
    case 'logout':
        require_once 'app/controllers/AuthResidentController.php';
        $controller = new AuthResidentController($residentUserModel);
        $controller->logoutResidentUser();
        break;
    case 'personal-information':
        require_once 'app/controllers/ResidentProfileController.php';
        $controller = new ResidentProfileController($residentUserModel);
        $controller->residentProfile();
        break;
    case 'resident-address-book':
        require_once 'app/controllers/ResidentProfileController.php';
        $controller = new ResidentProfileController($residentUserModel);
        $controller->residentAddressBook();
        break;
    case 'resident-account-security':
        require_once 'app/controllers/ResidentProfileController.php';
        $controller = new ResidentProfileController($residentUserModel);
        $controller->residentAccountSecurity();
        break;
    default:
        // Redirect to the default index page
        header('Location: index.php');
        exit();
}
?>
