<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('websiteasset/css/signupstyle.css') }}" />
    <title>Change Password</title>
    @include('websitefile.assetslink.popmessage')
    <style>
        .otpvalue {
            text-align: center;

        }

        /* Remove the up and down arrows for number input */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <div id="container" class="container">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">



                    </div>
                </div>

            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">

                    <div class="form sign-in">

                        <form action="{{route('customer.changepassword')}}" method="post" enctype="multipart/form-data" id="myForm"
                            onsubmit="return validateForm()">
                            @csrf

                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                 <input type="hidden" value="{{ session('customerid') }}" name="customerid">
                                 <input type="hidden" value="{{ session('customerphone') }}" name="phonenumber">
                                <input type="password" placeholder="New Password" id="password-field" name="newpassword"
                                    autocomplete="off">
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <span id="passwordError" class="error"></span>
                            </div>

                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" placeholder="Confirm Password" id="confirmpassword-field"
                                    name="" autocomplete="off">
                                <span toggle="#confirmpassword-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <span id="confirmpasswordError" class="error"></span>
                            </div>

                            <button type="submit" class="submitbtn">
                                Confirm
                            </button>
                        </form>

                        <p>
                        <h4> <span>
                                I Know the password
                            </span>
                            <a href="{{ url('customer-login') }}">Sign in here</a>
                        </h4>
                        </p>
                    </div>

                </div>
                <div class="form-wrapper">

                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">

                <div class="text sign-in">
                    {{-- <img src="{{ url('websiteasset/images/final.png') }}" alt="" height="70"> --}}
                    <h2>
                        Change Password
                    </h2>

                </div>
                <div class="img sign-in">

                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">

                </div>

            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ url('websiteasset/js/registerpage.js') }}"></script>
    <script>
        let container = document.getElementById('container')

        toggle = () => {
            container.classList.toggle('sign-in')
            container.classList.toggle('sign-in')
        }

        setTimeout(() => {
            container.classList.add('sign-in')
        }, 200)
    </script>
    <script>
        function validateForm() {
            var password = document.getElementById("password-field").value;
            var confirmpassword = document.getElementById("confirmpassword-field").value;

            var passwordError = document.getElementById("passwordError");
            var confirmpasswordError = document.getElementById("confirmpasswordError");

            // Reset previous error messages
            passwordError.innerHTML = "";
            confirmpasswordError.innerHTML = "";

            // Check if the Password field is empty or not meeting the criteria
            if (password.trim() === "" || !validatePassword(password)) {
                passwordError.innerHTML = "Please enter a valid Password (minimum 8 characters)";
                return false;
            }

            // Check if the confirmPassword field is empty or not meeting the criteria
            if (confirmpassword.trim() === "" || !validateConfirmPassword(confirmpassword)) {
                confirmpasswordError.innerHTML = "Please enter a valid Confirm Password (minimum 8 characters)";
                return false;
            }

            // Check if password matches confirm password
            if (password !== confirmpassword) {
                confirmpasswordError.innerHTML = "Passwords do not match";
                return false;
            }

            // If all validations pass, return true to allow form submission
            return true;
        }
    </script>
</body>

</html>
