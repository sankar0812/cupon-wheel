<link rel="stylesheet" href="{{ url('assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/fontawesome/css/all.min.css') }}">

<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ url('ssets/modules/jqvmap/dist/jqvmap.min.css') }}a">
<link rel="stylesheet" href="{{ url('assets/modules/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/select2/dist/css/select2.min.css') }}">

<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ url('assets/modules/ionicons/css/ionicons.min.css') }}">

<link rel="stylesheet" href="{{ url('assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
    href="{{ url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<!-- Template CSS -->
<link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ url('assets/css/components.css') }}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
</script>


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
#html5-qrcode-button-camera-permission{
    vertical-align: middle;
    padding: 7px 12px;
    font-weight: 600;
    letter-spacing: .3px;
    border-radius: 30px;
    font-size: 12px;
    background-color: #ffc107;
    border:none;
    color:#fff;
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



    .wrapper {
        width: 90%;
        margin: 5px auto;
    }

    .common_table {
        width: 100%;
        border: none;
    }

    .common_table thead th {
        background-color: gray;
    }

    .template_row:first-child {
        display: none;
        margin: 0 auto;
    }

    .template_row input {
        border-radius: 5px;
    }

    .controls a {
        text-decoration: none;
    }

    .list_add {
        text-decoration: none;
    }

    .list_add:before {
        color: white;
        border: 1px solid gray;
        padding: 0 5px;
        border-radius: 5px;
        background-color: gray;
        margin-right: 20px;
    }

    .action_btn {
        text-align: center;
    }

    .action_btn input {
        width: 120px;
        padding: 5px;
        border-radius: 10px;
        margin: 10px;
    }

    .action_btn input:first-child {
        background-color: black;
        color: white;
    }

    @keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    .fa-times {
        font-size: 1rem;
    }

    /*
.popup {
    display: none;
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

.popup.show {
    display: block;
} */
    /* iconsize */
    .iconsize {
        list-style-type: none;
        font-size: 30px;
        color: orange;
    }
</style>
