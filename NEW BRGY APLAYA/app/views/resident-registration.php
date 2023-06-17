<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design</title>

    <!--BRGY designs-->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/boxicons.css">
    <link rel="stylesheet" href="../../public/css/design.css">
    <link rel="stylesheet" href="../../public/css/button.css">

    <link rel="stylesheet" href="../../public/css/topvar.css">
    <link rel="stylesheet" href="../../public/css/registration.css">
</head>
<body>
    <div id="contentWrapper">
        <!--Side Nav-->
        <div class="flex-column" id="leftSidenav"></div>
        <div id="rightSidenav"></div>
        <div id="topvarContainer">
            <div>
                <div id="brgyName">
                    BRGY Aplaya
                </div>
            </div>
            <div id="buttonContainer">
                <div class="text-button" id="signInAccount">
                    Sign in
                </div>
                <div class="filled-button">
                    Quick Tutorial
                </div>
            </div>
        </div>
        <div class="row" id="contentContainer">
            <div id="content">
                <div id="leftWrapper">
                    <div class="steps">
                        Registration
                    </div>
                    <div id="progress">
                        <div id="progressContainer">
                            <div class="step" id="A">
                                <div id="first" class="bullet">
                                    <span>1</span>
                                </div>
                            </div>
                            <div class="step">
                                <div class="bullet">
                                    <span>2</span>
                                </div>
                            </div>
                            <div class="step">
                                <div class="bullet">
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="step">
                                <div class="bullet">
                                    <span>4</span>
                                </div>
                            </div>
                        </div>
                        <div id="progressHeader">
                            <div class="header">
                                Personal Information
                            </div>
                            <div class="header">
                                Address & Contact Details
                            </div>
                            <div class="header">
                                ID Verification
                            </div>
                            <div class="header">
                                Account Setup
                            </div>
                        </div>
                    </div>
                </div>
                <div id="rightWrapper">
                    <form action="" method="POST" autocomplete="off" class="needs-validation form-container" id="form-container" oninput='confirmPassword.setCustomValidity(confirmPassword.value != password.value ? "Passwords do not match." : "")' novalidate>
                        <div id="registrationContainer">
                        <div class="row h-100 form-section" id="tab-1">
                            <div class="form-group col-sm-7 has-feedback">
                                <label for="first-name" class="form-label">First Name <span id="required">*</span></label>
                                <input type="text" class="form-control form-field name-only" id="first-name" name="first-name" required>
                            </div>
                            <div class="form-group col-sm-5 has-feedback">
                                <label for="middle-name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control name-only" id="middle-name" name="middle-name">
                            </div>
                            <div class="form-group col-sm-9 has-feedback">
                                <label for="last-name" class="form-label">Last Name <span id="required">*</span></label>
                                <input type="text" class="form-control form-field name-only" id="last-name" name="last-name" required>
                            </div>
                            <div class="form-group col-sm-3 has-feedback">
                                <label for="suffix-name" class="form-label">Suffix</label>
                                <input type="text" class="form-control" id="suffix-name" name="suffix-name">
                            </div>
                            <div class="form-group col-sm-5 has-feedback">
                                <label class="form-label">Date of Birth <span id="required">*</span></label>
                                <select id="month" class="form-select form-field" id="suffix-name" name="month" title="Birthmonth" onchange="change_month(this)"  required></select>
                            </div>
                            <div class="form-group col-sm-3 has-feedback">
                                <label class="form-label"><span id="required">*</span></label>
                                <select id="day" class="form-select form-field" id="suffix-name" name="day" title="Birthday"  required></select>
                            </div>
                            <div class="form-group col-sm-4 has-feedback">
                                <label class="form-label"><span id="required">*</span></label>
                                <select id="year" class="form-select form-field" id="suffix-name" name="year" title="Birthyear" onchange="change_year(this)"  required></select>
                            </div>
                            <div class="form-group col-sm-5 has-feedback">
                                <label for="birthplace" class="form-label">Place of Birth <span id="required">*</span></label>
                                <input type="text" class="form-control form-field letters-only" id="birthplace" name="birthplace"  required>
                            </div>
                            <div class="form-group col-sm-3 has-feedback">
                                <label for="sex" class="form-label">Sex <span id="required">*</span></label>
                                <select class="form-select form-field" id="sex" name="sex"  required>
                                    <option hidden value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 has-feedback">
                                <label for="civil-status" class="form-label">Civil Status <span id="required">*</span></label>
                                <select class="form-select form-field" id="civil-status" name="civil-status"  required>
                                    <option hidden value=""></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Live in">Lived in</option>
                                    <option value="Divorce">Divorce</option>
                                    <option value="Seperated">Seperated</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                          <!--  <?php
                                if(isset($error)) {
                                    foreach($error as $error) {
                                        echo '<p class="form-label text-3 text-center text-decoration-none" style=color:red>'.$error.'</p>';
                                    };
                                };
                            ?> -->
                        </div>
                        <div class="row h-100 form-section" id="tab-2">
                            <div class="form-group col-12">
                                <label for="address" class="form-label">Street/Building/House No. <span id="required">*</span></label>
                                <input type="text" class="form-control form-field" id="address" name="address" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="province" class="form-label">Province <span id="required">*</span></label>
                                <input class="form-control form-field" id="province" name="province" value="Laguna" required readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="city" class="form-label">City/Municipality <span id="required">*</span></label>
                                <input class="form-control form-field" id="city" name="city" value="Santa Rosa" required readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="barangay" class="form-label">Barangay <span id="required">*</span></label>
                                <input class="form-control form-field" id="barangay" name="barangay" value="Aplaya" required readonly>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="zipcode" class="form-label">Zipcode <span id="required">*</span></label>
                                <input type="text" class="form-control form-field numeric-only" id="zipcode" name="zipcode" minlength="4" maxlength="4" value="4026" readonly required>
                            </div>
                            <div class="form-group col-sm-9">
                                <label for="phone" class="form-label">Mobile Number <small>(09123456789)</small> <span id="required">*</span></label>
                                <input type="tel" class="form-control form-field numeric-only" id="phone" name="phone" pattern="[0-9]{11}" maxlength="11" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="form-label">Email <span id="required">*</span> <span id="valid"></span></label>
                                <input type="email" class="form-control form-field" id="email" name="email" required>
                            </div>
                        </div>
        
                        <div class="row h-100 form-section" id="tab-3">
                            <div class="form-group col-12">
                                <label for="id" class="form-label">Type of ID <span id="required">*</span></label>
                                <select class="form-select form-field" id="id" name="id-type" required>
                                    <option hidden value=""></option>
                                    <option value="afp-beneficiary-id">AFP Beneficiary ID</option>
                                    <option value="afpslai-id">AFPSLAI ID</option>
                                    <option value="barangay-id">Barangay ID</option>
                                    <option value="bir-tin">BIR (TIN)</option>
                                    <option value="voters-id">COMELEC / Voter’s ID / COMELEC Registration Form</option>
                                    <option value="drivers-license">Driver’s License</option>
                                    <option value="e-card">e-Card / UMID</option>
                                    <option value="employee-id">Employee’s ID / Office Id</option>
                                    <option value="firearms-license">Firearms License</option>
                                    <option value="ibp-id">Integrated Bar of the Philippines (IBP) ID</option>
                                    <option value="nbi-clearance">NBI Clearance</option>
                                    <option value="pag-ibig-id">Pag-ibig ID</option>
                                    <option value="4ps-id">Pantawid Pamilya Pilipino Program (4Ps) ID</option>
                                    <option value="passport">Passport</option>
                                    <option value="pwd-id">Person’s With Disability (PWD) ID</option>
                                    <option value="phil-health-id">Phil-health ID</option>
                                    <option value="phil-id">Philippine Identification (PhilID / ePhilID)</option>
                                    <option value="ph-postal-id">Philippine Postal ID</option>
                                    <option value="prc-id">Professional Regulation Commission (PRC) ID</option>
                                    <option value="pvao-id">PVAO ID</option>
                                    <option value="school-id">School ID</option>
                                    <option value="senior-citizen-id">Senior Citizen ID</option>
                                    <option value="solo-parent-id">Solo Parent ID</option>
                                    <option value="sss-id">SSS ID</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="id" class="form-label">ID Number <span id="required">*</span></label>
                                <input type="text" class="form-control form-field numeric-w-hyphen" id="id-number" name="id-number" required maxlength="36">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="id" class="form-label">ID Issued Date <span id="required">*</span></label>
                                <input type="date" class="form-control form-field" id="id-issued-date" name="id-issued-date" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-4" id="icon-container">
                                    <i class='bx bxs-camera' id="icon"></i>
                                </div>
                                <div class="col-8">
                                    <label for="selfie-id" class="form-label">Take a selfie with the selected ID <span id="required">*</span></label>
                                    <input type="file" class="form-control" id="selfie-id" name="selfie-id" accept="image/png, image/jpeg">
                                </div>
                            </div>
                        </div>
        
                        <div class="row h-100 form-section" id="tab-4">
                            <div class="form-group col-12">
                                <label for="username" class="form-label">Username <span id="required">*</span></label>
                                <input type="text" class="form-control form-field username" id="username" name="username" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="password" class="form-label">Password <span id="required">*</span></label>
                                <div class="input-group" id="show-hide-password">
                                    <input type="password" class="form-control form-field password" id="password" name="password" required>
                                    <div class="input-group-text">
                                        <i class="bx bx-hide" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="confirm-password" class="form-label">Confirm Password <span id="required">*</span></label>
                                <div class="input-group" id="show-hide-confirm-password">
                                    <input type="password" class="form-control form-field" id="confirm-password" name="confirmPassword" required>
                                    <div class="input-group-text">
                                        <i class="bx bx-hide" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12" id="terms-conditions-container">
                                <input id="terms-conditions" type="checkbox" class="form-field" required>
                                <div id="terms">
                                    <label for="terms-conditions" name="terms-conditions" class="form-label">I Agree with</label>
                                    <span id="termsConditions">Terms & Conditions</span>
                                    <span>.</span>
                                </div>
        
                            </div>
                        </div>
                        </div>
                        <div class="form-navigation d-flex justify-content-center align-self-end">
                            <button type="button" class="previous filled-button pull-left pull">&lt; Previous</button>
                            <button type="button" class="next filled-button pull-right pull">Next &gt;</button>
                            <input class="filled-button pull-right" type="submit" value="Submit" name="register-btn">
                            <span class="clearfix"></span>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    <!--BRGY scripts-->
    <script src="../../public/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/js/jquery-3.6.4.js"></script>
    <script src="../../public/js/parsley.min.js"></script>

    <script src="../../public/js/form_validation.js"></script>
    <script src="../../public/js/input_validation.js"></script>
    <script src="../../public/js/date_picker.js"></script>
    <script src="../../public/js/tooltip_validation.js"></script>

    <script>
        $("#signInAccount").on('click', function() {
            location.href = "../../index.html";
        })

        $(".pull").on('click', function() {
            location.href = "#progress";
        })

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