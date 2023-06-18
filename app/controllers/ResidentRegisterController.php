<?php

namespace App\Controllers;
use App\Controllers\ManageRedirectController;

require_once 'app/controllers/ManageRedirectController.php';

class ResidentRegisterController extends ManageRedirectController {

    private $residentRegisterModel;

    public function __construct($residentRegisterModel) 
    {
        $this->residentRegisterModel = $residentRegisterModel;
    }

    public function setResidentRegistration() 
    {

        $this->residentCheckIfSession();

        if (isset($_POST['register-btn'])) {

            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $confirm_password = md5($_POST['confirm_password']);
            $email_address = $_POST['email_address'];
            $phone_number = $_POST['phone_number'];
            $current_date_time = date('Y-m-d H:i:s');

            // Check if password matches
            if ($password != $confirm_password) {
                echo 'Passwords did not match!';
            } 

            $result = $this->residentRegisterModel->checkRegisterValidity($username, $email_address, $phone_number);

            if($result) {
                
                $resident_id = $this->residentRegisterModel->registerResidentUser($username, $password, $current_date_time);

                // Personal Details
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $suffix = $_POST['suffix'];
                $birth_month = $_POST['month'];
                $birth_day = $_POST['day'];
                $birth_year = $_POST['year'];
                // Adjust the month value to have leading zeros if necessary
                $adjusted_birth_month = str_pad($birth_month, 2, "0", STR_PAD_LEFT);
                // Concatenate the birthdate values into the desired format
                $birthdate = $birth_year . "-" . $adjusted_birth_month . "-" . $birth_day;
                $place_of_birth = $_POST['birthplace'];
                $sex = $_POST['sex'];
                $civil_status = $_POST['civil_status'];

                $result2 = $this->residentRegisterModel->registerResidentDetails($resident_id, $first_name, $middle_name, $last_name, $suffix, $birthdate, $place_of_birth, $sex, $civil_status);

                // Contact and Address Details
                $street_building_house = $_POST['street_building_house'];
                $province = $_POST['province'];
                $city = $_POST['city'];
                $barangay = $_POST['barangay'];
                $zipcode = $_POST['zipcode'];

                $result3 = $this->residentRegisterModel->registerResidentContact($resident_id, $street_building_house, $province, $city, $barangay, $zipcode, $phone_number, $email_address);

                // ID Verification
                $valid_id_type = $_POST['valid_id_type'];
                $valid_id_number = $_POST['valid_id_number'];
                $valid_id_issued = $_POST['valid_id_issued'];

                $result4 = $this->residentRegisterModel->registerResidentId($resident_id, $valid_id_type, $valid_id_number, $valid_id_issued);

                if(($result !== null) && $result2 && $result3 && $result4) {
                    header("Location: index.php");
                    exit();
                }
            } else {
                echo "Username, email address, or phone number already used!";
            }
        }

        // Include the login view
        require_once 'app/views/resident-registration.php';
    }
};