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
            <form action="index.php?page=resident-auth" method="POST" class="form-container needs-validation" id="login-container">
                <div class="form-header col-12">Resident</div>
                <div class="form-group col-12 has-feedback">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control form-field username" id="username" name="username" required>
                </div>
                <div class="form-group col-12 has-feedback">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control form-field" id="password" name="password" required>
                </div>
                <a href="index.php?page=resident-select-contact" class="form-label text-2 text-center text-decoration-none" id="forgot">Forgot Password?</a>
                <?php
                    if(isset($_SESSION['error'])) {
                        echo '<p class="form-label text-3 text-center text-decoration-none" style="color:red">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']); // Clear the error message after displaying it
                    }
                ?>
                <div class="form-group col-12 justify-content-center align-items-end d-flex">
                    <input class="btn text-center" type="submit" value="Login" name="login-btn">
                </div>
            </form>
            <br>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <label class="form-label text-3 fw-bold">Don't have an account?</label>
                <a href="index.php?page=resident-registration">
                    <button class="btn">Register</button>
                </a>
            </div>
        </div>
    </div>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/jquery-3.6.4.js"></script>

    <script>
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