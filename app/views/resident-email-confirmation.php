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

    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <!--Navbar-->
    <div class="login-bar" id="top-var">
        <div class="text-1">
            Welcome to E-Playa
        </div>
        <div class="text-1">
            About
        </div>
    </div>
    <!--Content-->
    <div id="content-container">
        <div class="flex-column justify-content-center d-flex align-items-center w-100">
            <label class="form-label text-3 fw-bold" id="text-container">Enter the code that was sent to (email).</label>
            <form action="" method="POST" class="form-container needs-validation" id="forgot-password-container" novalidate>
                <div class="form-header col-12">CODE</div>
                <small class="text-center">Verification</small>
                <input type="text" class="form-control form-field code" name="code" oninput="validateNumberInput(this)" required>
                <?php
                    if(isset($error)) {
                        foreach($error as $error) {
                            echo '<p class="form-label text-3 text-center text-decoration-none" style=color:red>'.$error.'</p>';
                        };
                    };
                ?> 
                <div class="form-group col-12 justify-content-center align-items-end d-flex">
                    <input class="btn text-center" type="submit" valid="Submit" name="email-confirmation-btn">
                </div>
            </form>

            <br>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a href="index.php?page=resident-login.php">
                    <button class="btn text-center">Cancel</button>
                </a>
            </div>
        </div>
    </div>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/jquery-3.6.4.js"></script>

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