"use strict";

$("#modal-1").fireModal({body: 'Modal body text goes here.'});
$("#modal-2").fireModal({body: 'Modal body text goes here.', center: true});

let modal_3_body = '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += '[\n';
modal_3_body += ' {\n';
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n"
modal_3_body += "   }\n"
modal_3_body += ' }\n';
modal_3_body += ']';
modal_3_body += '</code></pre>';
$("#modal-3").fireModal({
  title: 'Modal with Buttons',
  body: modal_3_body,
  buttons: [
    {
      text: 'Click, me!',
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
        alert('Hello, you clicked me!');
      }
    }
  ]
});

$("#modal-4").fireModal({
  footerClass: 'bg-whitesmoke',
  body: 'Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.',
  buttons: [
    {
      text: 'No Action!',
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});

$("#modal-5").fireModal({
  title: 'Login',
  body: $("#modal-login-part"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
//   buttons: [
//     {
//       text: 'Login',
//       submit: true,
//       class: 'btn btn-primary btn-shadow',
//       handler: function(modal) {
//       }
//     }
//   ]
});

$("#modal-6").fireModal({
  body: '<p>Now you can see something on the left side of the footer.</p>',
  created: function(modal) {
    modal.find('.modal-footer').prepend('<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
  },
  buttons: [
    {
      text: 'No Action',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});

$('.oh-my-modal').fireModal({
  title: 'My Modal',
  body: 'This is cool plugin!'
});


// delivery form
document.getElementById('deliveryForm').addEventListener('submit', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Gather selected order IDs
    var selectedOrderIds = [];
    var checkboxes = document.querySelectorAll('input[name="orderlistid[]"]:checked');
    checkboxes.forEach(function(checkbox) {
        selectedOrderIds.push(checkbox.value);
    });

    // Set the selected order IDs into the hidden input field
    document.getElementById('orderlistids').value = selectedOrderIds.join(',');

    // Now you can submit the form programmatically
    this.submit(); // 'this' refers to the form element
});



// order reject
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('rejectButton').addEventListener('click', function() {
        var form = document.querySelector('.rejectForm'); // Find the form element
        var selectedOrderIds = []; // Array to store selected order IDs
        var checkedCheckboxes = document.querySelectorAll('input[name="orderlistid[]"]:checked');
        checkedCheckboxes.forEach(function(checkbox) {
            selectedOrderIds.push(checkbox.value);
        });
        form.querySelector('.orderlistids').value = selectedOrderIds.join(','); // Set the selected order IDs into the hidden input field
    });

    document.querySelectorAll('.confirmReject').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.closest('.rejectForm'); // Find the closest form element
            form.submit(); // Submit the form
        });
    });
});


// re confirm
document.addEventListener('DOMContentLoaded', function() {
    // When the Order Re-confirm button is clicked
    document.querySelector('#orderreconfirm').addEventListener('click', function() {
        var form = document.querySelector('.reconfirmForm'); // Find the form element
        var selectedOrderIds = []; // Array to store selected order IDs
        var checkedCheckboxes = document.querySelectorAll('input[name="orderlistid[]"]:checked');
        checkedCheckboxes.forEach(function(checkbox) {
            selectedOrderIds.push(checkbox.value);
        });
        // if (selectedOrderIds.length > 0) {
            form.querySelector('.orderlistids').value = selectedOrderIds.join(','); // Set the selected order IDs into the hidden input field
        // } else {
        //     alert('Please select at least one order to reconfirm.');
        //     return; // Exit the function if no orders are selected
        // }
    });

    // When the Confirm button inside the modal is clicked
    document.querySelector('.confirmorder').addEventListener('click', function() {
        var form = document.querySelector('.reconfirmForm'); // Find the form element
        form.submit(); // Submit the form
    });
});
