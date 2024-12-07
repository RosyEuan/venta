$(document).ready(function () {
  const puestoUsuario = parseInt(sessionStorage.getItem('puesto'), 10);

  if (!puestoUsuario) {
    console.error('Puesto del usuario no definido.');
    alert('error en el nivel de acceso');
    return;
  }

  // busca entre li de la barra de navegar
  $('#barra_navegacion li').each(function () {
    const puestosPermitidos = $(this)
      .data('puesto')
      .toString()
      .split(' ')
      .map(Number); // se le como un array para comparar los iconos

    if (!puestosPermitidos.includes(puestoUsuario)) {
      $(this).css('display', 'none');
    }
  });
});
