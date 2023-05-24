<?php

include 'connections.php'; 

session_start();

$resident_id = $_GET['reset_id'];

if(isset($_POST['email-confirmation-btn'])) {
    $otp = $_POST['code'];

    $select = "SELECT * FROM forgot_password_users WHERE resident_id = ? AND otp = ?";
    $stmt_init = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_init, $select)){
        echo "SQL connection error";
    } else {
        mysqli_stmt_bind_param($stmt_init, 'is', $resident_id, $otp);
        mysqli_stmt_execute($stmt_init);
        $result = $stmt_init->get_result();

        if(mysqli_num_rows($result) > 0) {
            header("Location: resident-new-password.php?password_reset=$resident_id");
        } else {
            // resident_id not found, display error message
            echo "SQL connection error";
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
            <label class="form-label text-3 fw-bold" id="text-container">Enter the code that was sent to (email).</label>
            <form action="" method="POST" class="form-container needs-validation" id="forgot-password-container" novalidate>
                <div class="form-header col-12">CODE</div>
                <small class="text-center">Verification</small>
                <input type="text" class="form-control form-field code" name="code" oninput="validateNumberInput(this)" required>
                <div class="form-group col-12 justify-content-center align-items-end d-flex">
                    <input class="btn text-center" type="submit" valid="Submit" name="email-confirmation-btn">
                </div>
            </form>

            <br>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a href="resident-login.php">
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

        function validateNumberInput(input) {
            // Remove any non-digit characters
            var number = input.value.replace(/\D/g, '');

            // Restrict the input to a maximum of 6 digits
            if (number.length > 6) {
                number = number.slice(0, 6);
            }

            // Update the input value
            input.value = number;
        }
    </script>
</body>
</html>