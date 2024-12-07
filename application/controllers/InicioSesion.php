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
        'message' => validation_errors()
      ];
      echo json_encode($response);
      return;
    }

    $usuario = $this->input->post('loginUsuario');
    $contraseña = $this->input->post('loginContraseña');

    $result = $this->Login->Iniciar_sesion($usuario);

    if (isset($result['status']) && $result['status'] === 'error') {
      echo json_encode($result);
      return;
    }

    if (password_verify($contraseña, $result['contraseña'])) {

      $this->session->set_userdata([
        'usuario' => $result['nombre_usuario'],
        'puesto'  => $result['nombre_puesto'],
        'id_puesto' => $result['id_puesto'],
        'logged_in' => true
      ]);

      echo json_encode([
        'status' => 'success',
        'message' => 'Inicio de sesión exitoso: ' . $result['nombre_usuario'],
        'redireccionar' => base_url('dashboard')
      ]);
      return;
    } else {
      echo json_encode(['status' => 'error', 'message' => 'La contraseña es incorrecta']);
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
        'message' => strip_tags(validation_errors())
      ];
      echo json_encode($response);
      return;
    }

    $usuario = $this->input->post('registro_usuario');
    $contraseña = $this->input->post('registro_contraseña');
    $verificarContraseña = $this->input->post('registro_contraseña2');
    $id = $this->input->post('registro_id_empleado');

    // var_dump($usuario, $contraseña, $verificarContraseña, $id);
    if ($contraseña == $verificarContraseña) {

      $registrado = $this->Login->Registrar_usuario($usuario, $contraseña, $id);
      echo json_encode($registrado);
      return;
    } else {
      $response = ['status' => 'error', 'message' => 'Las contraseñas no coinciden'];
      echo json_encode($response);
      return;
    }
  }

  public function CerrarSesion()
  {
    $this->session->sess_destroy();
    echo json_encode(['status' => 'success', 'message' => 'Sesion cerrada']);
  }
}
