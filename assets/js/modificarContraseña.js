$(document).ready(function () {
  //
  $('#formulario_recuperar').on('submit', function (event) {
    event.preventDefault();
    const controller = $(this).data('controller');
    const redirect = $(this).data('redirect');
    var datos = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: controller,
      data: datos,
      dataType: 'json',
      success: function (response) {
        console.log(response.message);
        alert(response.message);
        window.location.href = redirect;
      },
      error: function (xhr, status, error) {
        console.error(status);
        console.error(xhr.responseText);
        console.error(error);

        alert(xhr.responseJSON.message);
      }
    });
  });
});
