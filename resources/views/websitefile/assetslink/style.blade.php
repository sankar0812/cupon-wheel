<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="{{ url('websiteasset/css/open-iconic-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('websiteasset/css/animate.css') }}">

<link rel="stylesheet" href="{{ url('websiteasset/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('websiteasset/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ url('websiteasset/css/magnific-popup.css') }}">

<link rel="stylesheet" href="{{ url('websiteasset/css/aos.css') }}">

<link rel="stylesheet" href="{{ url('websiteasset/css/ionicons.min.css') }}">

<link rel="stylesheet" href="{{ url('websiteasset/css/bootstrap-datepicker.css') }}">
<link rel="stylesheet" href="{{ url('websiteasset/css/jquery.timepicker.css') }}">


<link rel="stylesheet" href="{{ url('websiteasset/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ url('websiteasset/css/icomoon.css') }}">
<link rel="stylesheet" href="{{ url('websiteasset/css/style.css') }}">
<link rel="stylesheet" href="{{ url('websiteasset/css/customerstyle.css') }}">
<style>
    /* message failed*/
    .popup-message {
        position: fixed;
        top: 20px;
        right: -400px;
        /* Initially off screen */
        width: 300px;
        padding: 15px;
        background-color: rgb(253, 0, 9);
        color: #fff;
        border-radius: 10px;
        font-size: 16px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transform: translateY(50%);
        transition: right 0.5s ease-in-out;
        z-index: 9999;
    }

    .popup-message.active {
        right: 20px;
        /* Slide in from the right */
    }

    /* message success*/
    .popup-mess {
        position: fixed;
        top: 20px;
        right: -400px;
        /* Initially off screen */
        width: 300px;
        padding: 15px;
        background-color: rgb(71, 166, 189);
        color: #fff;
        border-radius: 10px;
        font-size: 16px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transform: translateY(50%);
        transition: right 0.5s ease-in-out;
        z-index: 9999;
    }

    .popup-mess.active {
        right: 20px;
        /* Slide in from the right */
    }

    /* error */
    .error-popup {
        position: fixed;
        top: 20px;
        right: -400px;
        /* Initially off screen */
        width: 300px;
        padding: 15px;
        background-color: rgb(253, 0, 9);
        color: #fff;
        border-radius: 10px;
        font-size: 16px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transform: translateY(50%);
        transition: right 0.5s ease-in-out;
        z-index: 9999;
    }

    .error-popup.active {
        right: 20px;
        /* Slide in from the right */
    }

    .custom-files {}

    .zoom:hover {
        -ms-transform: scale(4.0);
        /* IE 9 */
        -webkit-transform: scale(4.0);
        /* Safari 3-8 */
        transform: scale(4.0);
    }

    .bgcreate {
        background-color: black;
        color: white;
        padding: 5px;
    }





    /* .container {
    max-width: 900px;
    width: 100%;
    background-color: #fff;
    margin: auto;
    padding: 15px;
    box-shadow: 0 2px 20px #0001, 0 1px 6px #0001;
    border-radius: 5px;
    overflow-x: auto;
} */

    ._table {
        width: 100%;
        border-collapse: collapse;
    }

    ._table th,
    ._table td {
        border: 1px solid #0002;
        padding: 8px 10px;
    }

    /* form field design start */
    .form_control {
        border: 1px solid #0002;
        background-color: transparent;
        outline: none;
        padding: 8px 12px;
        font-family: 1.2rem;
        width: 100%;
        color: #333;
        font-family: Arial, Helvetica, sans-serif;
        transition: 0.3s ease-in-out;
    }

    .form_control::placeholder {
        color: inherit;
        opacity: 0.5;
    }

    .form_control:focus,
    .form_control:hover {
        box-shadow: inset 0 1px 6px #0002;
    }

    /* form field design end */

    .success {
        background-color: #24b96f !important;
    }

    .warning {
        background-color: #ebba33 !important;
    }

    .primary {
        background-color: #259dff !important;
    }

    .secondary {
        background-color: #00bcd4 !important;
    }

    .danger {
        background-color: #ff5722 !important;
    }

    .action_container {
        display: inline-flex;
    }

    .action_container>* {
        border: none;
        outline: none;
        color: #fff;
        text-decoration: none;
        display: inline-block;
        padding: 8px 14px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    .action_container>*+* {
        border-left: 1px solid #fff5;
    }

    .action_container>*:hover {
        filter: hue-rotate(-20deg) brightness(0.97);
        transform: scale(1.05);
        border-color: transparent;
        box-shadow: 0 2px 10px #0004;
        border-radius: 2px;
    }

    .action_container>*:active {
        transition: unset;
        transform: scale(.95);
    }

    .table tbody tr td {
        padding: 10px 10px;
    }




    .boderline {
        background-color: #696565;
        height: 1px;
    }

    .img-fluids {
        height: 75px;
        width: 75PX;
        padding: 5px;
        margin-top: 4px;
    }

    .floatright li {
        float: left;

        list-style-type: none;
    }

    .floatright li h5 {
        margin-left: 20px;
        margin-top: 20px;

    }



    :root {
        --primary: rgb(252, 135, 0);
        --secondary: #fff;
    }


    /* Hide inputs */
    .inputs {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }

    .group {
        display: flex;
        align-items: center;
        /* padding-left: 500px; */
    }

    /* Styles */
    label {
        display: flex;
        align-items: center;
        margin-left: 1rem;
        padding: 1rem 1rem 1rem 2rem;
        position: relative;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.25, 0.25, 0.5, 1.9);

        &::before {
            content: "";
            position: absolute;
            left: 0;
            width: 1.5rem;
            height: 1.5rem;
            background: transparent;
            border: 2px solid;
            border-radius: 0.25rem;
            z-index: -1;
            transition: all 0.25s cubic-bezier(0.25, 0.25, 0.5, 1.9);

            input[type="radio"]+& {
                border-radius: 2rem;
            }
        }
    }

    /* Checked */
    .inputs:checked+label {
        padding-left: 1em;
        color: var(--secondary);

        &::before {
            width: 100%;
            height: 100%;
            background: var(--primary);
            border: 0;
            box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.5);

        }
    }

    .hidden {
        display: none;

    }

    .widthinput {
        width: 100px;
    }


    /* days repeat */
    .weekDays-selector input {
        display: none !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        width: 50px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        padding: 10px;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: var(--primary);
        color: #ffffff;
    }

    .btn-group .btn.active {
        background-color: var(--primary);
        color: #fff;
    }

    .shadow-bg {
        background-color: rgb(247, 229, 179);
        /* border-radius: */
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .bigbutton {
        padding-left: 50px;
        padding-right: 50px;
        border-radius: 8px;
    }

    .bigbutton:hover {
        background-color: var(--primary);
    }

    /* accoution part css start here*/
    /* // Collapsible Closed */
    details {
        /* max-width: 960px; */
        width: 100%;
        margin: 1rem auto;
        padding: 0.7rem;
        background-color: rgb(229, 244, 205);
        border-radius: 1rem;
        box-shadow: 0 .25rem 1rem rgba(0, 0, 0, 0.1);

        summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
            margin-bottom: 0;
            transition: margin-bottom .4s;
            position: relative;
        }

        /* // Disable browser default marker */
        summary::-webkit-details-marker,
        summary::marker {
            content: "";
            display: none;
        }

        /* // Custom marker */
        summary::after {
            content: "▾";
            font-size: 1.5rem;
            font-weight: 400;
            line-height: 0.2;
            /* margin-right: 1rem; */
            cursor: pointer;
            background-color: rgba(blue, .1);
            padding: .75rem;
            display: grid;
            place-content: center;
            aspect-ratio: 1;
            line-height: 0;
            position: absolute;
            top: -.5rem;
            right: -2.5rem;
            border-radius: 50%;
        }

        *:not(summary) {
            animation-name: fade;
            animation-duration: .4s;
        }
    }

    /* // Collapsible OPEN */
    details[open] {

        /* // Custom marker */
        summary {
            margin-bottom: 1.5rem;

            &::after {
                content: "-";
            }
        }
    }

    /*
@keyframes fade {
  0%{
    opacity: 0;
  }

  100%{
    opacity: 1;
  }
} */
    .roundersuccess {
        border-radius: 20px;
        width: 70px;
        padding: 10px;
        background-color: rgb(95, 166, 0);
    }
    .rounderdanger {
        border-radius: 20px;
        width: 70px;
        padding: 10px;
        background-color: rgb(221, 10, 10);
    }
    .backtable {
        background-color: none;
        border: none !important;
    }

    .border {
        margin-top: 20px;
        margin-bottom: 20px;
        border: solid rgb(202, 205, 196);
        border-width: thin;
    }
.buttonown{
    border: none;
    background-color: rgb(229, 244, 205);
}
.tablepadd{
    margin-bottom: 50px;
}
</style>
