<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design</title>

    <!--BRGY designs-->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/boxicons.css">
    <link rel="stylesheet" href="public/css/design.css">
    <link rel="stylesheet" href="public/css/button.css">

    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div id="contentWrapper">
        <div id="topvarContainer">
            <div>
                <div id="brgyName">
                    BRGY Aplaya
                </div>
            </div>
            <div id="buttonContainer">
                <div class="text-button createAccount" id="createAccount">
                    Create Account
                </div>
                <div class="filled-button">
                    Quick Tutorial
                </div>
            </div>
        </div>
        <!--Side Nav-->
        <div class="flex-column" id="leftSidenav"></div>
        <div id="rightSidenav"></div>
        <div class="row" id="contentContainer">
            <div id="content">
                <div id="headerWrapper">
                    <div id="headerContainer">
                        <div class="header">
                            Welcome <br> to <br> <span>iLaya</span> 
                        </div>
                    </div>
                </div>
                <div id="loginWrapper">
                    <div id="loginContainer">
                        <form action="" class="needs-validation" autocomplete="off" novalidate>
                            <div class="form-header">Resident</div>
                            <p class="margin">Welcome! Please provide your login credentials to access your account.</p>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                            </div>
                            <div href="#" class="margin a">Having trouble signing in?</div>
                            <div class="form-group justify-content-center align-items-end d-flex">
                                <input class="filled-button" type="submit" value="Sign in" name="login-btn">
                            </div>
                            <label class="form-label margin">Don't have an account?</label>
                            <span class="a createAccount">
                                Sign up now!
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--BRGY scripts-->
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/jquery-3.6.4.js"></script>

    <script src="public/js/form_validation.js"></script>

    <script>
        $(".createAccount").on('click', function() {
            location.href = "app/views/resident-registration.html";
        })
    </script>
</body>
</html>