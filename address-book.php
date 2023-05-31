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

    <link rel="stylesheet" href="./css/personal-info.css">
    <link rel="stylesheet" href="./css/additional-address-book.css">
</head>
<body>
    <div class="popup-background" id="addNewAddress">
        <div class="row popup-container">
            <form action="" id="addAddressForm" class="needs-validation" novalidate>
                <h3 class="col-12">Add a New Address</h3>
                <div class="row text-start">
                    <div class="form-group col-12">
                        <label for="address" class="form-label">Street/Building/House No. <span id="required">*</span></label>
                        <input type="text" class="form-control form-field" id="address" name="address" required>
                    </div>
                </div>
                <div class="row text-start">
                    <div class="form-group col-sm-4">
                        <label for="province" class="form-label">Province <span id="required">*</span></label>
                        <select class="form-select form-field" id="province" name="province" required>
                            <option value="Laguna" selected>Laguna</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="city" class="form-label">City/Municipality <span id="required">*</span></label>
                        <select class="form-select form-field" id="city" name="city" required>
                            <option value="Santa Rosa" selected>Santa Rosa</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="barangay" class="form-label">Barangay <span id="required">*</span></label>
                        <select class="form-select form-field" id="barangay" name="barangay" required>
                            <option value="Aplaya" selected>Aplaya</option>
                        </select>
                    </div>
                </div>
                <div class="row text-start">
                    <div class="form-group col-sm-3">
                        <label for="zipcode" class="form-label">Zipcode <span id="required">*</span></label>
                        <input type="text" class="form-control form-field numeric-only" id="zipcode" name="zipcode" minlength="4" maxlength="4" required>
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="phone" class="form-label">Mobile Number <small>(09123456789)</small> <span id="required">*</span></label>
                        <input type="tel" class="form-control form-field numeric-only" id="phone" name="phone" pattern="[0-9]{11}" maxlength="11" required>
                    </div>
                </div>
                <div class="button-container">
                    <div class="btn" onclick="closeBtn()">Close</div>
                    <button type="submit" class="btn" name="submitNewPassword">Done</button>
                </div>
            </form>
        </div>
    </div>
    <!--Navbar-->
    <div class="login-bar" id="top-var">
        <div class="text-1">
            My Profile
        </div>
        <div class="row">
            <div class="col-9 d-flex align-items-center">
                <div class="row" id="navItemContainer">
                    <a href="#Home" class="col-3">
                        <div class="text-1" id="navItem">
                            Home
                        </div>
                    </a>
                    <a href="" class="col-3">
                        <div class="text-1" id="navItem">
                            Profile
                        </div>
                    </a>
                    <a href="request-documents.php" class="col-3">
                        <div class="text-1" id="navItem">
                            Request
                        </div>
                    </a>
                    <a href="#About" class="col-3">
                        <div class="text-1" id="navItem">
                            About
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-3 p-0">
                <div class="flex-column justify-content-end d-flex align-items-end w-100 logout-container">
                    <button class="btn" id="logoutBtn" name="logout-btn" onclick="location.href = 'logout.php';">Logout</button>
                </div> 
            </div>
        </div>
    </div>
    <!--Content-->
    <div class="row d-flex justify-content-center align-items-start m-0 content-container">
            <div class="col-3">
                <div id="person-config">
                    <div class="row">
                        <i class='bx bxs-user-circle user-icon'></i>
                    </div>
                    <div class="row text-start">
                        <a href="personal-information.php"><i class='bx bxs-user-detail' ></i>Personal Information</a>
                        <a href="" class="active"><i class='bx bxs-book'></i>Address Book</a>
                        <a href="account-security.php"><i class='bx bx-lock-alt'></i>Account Security</a>
                    </div>
                </div>
            </div>
            <div class="col-9 mt-5">
                <div id="information-container">
                    <div class="row info text-center">
                        <div class="col-12 fw-bold fs-1">My Addresses</div>
                    </div>
                    <div class="row info">
                        <label for="" class="col-4">Permanent Address: </label>
                        <p class="col-8">142 Tokyo, Japan</p>
                    </div>
                    <div class="row info">
                        <label for="deliveryAddress" class="col-4">Delivery Address: </label>
                        <select class="col-5 form-select" name="deliveryAddress" id="deliveryAddress"></select>
                    </div>
                    <div class="row info justify-content-center">
                        <button class="btn" id="addAddress" onclick="openBtn()"><i class='bx bx-location-plus'></i> Add an Address</button>
                    </div>
                    <div class="row" id="newAddressContainer">
                        <ul>
                            <li>New Address #1</li>
                            <li>New Address #2</li>
                            <li>New Address #3</li>
                            <li>New Address #4</li>
                            <li>New Address #5</li>
                            <li>New Address #6</li>
                            <li>New Address #7</li>
                            <li>New Address #8</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>

    <script>
        popup = document.getElementById('addNewAddress');
      
        var openBtn = function() {
            popup.style.display ='flex';
        }
        var closeBtn = function() {
            popup.style.display ='none';
        }
    </script>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-3.6.4.js"></script>

    <script>
        $('.numeric-only').on('input', function(e) {
          $(this).val(function(i, v) {
            return v.replace(/[^0-9]/g, '');
          });
        });

        //Numeric Validation
        $('.numeric-only').keypress(function (e) {
          var txt = String.fromCharCode(e.which);
          if (!txt.match(/[0-9]/)) {
              return false;
          }
        });
    </script>
</body>
</html>