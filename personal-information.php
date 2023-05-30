<?php
include './connections.php';

session_start();

if (!isset($_SESSION['session_resident_id'])) {
    header('location: resident-login.php');
}

// Prepare the SQL statement with a parameter placeholder
$sql = "SELECT ru.*, rpd.*, rac.*, riv.*
        FROM resident_users AS ru
        INNER JOIN resident_personal_details AS rpd ON ru.resident_id = rpd.resident_id
        INNER JOIN resident_address_contact AS rac ON ru.resident_id = rac.resident_id
        INNER JOIN resident_id_verification AS riv ON ru.resident_id = riv.resident_id
        WHERE ru.resident_id = ?;";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind the parameter to the statement
$stmt->bind_param("i", $_SESSION['session_resident_id']);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    // Fetch the data as an associative array
    $row = $result->fetch_assoc();

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

    // Concatenate the variables into a full
    $full_name = $first_name . " " . $middle_name . " " . $last_name;
    $full_address = $street_building_house . " " . $barangay . " " . $city . " " . $province;

    // Auto calculate age
    $current_date = date("Y-m-d");
    $birthdate = new DateTime($birth_date);
    $current_date = new DateTime($current_date);
    $age = $birthdate->diff($current_date)->y;

    // Formatted Date to mm-dd-yyyy
    $formatted_birth_date = date("F d, Y", strtotime($birth_date));

} else {
    echo "No results found.";
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRGY Aplaya</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/boxicons.css">
    <link rel="stylesheet" href="./css/BRGY-aplaya.css">

    <link rel="stylesheet" href="./css/personal-info.css">
</head>
<body>
    <div id="container" class="row d-flex justify-content-center align-items-center m-0">
            <div class="col-4">
                <div id="person-config">
                    <div class="row">
                        <i class='bx bxs-user-circle user-icon'></i>
                    </div>
                    <div class="row text-start">
                        <a href="#personalInfo"><i class='bx bxs-user-detail' ></i>Personal Information</a>
                        <a href="#addressBook"><i class='bx bxs-book'></i>Address Book</a>
                        <a href="#accountSecurity"><i class='bx bx-lock-alt'></i>Account Security</a>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div id="information-container">
                    <div class="row info">
                        <label for="" class="col-3">Full Name: </label>
                        <p class="col-9"><?php echo $full_name; ?></p>
                    </div>
                    <div class="row info">
                        <label for="" class="col-3">Birthdate: </label>
                        <p class="col-5"><?php echo $formatted_birth_date; ?></p>
                        <label for="" class="col-2">Age: </label>
                        <p class="col-2"><?php echo $age; ?></p>
                    </div>
                    <div class="row info">
                        <label for="" class="col-3">Gender: </label>
                        <p class="col-3"><?php echo $sex; ?></p>
                        <label for="" class="col-4">Civil Status: </label>
                        <p class="col-2"><?php echo $civil_status; ?></p>
                    </div>
                    <div class="row info">
                        <label for="" class="col-3">Address: </label>
                        <p class="col-9"><?php echo $full_address; ?></p>
                    </div>
                </div>
            </div>
    </div>
    <div id="sidebar-container">
        <div class="flex-column justify-content-end d-flex align-items-end w-100 logout-container">
            <button class="btn" id="logoutBtn" name="logout-btn" onclick="location.href = 'logout.php';">Logout</button>
        </div> 
    </div> 
</body>
</html>