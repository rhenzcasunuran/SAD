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
    <!--Registration CSS-->
    <link rel="stylesheet" href="./css/registration.css">
</head>
<body>
    <!--Navbar-->
    <div id="top-var">
        <div class="text-1">
            Already have an account?
            <span>
                <button class="btn text-1">Login</button>
            </span>
        </div>
    </div>
    <!--Content-->
    <div id="content-container">
            <form action="" method="POST" autocomplete="off" class="form-container" id="form-container">
                <div class="row h-100 tab" id="tab-1">
                    <div class="form-header col-12">Personal Details</div>
                    <div class="form-group col-sm-7">
                        <label for="first-name" class="form-label">First Name <span id="required">*</span></label>
                        <input type="text" class="form-control form-field letters-only" id="first-name" name="first-name">
                    </div>
                    <div class="form-group col-sm-5" class="form-label">
                        <label for="middle-name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control letters-only" id="middle-name" name="middle-name">
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="last-name" class="form-label">Last Name <span id="required">*</span></label>
                        <input type="text" class="form-control form-field letters-only" id="last-name" name="last-name">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="suffix-name" class="form-label">Suffix</label>
                        <input type="text" class="form-control" id="suffix-name" name="suffix-name">
                    </div>
                    <div class="form-group col-sm-5">
                        <label class="form-label">Date of Birth <span id="required">*</span></label>
                        <select id="month" class="form-select form-field" id="suffix-name" name="suffix-name" title="Month" onchange="change_month(this)"></select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="form-label"><span id="required">*</span></label>
                        <select id="day" class="form-select form-field" id="suffix-name" name="suffix-name" title="Day"></select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="form-label"><span id="required">*</span></label>
                        <select id="year" class="form-select form-field" id="suffix-name" name="suffix-name" title="Year" onchange="change_year(this)"></select>
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="birthplace" class="form-label">Place of Birth <span id="required">*</span></label>
                        <input type="text" class="form-control form-field letters-only" id="birthplace" name="birthplace">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="sex" class="form-label">Sex <span id="required">*</span></label>
                        <select class="form-select form-field" id="sex" name="sex">
                            <option hidden value=""></option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="civil-status" class="form-label">Civil Status <span id="required">*</span></label>
                        <select class="form-select form-field" id="civil-status" name="civil-status">
                            <option hidden value=""></option>
                            <option value="single">Single</option>
                            <option value="marrie">Married</option>
                            <option value="divorce">Divorce</option>
                            <option value="divorce">Seperated</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="form-button-container justify-content-end">
                        <div class="btn" id="index-btn" onclick="run(1, 2);">Next</div>
                    </div>
                </div>

                <div class="row h-100 tab" id="tab-2">
                    <div class="form-header col-12">Contact Details</div>
                    <div class="form-group col-12">
                        <label for="address" class="form-label">Street/Building/House No. <span id="required">*</span></label>
                        <input type="text" class="form-control form-field" id="address" name="address">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="province" class="form-label">Province <span id="required">*</span></label>
                        <select class="form-select form-field" id="province" name="province">
                            <option hidden value=""></option>
                            <option value="laguna">Laguna</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="city" class="form-label">City/Municipality <span id="required">*</span></label>
                        <select class="form-select form-field" id="city" name="city">
                            <option hidden value=""></option>
                            <option value="santa rosa">Santa Rosa</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="barangay" class="form-label">Barangay <span id="required">*</span></label>
                        <select class="form-select form-field" id="barangay" name="barangay">
                            <option hidden value=""></option>
                            <option value="aplaya">Aplaya</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="zipcode" class="form-label">Zipcode <span id="required">*</span></label>
                        <input type="text" class="form-control form-field numeric-only" id="zipcode" name="zipcode" maxlength="4">
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="phone" class="form-label">Phone Number <small>(09123456789)</small> <span id="required">*</span></label>
                        <input type="tel" class="form-control form-field numeric-only" id="phone" name="phone" pattern="[0-9]{11}" maxlength="11">
                    </div>
                    <div class="form-group col-12">
                        <label for="email" class="form-label">Email <span id="required">*</span> <span id="valid"></span></label>
                        <input type="email" class="form-control form-field" id="email" name="email">
                    </div>
                    <div class="form-button-container justify-content-between">
                        <div class="btn" id="index-btn" onclick="run(2, 1);">Back</div>
                        <div class="btn" id="validate" onclick="run(2, 3);">Next</div>
                    </div>
                </div>

                <div class="row h-100 tab" id="tab-3">
                    <div class="form-header col-12">ID Verification</div>
                    <div class="form-group col-12">
                        <label for="id" class="form-label">Type of ID <span id="required">*</span></label>
                        <select class="form-select form-field" id="id" name="id">
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
                        <input type="text" class="form-control form-field numeric-w-hyphen" id="id" name="id">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="id" class="form-label">ID Expiration Date <span id="required">*</span></label>
                        <input type="date" class="form-control form-field" id="id" name="id">
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
                    <div class="form-button-container justify-content-between">
                        <div class="btn" id="index-btn" onclick="run(3, 2);">Back</div>
                        <div class="btn" id="index-btn" onclick="run(3, 4);">Next</div>
                    </div>
                </div>

                <div class="row h-100 tab" id="tab-4">
                    <div class="form-header col-12">Account</div>
                    <div class="form-group col-12">
                        <label for="username" class="form-label">Username <span id="required">*</span></label>
                        <input type="text" class="form-control form-field username" id="username" name="username">
                    </div>
                    <div class="form-group col-12">
                        <label for="password" class="form-label">Password <span id="required">*</span></label>
                        <input type="password" class="form-control form-field" id="password" name="password">
                    </div>
                    <div class="form-group col-12">
                        <label for="confirm-password" class="form-label">Confirm Password <span id="required">*</span></label>
                        <input type="password" class="form-control form-field" id="confirm-password" name="confirm-password">
                    </div>
                    <div class="form-group col-12" id="terms-conditions-container">
                        <input id="terms-conditions" type="checkbox" class="form-field">
                        <label for="terms-conditions" name="terms-conditions" class="form-label">Agree with <span class="popup-button">Terms & Conditions</span>.</label>
                    </div>
                    <div class="form-button-container justify-content-between">
                        <div class="btn" id="index-btn" onclick="run(4, 3);">Back</div>
                        <div type="submit" class="btn" onclick="submit(4);">Submit</div>
                    </div>
                </div>
            </form>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-3.6.4.js"></script>

    <!--Registration JS-->
    <script src="./js/date-picker.js"></script>

    <script>
        //Default Form Tab
        $(".tab").css("display", "none");
        $("#tab-1").css("display", "flex");

        //Email Validation
        canNext = true;

        const validateEmail = (email) => {
                    return email.match(/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/);
                };

        const validate = () => {
            canNext = false;
            const $result = $('#valid');
            const email = $('#email').val();
            $result.text('');
            if (validateEmail(email)) {
                $result.text('Valid');
                $result.css('color', 'green');
                validEmail = true;
            } else {
                $result.text('Invalid');
                $result.css('color', 'red');
                validEmail = false;
            }
            return false;   
        }
            

        function run(hideTab, showTab){
            $('#email').on('input', validate);
            console.log(validEmail)
            if (hideTab < showTab){
                var currentTab = 0;

                x = $("#tab-"+hideTab);
                y = $(x).find(".form-field");

                phone = document.getElementById('phone').value;

                for (i = 0; i < y.length; i++){
                    if(y[i].value == ""){
                        $(y[i]).css({"background-color": "var(--required-color-opacity)", "color": "var(--text-color-3)"});
                        canNext = false;
                    }
                    else {
                        $(y[i]).css({"background": "", "color": ""});
                    }

                    if (phone.length < 11){
                        $('#phone').css({"background-color": "var(--required-color-opacity)", "color": "var(--text-color-3)"});
                    }
                    else{
                        $('#phone').css({"background": "", "color": ""});
                    }

                    if (i == 6 && canNext == false){
                        $('#email').css({"background-color": "var(--required-color-opacity)", "color": "var(--text-color-3)"});
                    }
                    else{
                        $('#email').css({"background": "", "color": ""});
                    }
                }

                for (i = 0; i < y.length; i++){
                    if(y[i].value == "" || i == 6 && canNext == false){
                        return false;
                    }
                    
                }
            }

            $('#tab-'+hideTab).css("display", "none");
            $('#tab-'+showTab).css("display", "flex");
            $(".form-field").css({"background": "", "color": ""});
            canNext = true;
        }

        // Submit Validation
        function submit(e){
            if(e){
                var currentTab = 0;

                x = $("#tab-"+e);
                y = $(x).find(".form-field");

                for (i = 0; i < y.length; i++){
                    if(y[i].value == ""){
                        $(y[i]).css({"background-color": "var(--required-color-opacity)", "color": "var(--text-color-3)"});
                    }
                    else {
                        $(y[i]).css({"background": "", "color": ""});
                    }
                }

                for (i = 0; i < y.length; i++){
                    if(y[i].value == ""){
                        return false;
                    }
                }

                
            }
        }

        //Letter Validation
        $('.letters-only').keypress(function (e) {
          var txt = String.fromCharCode(e.which);
          if (!txt.match(/[A-Za-z ]/)) {
              return false;
          }
        });

        //Numeric Validation
        $('.numeric-only').keypress(function (e) {
          var txt = String.fromCharCode(e.which);
          if (!txt.match(/[0-9]/)) {
              return false;
          }
        });

        //Numeric Validation
        $('.numeric-w-hyphen').keypress(function (e) {
          var txt = String.fromCharCode(e.which);
          if (!txt.match(/[0-9-]/)) {
              return false;
          }
        });

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