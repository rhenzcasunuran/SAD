<?php
include './connections.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/mail/Exception.php';
require './vendor/mail/PHPMailer.php';
require './vendor/mail/SMTP.php';

if(isset($_POST['email-submit-btn'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;

        $mail->isSMTP();

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'intramurosbase@gmail.com';

        $mail->Password = 'abqkfnzbsghaahcn';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587; 

        $mail->setFrom('intramurosbase@gmail.com', 'Password Reset'); 

        $mail->addAddress($email, $username);

        $mail->isHTML(true);

        $otp = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Forgot Password';
        $mail->Body = '<center><p>
        Looks like you requested an account recovery for this email address.
        If this was not you, please disregard this email.
        <br>
        OTP Code is: <b style="font-size: 30px;">'.$otp.'</b></p></center>';

        $select = "SELECT resident_id FROM resident_users WHERE email_address = ?";
        $stmt_init = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_init, $select)){
            echo "SQL connection error";
        } else {
            mysqli_stmt_bind_param($stmt_init, 's', $email);
            mysqli_stmt_execute($stmt_init);
            $result = $stmt_init->get_result();
        
            if(mysqli_num_rows($result) > 0) {
                // email found, fetch the resident_id
                $row = mysqli_fetch_assoc($result);
                $resident_id = $row['resident_id'];
                
                // insert resident_id and otp to forgot_password_users
                $insert = "INSERT INTO forgot_password_users (resident_id, otp) VALUES (?, ?)";
                $stmt_init2 = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt_init2, $insert)){
                    echo "SQL connection error";
                } else {
                    mysqli_stmt_bind_param($stmt_init2, 'is', $resident_id, $otp);
                    mysqli_stmt_execute($stmt_init2);
                    $mail->send();
                    header("Location: resident-email-confirmation.php?reset_id=$resident_id");
                }
            } else {
                $error[] = 'User not found';
            }
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
};
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
            <label class="form-label text-3 fw-bold" id="text-container">Provide your account's e-mail for which you want to reset your password.</label>
            <form action="" method="POST" class="form-container needs-validation" novalidate id="forgot-password-container">
                <i class='bx bxs-lock text-center' id="icon-header"></i>
                <div class="form-header col-12">Forgot Password</div>
                <div class="form-group col-12 has-feedback">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-field" id="email" name="email" required>
                </div>
                <div class="form-group col-12 justify-content-center align-items-end d-flex">
                    <input class="btn text-center" type="submit" value="Next" name="email-submit-btn">
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

        //Alphanumeric Validation
        $('.username').keypress(function (e) {
          var txt = String.fromCharCode(e.which);
          if (!txt.match(/[A-Za-z0-9_]/)) {
              return false;
          }
        });
    </script>
</body>
</html>