<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('websiteasset/css/signupstyle.css') }}" />
    <title>Customer Login</title>
    @include('websitefile.assetslink.popmessage')
</head>

<body>


    <div id="container" class="container">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                        <form action="{{ route('customers.login') }}" method="post" enctype="multipart/form-data"
                            id="myForm" onsubmit="return validateForm()">
                            @csrf
                            <div class="input-group">
                                <i class="fa-solid fa-phone"></i>
                                <input type="tel" placeholder="+91" name="phonenumber" autocomplete="off">
                                <span id="phoneError" class="error"></span>
                            </div>

                            <div class="input-group">
                                <i class="fa-solid fa-key"></i>
                                <input type="password" placeholder="Password" id="password-field" name="password"
                                    autocomplete="off">
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <span id="passwordError" class="error"></span>
                            </div>

                            <button type="submit" class="submitbtn">
                                SIGN IN
                            </button>
                        </form>
                        <p>
                            <b>
                                <a href="{{ url('customer-forgotpassword') }}">Forgot password?</a>
                            </b>
                        </p>
                        <p>
                        <h4> <span>
                                Don't have an account?
                            </span>
                            <a href="{{ url('customer-register') }}">Sign up here</a>
                        </h4>
                        </p>

                    </div>
                </div>

            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">

                    <div class="form sign-in">


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


            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">

                </div>
                <div class="text sign-up">
                    <h2>
                        Login with your phone number
                    </h2>

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
            container.classList.toggle('sign-up')
            container.classList.toggle('sign-up')
        }

        setTimeout(() => {
            container.classList.add('sign-up')
        }, 200)
    </script>
<script>

    function validateForm() {
        var phoneNumber = document.getElementsByName("phonenumber")[0].value;
        var password = document.getElementById("password-field").value;

        var phoneError = document.getElementById("phoneError");
        var passwordError = document.getElementById("passwordError");

        // Reset previous error messages
        phoneError.innerHTML = "";
        passwordError.innerHTML = "";

        // Check if the Phone Number field is empty or not in a valid format
        if (phoneNumber.trim() === "" || !validatePhoneNumber(phoneNumber)) {
            phoneError.innerHTML = "Please enter a valid Phone Number";
            return false;
        }

        // Check if the Password field is empty or not meeting the criteria
        if (password.trim() === "" || !validatePassword(password)) {
            passwordError.innerHTML = "Please enter a valid Password (minimum 8 characters)";
            return false;
        }

        // If all validations pass, return true to allow form submission
        return true;
    }

    function validatePhoneNumber(phone) {
        var phoneRegex = /^\+?\d{1,10}$/;
        return phoneRegex.test(phone);
    }

    function validatePassword(password) {
        // Add any password validation logic as needed
        return password.length >= 8;
    }
</script>
</body>

</html>
