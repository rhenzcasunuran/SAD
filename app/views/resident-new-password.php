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
            <form action="" method="POST" class="form-container needs-validation" id="forgot-password-container" oninput='confirmNewPassword.setCustomValidity(confirmNewPassword.value != newPassword.value ? "Passwords do not match." : "")' novalidate>
                <div class="form-header col-12">Set your NEW Password</div>
                <div class="form-group">
                    <label for="new-password" class="form-label">New Password <span id="required">*</span></label>
                    <div class="input-group" id="show-hide-password">
                        <input type="password" class="form-control form-field" id="new-password" name="newPassword" required>
                        <div class="input-group-text">
                            <i class="bx bx-hide" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm-new-password" class="form-label">Confirm Password <span id="required">*</span></label>
                    <div class="input-group" id="show-hide-confirm-password">
                        <input type="password" class="form-control form-field" id="confirm-new-password" name="confirmNewPassword" required>
                        <div class="input-group-text">
                            <i class="bx bx-hide" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <?php
                    if(isset($error)) {
                        foreach($error as $error) {
                            echo '<p class="form-label text-3 text-center text-decoration-none" style=color:red>'.$error.'</p>';
                        };
                    };
                ?> 
                <div class="form-group col-12 justify-content-center align-items-end d-flex">
                    <input class="btn text-center" type="submit" value="Submit" name="confirm-new-password-btn">
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

        $("#show-hide-password .input-group-text").on('click', function(e) {
            e.preventDefault();
            if($('#show-hide-password input').attr("type") === "text"){
                $('#show-hide-password input').attr('type', 'password');
                $('#show-hide-password i').addClass( "bx-hide" );
                $('#show-hide-password i').removeClass( "bx-show" );
            }else if($('#show-hide-password input').attr("type") === "password"){
                $('#show-hide-password input').attr('type', 'text');
                $('#show-hide-password i').removeClass( "bx-hide" );
                $('#show-hide-password i').addClass( "bx-show" );
            }
        });

        $("#show-hide-confirm-password .input-group-text").on('click', function(e) {
            e.preventDefault();
            if($('#show-hide-confirm-password input').attr("type") === "text"){
                $('#show-hide-confirm-password input').attr('type', 'password');
                $('#show-hide-confirm-password i').addClass( "bx-hide" );
                $('#show-hide-confirm-password i').removeClass( "bx-show" );
            }else if($('#show-hide-confirm-password input').attr("type") === "password"){
                $('#show-hide-confirm-password input').attr('type', 'text');
                $('#show-hide-confirm-password i').removeClass( "bx-hide" );
                $('#show-hide-confirm-password i').addClass( "bx-show" );
            }
        });
    </script>
</body>
</html>