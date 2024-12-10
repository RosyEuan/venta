$(document).ready(function(){
  $('#formulario_datosPerfil').each(function(){
    //event.preventDefault(); // Solo si recibe un evento
    const controller = $(this).data('controller'); // Aqui lo llamo desde el atributo data del form y lo guardo en una variable
  $.ajax({
    url: controller,
    type: 'GET',
    data:$(this).serialize(),
    dataType:'json',
    success: function(response) {
        console.log(response); // Verifica la estructura de la respuesta aquí
        if (response.status === 'success') {
            $('#nombre').val(response.data.nombre_empleado);
            $('#apellidos').val(response.data.apellidos_empleado);
            $('#fecha-nacimiento').val(response.data.fecha_nacimiento);
            $('#domicilio').val(response.data.domicilio);
            $('#usuario').val(response.data.nombre_usuario);
            $('#contraseña').val(response.data.contraseña);
            $('#correo').val(response.data.email);
            $('#telefono').val(response.data.telefono);
            $('#curp').val(response.data.CURP);
            $('#rfc').val(response.data.RFC);
            $('#puesto').val(response.data.nombre_puesto);
            $('#salario').val(response.data.salario);
        } else {
            alert(response.message);
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error en AJAX:', textStatus, errorThrown); // Muestra el error en la consola
        console.error('Detalles del error'+jqXHR.responseText);
        alert('Error al cargar los datos del perfil');
    }
  });
  });
  
});


$(document).ready(function () {
  $("#guardarCambios").on("click", function (event) {
      event.preventDefault(); // Prevenir comportamiento por defecto del botón

      // Obtener la URL del controlador desde el atributo data-controller1
      const controllerUrl = $(this).data("controller1");

      // Capturar los datos del formulario manualmente
      const datosPerfil = {
          domicilio: $("#domicilio").val().trim(),
          usuario: $("#usuario").val().trim(),
          correo: $("#correo").val().trim(),
          telefono: $("#telefono").val().trim(),
      };

      // // Validar que los campos obligatorios no estén vacíos
      // if (!datosPerfil.usuario || !datosPerfil.correo || !datosPerfil.telefono) {
      //     alert("Por favor, complete todos los campos obligatorios.");
      //     return;
      // }

      // // Validar formato de correo electrónico
      // const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      // if (!emailRegex.test(datosPerfil.correo)) {
      //     alert("Por favor, ingrese un correo electrónico válido.");
      //     return;
      // }

      // Enviar datos al servidor mediante AJAX
      $.ajax({
          url: controllerUrl,
          method: "POST",
          data: datosPerfil,
          dataType: "json",
          success: function (response) {
              if (response.status === "success") {
                  alert("Perfil actualizado correctamente.");
              } else {
                  alert("Error: " + response.message);
              }
          },
          error: function (xhr, textStatus, errorThrown) {
              console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
              alert("Ocurrió un error al intentar actualizar el perfil.");
          },
      });
  });
});