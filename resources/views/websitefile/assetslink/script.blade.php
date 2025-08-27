<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
<script src="{{ url('websiteasset/js/jquery.min.js') }}"></script>
<script src="{{ url('websiteasset/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ url('websiteasset/js/popper.min.js') }}"></script>
<script src="{{ url('websiteasset/js/bootstrap.min.js') }}"></script>
<script src="{{ url('websiteasset/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ url('websiteasset/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ url('websiteasset/js/jquery.stellar.min.js') }}"></script>
<script src="{{ url('websiteasset/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('websiteasset/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ url('websiteasset/js/aos.js') }}"></script>
<script src="{{ url('websiteasset/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ url('websiteasset/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('websiteasset/js/jquery.timepicker.min.js') }}"></script>
<script src="{{ url('websiteasset/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ url('websiteasset/js/google-map.js') }}"></script>
<script src="{{ url('websiteasset/js/main.js') }}"></script>
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


//     // add row
//     function create_tr(table_id) {
//     let table_body = document.getElementById(table_id),
//         first_tr = table_body.firstElementChild,
//         tr_clone = first_tr.cloneNode(true);

//     // Clear input values in the cloned row
//     clean_tr_input_values(tr_clone);

//     table_body.appendChild(tr_clone);
// }

// function clean_tr_input_values(tr) {
//     let inputs = tr.querySelectorAll('input, select');

//     inputs.forEach(input => {
//         input.value = '';
//     });
// }

// function remove_tr(element) {
//     let tbody = element.closest('tbody');
//     if (tbody.children.length === 1) {
//         alert("You don't have permission to delete this.");
//     } else {
//         element.closest('tr').remove();
//     }
// }


// hidden page
document.addEventListener("DOMContentLoaded", function() {
    const morningCheckbox = document.getElementById("cb1");
    const eveningCheckbox = document.getElementById("cb2");
    const morningDropdown = document.getElementById("morningDropdown");
    const eveningDropdown = document.getElementById("eveningDropdown");

    morningCheckbox.addEventListener("change", function() {
        morningDropdown.classList.toggle("hidden", !this.checked);
    });

    eveningCheckbox.addEventListener("change", function() {
        eveningDropdown.classList.toggle("hidden", !this.checked);
    });
});

// repeat day

document.addEventListener("DOMContentLoaded", function() {
    const toggleAllWeekdaysBtn = document.getElementById('toggleAllWeekdays');
    const customBtn = document.getElementById('deselectWeekdays');
    const weekdaysCheckboxes = document.querySelectorAll('.weekday');

    // Function to update colors based on checkbox state
    function updateColors() {
        weekdaysCheckboxes.forEach(checkbox => {
            const label = checkbox.nextElementSibling;
            if (checkbox.checked) {
                label.style.backgroundColor = 'var(--primary)';
                label.style.color = '#fff';
            } else {
                label.style.backgroundColor = '#dddddd';
                label.style.color = 'initial';
            }
        });
    }

    toggleAllWeekdaysBtn.addEventListener('click', function() {
        const isChecked = !this.classList.contains('active');
        weekdaysCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateColors(); // Update colors after toggling all weekdays
        toggleAllWeekdaysBtn.classList.toggle('active'); // Toggle 'active' class
        customBtn.classList.remove('active'); // Deactivate custom button
    });

    customBtn.addEventListener('click', function() {
        weekdaysCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        toggleAllWeekdaysBtn.classList.remove('active'); // Deactivate MON-SUN button
        updateColors(); // Update colors after deselecting all weekdays
        customBtn.classList.add('active'); // Activate custom button
    });

    weekdaysCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function() {
            const allChecked = Array.from(weekdaysCheckboxes).every(checkbox => checkbox.checked);
            toggleAllWeekdaysBtn.classList.toggle('active', allChecked); // Toggle 'active' class for MON-SUN button
            customBtn.classList.remove('active'); // Deactivate custom button
            updateColors(); // Update colors after clicking any weekday checkbox
        });
    });

    // Initial color update
    updateColors();
});


// 9 to 11 and 2 to 4.30
   // Get the current time
   var currentTime = new Date();
    var currentHour = currentTime.getHours();
    var currentMinute = currentTime.getMinutes();

    // Check if the current time is within the specified ranges
    if ((currentHour >= 9 && currentHour < 11) || (currentHour === 11 && currentMinute === 30) ||
        (currentHour >= 14 && currentHour < 16) || (currentHour === 16 && currentMinute <= 30)) {
        // If current time is within the specified ranges, disable the button
        document.getElementById("countEditButton").disabled = true;
    }

</script>
