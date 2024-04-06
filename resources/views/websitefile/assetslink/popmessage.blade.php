<style>
    /* message failed*/
    .popup-message {
        position: fixed;
        top: 20px;
        right: -400px;
        /* Initially off screen */
        width: 300px;
        padding: 15px;
        background-color: rgb(222, 120, 0);
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
        background-color: rgb(255, 200, 0);
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
        /* Initially off screen to the right */
        width: 300px;
        padding: 15px;
        background-color: rgb(222, 120, 0);
        color: #fff;
        border-radius: 10px;
        font-size: 16px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transform: translateY(50%);
        transition: right 0.5s ease-in-out;
        /* Smooth transition effect on 'right' property */
        z-index: 9999;


        /* Ensures the popup is above other elements */
    }

    .error-popup.active {
        left: 20px;
        /* Slide in from the right when the 'active' class is applied */
    }
</style>
@if (session('failed'))
    <div id="popup-message" class="popup-message">
        {{ session('failed') }}
    </div>
@endif

@if (session('success'))
    <div id="popup-message" class="popup-mess">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div id="error-popup" class="error-popup">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    //    message
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('popup-message');

        if (popup) {
            popup.classList.add('active');
            setTimeout(function() {
                popup.classList.remove('active');
            }, 3000); // Adjust the duration (milliseconds) as needed
        }
    });

    // error
    document.addEventListener('DOMContentLoaded', function() {
        const errorPopup = document.getElementById('error-popup');

        if (errorPopup) {
            errorPopup.classList.add('active');
            setTimeout(function() {
                errorPopup.classList.remove('active');
            }, 5000); // Adjust the duration (milliseconds) as needed
        }
    });
</script>
