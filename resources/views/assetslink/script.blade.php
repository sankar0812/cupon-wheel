<script src="{{ url('assets/modules/jquery.min.js') }}"></script>
<script src="{{ url('assets/modules/popper.js') }}"></script>
<script src="{{ url('assets/modules/tooltip.js') }}"></script>
<script src="{{ url('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ url('assets/modules/moment.min.js') }}"></script>
<script src="{{ url('assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ url('assets/modules/jquery.sparkline.min.js') }}"></script>
<script src="{{ url('assets/modules/chart.min.js') }}"></script>
<script src="{{ url('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ url('assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ url('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<script src="{{ url('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ url('assets/js/page/index.js') }}"></script>
<script src="{{ url('assets/js/page/modules-datatables.js') }}"></script>
<!-- Template JS File -->
<script src="{{ url('assets/js/scripts.js') }}"></script>
<script src="{{ url('assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ url('assets/js/page/bootstrap-modal.js')}}"></script>
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


    $(function() {
    // Function to add new row
    function addNewRow() {
        var template = $('tr.template_row:first');
        $('.no_entries_row').css('display', 'none');
        var newRow = template.clone();
        var lastRow = $('tr.template_row:last').after(newRow);

        // Bind click event to newly added cancel buttons
        $('.list_cancel').on('click', function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(this).closest('tr').remove();
            if ($('.list_cancel').length === 1) {
                $('.no_entries_row').css('display', 'inline-block');
            }
            console.log($('.list_cancel').length);
        });

        // Bind change event to select elements with class 'label'
        $('select.label').on('change', function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(this).css('background-color', $(this).val());
        });
    }

    // Bind click event to 'Add one row' button
    $('a.list_add').on('click', addNewRow);

    // Function to show popup
    function showPopUp() {
        var x = document.getElementsByClassName("popup")[0];
        console.log(x);
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "popup");
        }, 3000);
    }

    // Bind click event to first submit button with class 'submit'
    $('.submit:first').on('click', showPopUp);
});



// now am or pm
function getTime() {
  // Create a new Date object
  var currentTime = new Date();

  // Get hours and minutes
  var hours = currentTime.getHours();
  var minutes = currentTime.getMinutes();

  // Convert hours to 12-hour format
  var meridiem = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // Handle midnight (0 hours)

  // Add leading zeros to minutes if necessary
  minutes = minutes < 10 ? '0' + minutes : minutes;

  // Display the time and AM/PM
  document.getElementById('time').innerHTML = hours + ':' + minutes;
  document.getElementById('ampm').innerHTML = meridiem;
}

// Call getTime() initially to display the time immediately
getTime();

// Call getTime() every second to update the time
setInterval(getTime, 1000);





// subscription cancal
function confirmApprovalcan(route) {
        if (confirm("Are you sure you want to approve this subscription cancel?")) {
            window.location.href = route;
        }
    }

    // subscription change
    function confirmApprovalch(route) {
        if (confirm("Are you sure you want to approve this subscription change?")) {
            window.location.href = route;
        }
    }

    // customer approval
    function confirmApprove(route) {
        if (confirm("Are you sure you want to perform this action?")) {
            window.location.href = route;
        }
    }

    //cutomer block list approval
    function confirmApprovalblock(route) {
        if (confirm("Are you sure you want to approve this action?")) {
            window.location.href = route;
        }
    }
</script>



