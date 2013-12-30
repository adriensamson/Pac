$(document).ready(function () {
  $('#emailForm').on('submit', function(e) {
    e.preventDefault();

    var $form     = $(this);
    var formData  = $form.serialize();

    $.post($form.attr('action'), formData, function(data) {
        var dataJson = JSON.parse(data);

        if (!dataJson.status) {
          $('.purchase-message').removeClass('hidden');
        } else {
          $('.paypal-button').removeClass('hidden');
        }
    });
  });
});