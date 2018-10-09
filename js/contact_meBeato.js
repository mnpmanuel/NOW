$(function() {

  $("#contactFormBeato input,#contactFormBeato textarea").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var local = $("input#localBeato").val();
      var name = $("input#nameBeato").val();
      var email = $("input#emailBeato").val();
      var phone = $("input#phoneBeato").val();
      var space = $("select#spaceBeato").val();
      var message = $("textarea#messageBeato").val();
      var firstName = name; // For Success/Failure Message
      // Check for white space in name for Success/Fail message
      if (firstName.indexOf(' ') >= 0) {
        firstName = name.split(' ').slice(0, -1).join(' ');
      }
      $this = $("#sendMessageButtonBeato");
      $this.prop("disabled", false); // Disable submit button until AJAX call is complete to prevent duplicate messages
      $.ajax({
        url: "././contact_meBeato.php",
        type: "POST",
        data: {
          local: local,
          name: name,
          phone: phone,
          email: email,
          space: space,
          message: message
        },
        cache: false,
        success: function() {
          // Success message
          $('#successBeato').html("<div class='alert alert-success'>");
          $('#successBeato > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#successBeato > .alert-success')
            .append("<strong>Your message has been sent. </strong>");
          $('#successBeato > .alert-success')
            .append('</div>');
          //clear all fields
          $('#contactFormBeato').trigger("reset");
        },
        error: function() {
          // Fail message
          $('#successBeato').html("<div class='alert alert-danger'>");
          $('#successBeato > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#successBeato > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!"));
          $('#successBeato > .alert-danger').append('</div>');
          //clear all fields
          $('#contactFormBeato').trigger("reset");
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false); // Re-enable submit button when AJAX call is complete
          }, 1000);
        }
      });
    },
    filter: function() {
      return $(this).is(":visible");
    },
  });

  $("a[data-toggle=\"tab\"]").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
  });
});

/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
  $('#successBeato').html('');
});
