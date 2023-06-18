<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRGY Aplaya</title>

    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/boxicons.css">
    <link rel="stylesheet" href="public/css/BRGY-aplaya.css">

    <link rel="stylesheet" href="public/css/personal-info.css">
</head>
<body>
    <!--Navbar-->
    <div class="login-bar" id="top-var">
        <div class="text-1">
            My Profile
        </div>
        <div class="row">
            <div class="col-9 d-flex align-items-center">
                <div class="row" id="navItemContainer">
                    <a href="#Home" class="col-3">
                        <div class="text-1" id="navItem">
                            Home
                        </div>
                    </a>
                    <a href="index.php?page=personal-information" class="col-3">
                        <div class="text-1" id="navItem">
                            Profile
                        </div>
                    </a>
                    <a href="index.php?page=request-documents" class="col-3">
                        <div class="text-1" id="navItem">
                            Request
                        </div>
                    </a>
                    <a href="#About" class="col-3">
                        <div class="text-1" id="navItem">
                            About
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 p-0">
                <div class="flex-column justify-content-end d-flex align-items-end w-100 logout-container">
                    <button class="btn" id="logoutBtn" name="logout-btn" onclick="window.location.href = 'index.php?page=logout';">Logout</button>
                </div> 
            </div>
        </div>
    </div>
    <!--Content-->
    <div class="row d-flex justify-content-center align-items-start m-0 content-container">
            <div class="col-3">
                <div id="person-config">
                    <div class="row">
                        <i class='bx bxs-user-circle user-icon'></i>
                    </div>
                    <div class="row text-start">
                        <a href="index.php?page=personal-information" class="active"><i class='bx bxs-user-detail' ></i>Personal Information</a>
                        <a href="index.php?page=resident-address-book"><i class='bx bxs-book'></i>Address Book</a>
                        <a href="index.php?page=resident-account-security"><i class='bx bx-lock-alt'></i>Account Security</a>
                    </div>
                </div>
            </div>
            <div class="col-9 mt-5">
                <div id="information-container">
                    <div class="row info text-center">
                        <div class="col-12 fw-bold fs-1">My Personal Information</div>
                    </div>
                    <div class="row info">
                        <label for="" class="col-2">Full Name: </label>
                        <p class="col-9"><?php echo $full_name; ?></p>
                    </div>
                    <div class="row info">
                        <label for="" class="col-2">Birthdate: </label>
                        <p class="col-5"><?php echo $formatted_birth_date; ?></p>
                        <label for="" class="col-2">Age: </label>
                        <p class="col-2"><?php echo $age; ?></p>
                    </div>
                    <div class="row info">
                        <label for="" class="col-2">Gender: </label>
                        <p class="col-5"><?php echo $sex; ?></p>
                        <label for="" class="col-2">Civil Status: </label>
                        <p class="col-2"><?php echo $civil_status; ?></p>
                    </div>
                    <div class="row info">
                        <label for="" class="col-2">Address: </label>
                        <p class="col-9"><?php echo $full_address; ?></p>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>