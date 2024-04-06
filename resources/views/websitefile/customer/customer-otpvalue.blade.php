<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('websiteasset/css/signupstyle.css') }}" />
    <title>Customer otp value</title>
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


                        <form action="{{ route('customers.checkotpvalue') }}" method="post"
                            enctype="multipart/form-data" id="myForm" onsubmit="return validateForm()">
                            @csrf
                            <div class="input-group">
                                <i class="fa-solid fa-check-to-slot"></i>

                                <input type="hidden" value="{{ session('customerphone') }}" name="phonenumber">
                                <input type="number" placeholder="OTP Value" name="otpvalue" class="otpvalue"
                                    autocomplete="off">
                                <span id="otpError" class="error"></span>
                            </div>

                            <button type="submit" class="submitbtn">
                                VERIFY OTP
                            </button>
                        </form>
                        <p>
                            <b>
                                <form action="{{ route('customers.otpresend') }}" enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    <input type="hidden" value="{{ session('customerphone') }}" name="phonenumber">
                                    <button type="submit" style="" class="otpbtn">Resend OTP</button>
                                </form>
                            </b>
                        </p>
                        <p>
                        <h4> <span>
                                Are you sure number is correct?
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
                        Enter Verification Code
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
            var otpvalue = document.querySelector(".otpvalue").value;
            var otpError = document.getElementById("otpError");

            // Reset previous error messages
            otpError.innerHTML = "";

            // Check if the OTP Value field is empty
            if (otpvalue.trim() === "") {
                otpError.innerHTML = "Please enter OTP Value";
                return false;
            }

            // If all validations pass, return true to allow form submission
            return true;
        }
    </script>
</body>

</html>
