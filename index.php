<?php
session_start();

// Load the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Load the database configuration
require_once __DIR__ . '/config/database.php';

// Load PHPMailer
require_once __DIR__ . '/vendor/mail/Exception.php';
require_once __DIR__ . '/vendor/mail/PHPMailer.php';
require_once __DIR__ . '/vendor/mail/SMTP.php';

// Initialize namespaced models
use App\Models\ResidentLoginModel;
use App\Models\ResidentProfileModel;
use App\Models\ResidentRegisterModel;
use App\Models\ResidentResetModel;

// Initialize namespaced controllers
use App\Controllers\ResidentLoginController;
use App\Controllers\ResidentProfileController;
use App\Controllers\ResidentRegisterController;
use App\Controllers\ResidentResetController;

// Create resident model instances
$residentLoginModel = new ResidentLoginModel($conn);
$residentProfileModel = new ResidentProfileModel($conn);
$residentRegisterModel = new ResidentRegisterModel($conn);
$residentResetModel = new ResidentResetModel($conn);

// Define the routes
$routes = [
    '/' => [
        'controller' => ResidentLoginController::class,
        'method' => 'index',
        'models' => [$residentLoginModel]
    ],
    'resident-auth' => [
        'controller' => ResidentLoginController::class,
        'method' => 'loginResidentUser',
        'models' => [$residentLoginModel]
    ],
    'logout' => [
        'controller' => ResidentLoginController::class,
        'method' => 'logoutResidentUser',
        'models' => [$residentLoginModel]
    ],
    'resident-select-contact' => [
        'controller' => ResidentResetController::class,
        'method' => 'loginResetSelect',
        'models' => [$residentResetModel]
    ],
    'resident-forgot-password-email' => [
        'controller' => ResidentResetController::class,
        'method' => 'emailResetPassword',
        'models' => [$residentResetModel]
    ],
    'resident-email-confirmation' => [
        'controller' => ResidentResetController::class,
        'method' => 'emailCodeVerification',
        'models' => [$residentResetModel]
    ],
    'resident-new-password' => [
        'controller' => ResidentResetController::class,
        'method' => 'requestNewPassword',
        'models' => [$residentResetModel]
    ],
    'resident-registration' => [
        'controller' => ResidentRegisterController::class,
        'method' => 'setResidentRegistration',
        'models' => [$residentRegisterModel]
    ],
    'personal-information' => [
        'controller' => ResidentProfileController::class,
        'method' => 'residentProfile',
        'models' => [$residentProfileModel]
    ],
    'resident-address-book' => [
        'controller' => ResidentProfileController::class,
        'method' => 'residentAddressBook',
        'models' => [$residentProfileModel]
    ],
    'resident-account-security' => [
        'controller' => ResidentProfileController::class,
        'method' => 'residentAccountSecurity',
        'models' => [$residentProfileModel]
    ],
    'request-documents'  => [
        'controller' => ResidentProfileController::class,
        'method' => 'residentRequestDocx',
        'models' => [$residentProfileModel]
    ]
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
    $controllerClass = $route['controller'];
    $methodName = $route['method'];
    $models = $route['models']; // Retrieve the models associated with the route

    // Create the controller instance
    if (class_exists($controllerClass)) {
        $modelInstances = [];
        foreach ($models as $model) {
            $modelInstances[] = $model;
        }

        $controller = new $controllerClass(...$modelInstances);

        // Check if the method exists in the controller
        if (method_exists($controller, $methodName)) {
            // Call the controller method
            $controller->$methodName();
            exit(); // Exit after executing the controller method
        }
    }
}

// Handle the case where the page or method doesn't exist
header('Location: index.php');
exit();
?>
