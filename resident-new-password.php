<?php

include './connections.php'; 

session_start();

$resident_id = $_GET['password_reset'];

if(isset($_POST['confirm-new-password-btn'])) {
    $new_password = md5($_POST['newPassword']);
    $confirm_password = md5($_POST['confirmNewPassword']);

    $select = "SELECT email_address FROM resident_users WHERE resident_id = ?";
    $stmt_init = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_init, $select)){
        echo "SQL connection error";
    } else {
        mysqli_stmt_bind_param($stmt_init, 'i', $resident_id);
        mysqli_stmt_execute($stmt_init);
        $result = $stmt_init->get_result();

        if(mysqli_num_rows($result) > 0) {
            
            if($new_password == $confirm_password) {
                // passwords match, update user's password in the database
                $update = "UPDATE resident_users SET password = ? WHERE resident_id = ?";
                $stmt_init = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_init, $update)){
                    echo "SQL connection error";
                } else {
                    mysqli_stmt_bind_param($stmt_init, 'si', $new_password, $resident_id);
                    mysqli_stmt_execute($stmt_init);
                    header("location:resident-login.php");
                }
            } else {
                // passwords don't match, display error message
                echo "Passwords don't match";
            }
        } else {
            // resident_id not found, display error message
            echo "Resident ID not found";
        }        
    }
}
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

    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div id="content-container">
        <div class="flex-column justify-content-center d-flex align-items-center w-100">
            <form action="" method="POST" class="form-container needs-validation" id="forgot-password-container" oninput='confirmNewPassword.setCustomValidity(confirmNewPassword.value != newPassword.value ? "Passwords do not match." : "")' novalidate>
                <div class="form-header col-12">Set your NEW Password</div>
                <label for="new-password" class="form-label">New Password <span id="required">*</span></label>
                <input type="password" class="form-control form-field" id="new-password" name="newPassword" required>
                <label for="confirm-new-password" class="form-label">Confirm Password <span id="required">*</span></label>
                <input type="password" class="form-control form-field" id="confirm-new-password" name="confirmNewPassword" required>
                <div class="form-group col-12 justify-content-center align-items-end d-flex">
                    <input class="btn text-center" type="submit" value="Submit" name="confirm-new-password-btn">
                </div>
            </form>

            <br>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a href="./resident-login.php">
                    <button class="btn text-center">Cancel</button>
                </a>
            </div>
        </div>
    </div>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-3.6.4.js"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
        })()
    </script>
</body>
</html>