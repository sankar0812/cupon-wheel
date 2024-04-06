<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('websiteasset/css/signupstyle.css') }}" />
    <title>Customer Register</title>
    @include('websitefile.assetslink.popmessage')
    <style>

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
                        <form action="{{ route('customers.register') }}" method="post" enctype="multipart/form-data"
                            id="myForm" onsubmit="return validateForm()">
                            @csrf
                            <div class="input-group">
                                <i class="fa-solid fa-building"></i>
                                <input type="text" placeholder="Business Name" name="businessname" autocomplete="off"
                                    id="businessname">
                                <span id="businessNameError" class="error"></span>
                            </div>

                            <div class="input-group">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" placeholder="Contact Person Name" name="personname"
                                    autocomplete="off" id="personname">
                                <span id="personNameError" class="error"></span>
                            </div>

                            <div class="input-group">
                                <i class="fa-solid fa-truck"></i>
                                <input type="text" placeholder="Delivery Address" id="deliveryAddress"
                                    name="deliveryaddress" autocomplete="off">
                                <span id="deliveryaddressError" class="error"></span>
                            </div>

                            <label>
                                <input type="checkbox" id="copyAddressCheckbox">Delivery address same as Billing address
                            </label>

                            <div class="input-group">
                                <i class="fa-solid fa-file-invoice"></i>
                                <input type="text" placeholder="Billing Address" id="billingAddress"
                                    name="billingaddress" autocomplete="off">
                                <span id="billingaddressError" class="error"></span>
                            </div>

                            <div class="input-group">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" placeholder="Email Address" name="emailaddress"
                                    autocomplete="off">
                                <span id="emailError" class="error"></span>
                            </div>

                            <div class="input-group">
                                <i class="fa-solid fa-phone"></i>
                                <input type="tel" placeholder="+91" name="phonenumber" autocomplete="off" maxlength="10">
                                <span id="phoneError" class="error"></span>
                            </div>


                            <div class="input-group">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <input type="text" placeholder="GST Number" name="gstnumber" autocomplete="off">
                            </div>

                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" placeholder="Password" id="password-field" name="password" autocomplete="off">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <span id="passwordError" class="error"></span>
                            </div>

                            <button type="submit" class="submitbtn" onclick="submitForm()">
                                SIGN UP
                            </button>
                        </form>

                        <p>
                        <h4><span>
                            Already have an account?
                            </span>
                            <a href="{{ route('customer.login') }}">Sign in here</a>
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
                        Register to get Started
                    </h2>

                </div>
                <div class="img sign-in">

                </div>
            </div>
            <!-- END SIGN IN CONTENT -->

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

</body>

</html>
