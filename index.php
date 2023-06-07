<?php
session_start();

// Load the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Load the database configuration
require_once __DIR__ . '/config/database.php';

use App\Models\ResidentUserModel;
use App\Controllers\ResidentLoginController;
use App\Controllers\AuthResidentController;
use App\Controllers\ResidentProfileController;

// Create the ResidentUserModel instance
$residentUserModel = new ResidentUserModel($conn);

// Define the routes
$routes = [
    '/' => [ResidentLoginController::class, 'index'],
    'resident-select-contact' => [ResidentLoginController::class, 'loginResetSelect'],
    'resident-forgot-password-email' => [ResidentLoginController::class, 'emailResetPassword'],
    'resident-email-confirmation' => [ResidentLoginController::class, 'emailCodeVerification'],
    'resident-new-password' => [ResidentLoginController::class, 'requestNewPassword'],
    'resident-registration' => [ResidentLoginController::class, 'setResidentRegistration'],
    'resident-auth' => [AuthResidentController::class, 'loginResidentUser'],
    'logout' => [AuthResidentController::class, 'logoutResidentUser'],
    'personal-information' => [ResidentProfileController::class, 'residentProfile'],
    'resident-address-book' => [ResidentProfileController::class, 'residentAddressBook'],
    'resident-account-security' => [ResidentProfileController::class, 'residentAccountSecurity'],
];

// Secure redirection
$page = filter_var($_GET['page'] ?? '/', FILTER_SANITIZE_URL);

// Check if the page parameter is empty or contains only invalid characters
if ($page === '' || !preg_match('/^[a-zA-Z0-9\-\/]+$/', $page)) {
    header('Location: index.php');
    exit();
}

// Check if the requested page exists in the routes
if (array_key_exists($page, $routes)) {
    $route = $routes[$page];
    $controllerName = $route[0];
    $methodName = $route[1];

    // Create the controller instance
    if (class_exists($controllerName)) {
        $controller = new $controllerName($residentUserModel);

        // Check if the method exists in the controller
        if (method_exists($controller, $methodName)) {
            // Call the controller method
            $controller->$methodName();
            exit(); // Exit after executing the controller method
        }
    } else {
        header('Location: index.php');
        exit();
    }
} 

// Handle the case where the page or method doesn't exist
header('Location: index.php');
exit();
?>
