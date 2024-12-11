$(document).ready(function () {
  $('#passwordModal').on('submit', function () {
    const url_controller = $(this).data('controller-verify');
    $.ajax({
      type: 'POST',
      url: url_controller,
      data: $(this).serialize(),
      dataType: 'json',
      success: function (response) {
        alert(response.message);
      },
      error: function (xhr, status, error) {
        console.error('error', error);
        console.error('status ', status);
        console.error('detalles del error ', xhr.responseText);
        alert(
          'Error: No se encontro el correo.' +
            (xhr.responseJSON ? xhr.responseJSON.message : 'Error desconocido')
        );
      }
    });
  });
});
