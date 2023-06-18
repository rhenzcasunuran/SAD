<?php

namespace App\Controllers;
use DateTime;
use App\Controllers\ManageRedirectController;

require_once 'app/controllers/ManageRedirectController.php';

class ResidentProfileController extends ManageRedirectController {
    private $residentProfileModel;

    public function __construct($residentProfileModel) 
    {
        $this->residentProfileModel = $residentProfileModel;
    }

    public function residentProfile() 
    {
        /*
        $this->residentCheckIfNotSession();

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Regenerate the session ID
        session_regenerate_id(true);

        // Redirect to the login page
        $this->redirectTo('index');
        exit();*/




        // Get the resident user's information from the model
        $row = $this->residentProfileModel->getResidentProfileInfo($_SESSION['session_resident_id']);

        if ($row) {
            // Access the data from the associative array
            $first_name = $row["first_name"];
            $middle_name = $row["middle_name"];
            $last_name = $row["last_name"];
            $birth_date = $row["birth_date"];
            $sex = $row["sex"];
            $civil_status = $row["civil_status"];
            $street_building_house = $row["street_building_house"];
            $barangay = $row["barangay"];
            $city = $row["city"];
            $province = $row["province"];

            // Concatenate the variables into a full name and full address
            $full_name = $first_name . " " . $middle_name . " " . $last_name;
            $full_address = $street_building_house . " " . $barangay . " " . $city . " " . $province;

            // Auto calculate age
            $current_date = date("Y-m-d");
            $birthdate = new DateTime($birth_date);
            $current_date = new DateTime($current_date);
            $age = $birthdate->diff($current_date)->y;

            // Formatted Date to mm-dd-yyyy
            $formatted_birth_date = date("F d, Y", strtotime($birth_date));

            // Include the personal information view
            require_once 'app/views/personal-information.php';
        } else {
            // Handle error, display an error view, or redirect to an error page
            echo "Error retrieving resident user information.";
        }
    }

    public function residentAddressBook() 
    {

        $this->residentCheckIfNotSession();

        // Get the resident user's information from the model
        $addressesResult = $this->residentProfileModel->getResidentAddressBook($_SESSION['session_resident_id']);

        // Get the resident user's information from the model
        $permanent_address = $this->residentProfileModel->getResidentPermanentAddress($_SESSION['session_resident_id']);

        // Check if the login form is submitted
        if (isset($_POST['submitNewPassword'])) {
            $address = $_POST['address'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $barangay = $_POST['barangay'];
            $zipcode = $_POST['zipcode'];
            $phone = $_POST['phone'];

            $result = $this->residentProfileModel->addAddress($_SESSION['session_resident_id'], $address, $province, $city, $barangay, $zipcode, $phone);

            if ($result) {
                // Address added successfully
                $this->redirectTo('resident-address-book');
                exit();
            } else {
                // Error occurred while adding the address
                echo "Error: Unable to add address.";
            }
        }

        // Include the address-book view
        require_once 'app/views/address-book.php';
    }

    public function residentAccountSecurity() 
    {

        $this->residentCheckIfNotSession();

        // Get the resident user's information from the model
        $row = $this->residentProfileModel->getResidentAccountInfo($_SESSION['session_resident_id']);

        // Check if the query was successful
        if (!empty($row)) {
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];
            // Concatenate the first name, middle name, and last name
            $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
            $username = $row['resident_username'];
            $email_address = $row['email_address'];
            $old_password = $row['resident_password'];
        } else {
            // Error occurred while retrieving the resident user information
            echo "Error retrieving resident user information.";
        }

        if (isset($_POST['submitNewPassword'])) {
            // Retrieve the form data
            $newPassword = md5($_POST['newPassword']);
            $confirmPassword = md5($_POST['confirmPassword']);
            $oldPassword = md5($_POST['oldPassword']);
        
            if ($newPassword != $confirmPassword) {
                echo "Password doesn't match.";
            } else if ($newPassword === $confirmPassword) {
                $result = $this->residentProfileModel->resetPasswordAccount($_SESSION['session_resident_id'], $oldPassword, $newPassword);
        
                if ($result) {
                    $this->redirectTo('resident-account-security');
                    exit();
                } else {
                    echo "Old Password didn't match our records.";
                }
            } else {
                echo "Password failed to update.";
            }
        }        

        // Include the account-security view
        require_once 'app/views/account-security.php';
    }

    public function residentRequestDocx() 
    {

        $this->residentCheckIfNotSession();

        // Include the account-security view
        require_once 'app/views/request-documents.php';
    }
}