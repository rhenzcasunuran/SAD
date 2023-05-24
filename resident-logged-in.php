<?php
include './connections.php';

session_start();

if (!(isset($_SESSION['session_resident_id']))) {
    header('location: resident-login.php');
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

    <link rel="stylesheet" href="./css/resident.css">
</head>
<body>
    <div id="content-container">
        <div class="flex-column text-center">
            <div class="fw-bold">You are now Logged In!</div>
            <button class="btn" name="logout-btn" onclick="location.href = 'logout.php';">Logout</button>
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