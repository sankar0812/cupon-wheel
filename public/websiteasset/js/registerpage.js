 // address
 $(document).ready(function() {
    $('#copyAddressCheckbox').change(function() {
        if (this.checked) {
            // Copy the value from delivery address to billing address
            $('#billingAddress').val($('#deliveryAddress').val());
        } else {
            // Clear the billing address when the checkbox is unchecked
            $('#billingAddress').val('');
        }
    });
});

// hidden passowrd
$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

function submitForm() {
    var phoneNumberInput = document.querySelector('input[name="phonenumber"]');
    if (phoneNumberInput.value.length !== 10) {
        document.getElementById("phoneError").innerText = "Phone number must be 10 digits long";
        return;
    }
    // Proceed with form submission
    // Example:
    // document.forms["yourFormName"].submit();
}



// register validate form
function validateForm() {
    var businessName = document.getElementById("businessname").value;
    var personname = document.getElementById("personname").value;
    var deliveryAddress = document.getElementById("deliveryAddress").value;
    var billingAddress = document.getElementById("billingAddress").value;
    var email = document.getElementsByName("emailaddress")[0].value;
    var phone = document.getElementsByName("phonenumber")[0].value;
    var password = document.getElementsByName("password")[0].value;

    var businessNameError = document.getElementById("businessNameError");
    var personNameError = document.getElementById("personNameError");
    var deliveryaddressError = document.getElementById("deliveryaddressError");
    var billingaddressError = document.getElementById("billingaddressError");
    var emailError = document.getElementById("emailError");
    var phoneError = document.getElementById("phoneError");
    var passwordError = document.getElementById("passwordError");

    // Reset previous error messages
    businessNameError.innerHTML = "";
    personNameError.innerHTML = "";
    deliveryaddressError.innerHTML = "";
    billingaddressError.innerHTML = "";
    emailError.innerHTML = "";
    phoneError.innerHTML = "";
    passwordError.innerHTML = "";

    // Check if the Business Name field is empty
    if (businessName.trim() === "") {
        businessNameError.innerHTML = "Please enter Business Name";
        return false;
    }

    if (personname.trim() === "") {
        personNameError.innerHTML = "Please enter Contact Person Name";
        return false;
    }

    if (deliveryAddress.trim() === "") {
        deliveryaddressError.innerHTML = "Please enter Delivery Address";
        return false;
    }

    if (billingAddress.trim() === "") {
        billingaddressError.innerHTML = "Please enter Billing Address";
        return false;
    }

    // Check if the Email field is empty or not in a valid format
    if (email.trim() === "" || !validateEmail(email)) {
        emailError.innerHTML = "Please enter a valid Email Address";
        return false;
    }

    // Check if the Phone Number field is empty or not in a valid format
    if (phone.trim() === "" || !validatePhoneNumber(phone)) {
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

function validateEmail(email) {
    // Regular expression for validating an Email Address
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePhoneNumber(phone) {
    // Regular expression for validating a Phone Number (assuming it's a simple format)
    var phoneRegex = /^\+?\d{1,10}$/;
    return phoneRegex.test(phone);
}

function validatePassword(password) {
    // Password should have a minimum length of 8 characters
    return password.length >= 8;
}
