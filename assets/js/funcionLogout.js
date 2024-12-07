$(document).ready(function () {
  $('#button_logout').click(function () {
    const logoutUrl = $(this).data('logout-url');
    const baseUrl = $(this).data('base-url');
    logout(logoutUrl, baseUrl);
  });
});

function logout(logoutUrl, baseUrl) {
  $.ajax({
    url: logoutUrl,
    type: 'POST',
    dataType: 'json',
    success: function (response) {
      window.location.href = baseUrl;
      alert('Detalles: ' + response.message);
    },
    error: function (xhr, status, error) {
      console.error('Ocurrió un error: ' + error);
      console.error('Detalles del error: ' + xhr.responseText);
      alert('Ocurrió un error: ' + error);
    }
  });
}
