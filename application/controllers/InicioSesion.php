<?php

class InicioSesion extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Login');
    $this->load->library('form_validation');
    $this->load->library('session');
  }

  public function VerificaSesion()
  {
    $this->form_validation->set_rules('loginUsuario', 'Usuario', 'required|trim', ['required' => 'El campo usuario es requerido']);
    $this->form_validation->set_rules('loginContraseña', 'Contraseña', 'required|trim', ['required' => 'El campo contraseña es requerido']);

    if ($this->form_validation->run() === FALSE) {
      log_message('error', 'Errores de validación: ' . validation_errors());
      $response = [
        'status' => 'error',
        'message' => strip_tags(validation_errors()) // limpiar las etiquetas HTML
      ];
      $this->output
        ->set_status_header(400)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }

    $usuario = $this->input->post('loginUsuario');
    $contraseña = $this->input->post('loginContraseña');

    $result = $this->Login->Iniciar_sesion($usuario);

    if (isset($result['status']) && $result['status'] === 'error') {
      $response = $result;
      $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }

    if (password_verify($contraseña, $result['contraseña'])) {
      $this->session->set_userdata([
        'usuario' => $result['nombre_usuario'],
        'puesto'  => $result['nombre_puesto'],
        'id_puesto' => $result['id_puesto'],
        'id_usuario' => $result['id_Usuario_Empleado'],  // Guardamos el id_Usuario_Empleado
        'logged_in' => true
      ]);
      $response = [
        'status' => 'success',
        'message' => 'Inicio de sesión exitoso: ' . $result['nombre_usuario'],
        'redireccionar' => base_url('dashboard'),
        'usuario' => $result['nombre_usuario'],
        'id_usuario' => $result['id_Usuario_Empleado'],  // Guardamos el id_Usuario_Empleado
        'puesto'  => $result['nombre_puesto'],
        'id_puesto' => $result['id_puesto']
      ];
      $this->output
        ->set_status_header(200)
        ->set_output(json_encode($response));
      return;
    } else {
      $response = [
        'status' => 'error',
        'message' => 'La contraseña es incorrecta'
      ];
      $this->output
        ->set_status_header(400)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }
  }


  public function CrearCuenta()
  {

    $this->form_validation->set_rules('registro_usuario', 'Usuario', 'required|trim', ['required' => 'El campo usuario es requerido']);
    $this->form_validation->set_rules('registro_contraseña', 'Contraseña', 'required|trim', ['required' => 'El campo contraseña es requerido']);
    $this->form_validation->set_rules('registro_contraseña2', 'Verificar', 'required|trim', ['required' => 'Se necesita verificar la contraseña']);
    $this->form_validation->set_rules('registro_id_empleado', 'Identificador', 'required|trim', ['required' => 'El campo de identificador es requerido']);

    if ($this->form_validation->run() === False) {
      log_message('error', 'Errores de validación: ' . validation_errors());
      $response = [
        'status' => 'error',
        'message' => strip_tags(validation_errors()) // lo mismo quitar etiquetas HTML
      ];
      //echo json_encode($response);
      $this->output
        ->set_status_header(400)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }

    $usuario = $this->input->post('registro_usuario');
    $contraseña = $this->input->post('registro_contraseña');
    $verificarContraseña = $this->input->post('registro_contraseña2');
    $id = $this->input->post('registro_id_empleado');

    // var_dump($usuario, $contraseña, $verificarContraseña, $id);
    if ($contraseña == $verificarContraseña) {

      $registrado = $this->Login->Registrar_usuario($usuario, $contraseña, $id);
      if ($registrado['status'] === 'error') {
        $this->output
          ->set_status_header(500)
          ->set_content_type('application/json')
          ->set_output(json_encode($registrado)); // 500 es el código de error interno del servidor
        return;
      }
      //echo json_encode($registrado);
      $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($registrado));
      return;
    } else {
      $response = ['status' => 'error', 'message' => 'Las contraseñas no coinciden'];
      //echo json_encode($response);
      $this->output
        ->set_status_header(400)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }
  }

  public function CerrarSesion()
  {
    $this->session->sess_destroy();
    $response = ['status' => 'success', 'message' => 'Sesion cerrada'];
    //echo json_encode($response);
    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
    return;
  }
}
