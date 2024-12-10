<?php

class cambio_contraseña extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('cambioContraseña_model');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('usuariosModel');
    $this->load->library('form_validation');
  }

  public function actualizarPassword()
  {
    $logged_in = $this->session->userdata('logged_in');
    $token = $this->uri->segment(2);
    $validotoken = $this->usuario_token($token);
    $data = [];

    if (((isset($logged_in) && empty($logged_in)) || !$logged_in) && !$validotoken) {
      echo json_encode(['status' => 'error', 'message' => 'No has iniciado sesion o token invalido']);
      return;
    }
    if (isset($logged_in) && $logged_in) {
      $data = [
        'logged_in' => $this->session->userdata('logged_in'),
        'puesto_sesion' => $this->session->userdata('puesto'),
        'usuario_login' => $this->session->userdata('usuario'),
        'token'  => $token
      ];
    }
    $this->session->set_userdata(['token_recuperacion' => $token]); // Lo guardo en la session para usar hasta que se complete

    $this->load->view('actualizarPassword', $data);
  }

  public function usuario_token($token)
  {
    $valido = $this->usuariosModel->getUsuario_token($token);
    if (isset($valido['token']) && !empty($valido['token'])) {
      return true;
    } else {
      return false;
    }
  }

  public function modificacion_contraseña()
  {
    $this->form_validation->set_rules('contraseña1', 'Contraseña', 'required|trim|min_length[8]', [
      'required' => 'El campo contraseña es requerido',
      'min_length' => 'La contraseña debe tener al menos 8 caracteres'
    ]);
    $this->form_validation->set_rules('contraseña2', 'Confirmar contraseña', 'required|trim|matches[contraseña1]', [
      'required' => 'El campo confirmar contraseña es requerido',
      'matches' => 'Las contraseñas no coinciden'
    ]);

    if ($this->form_validation->run() === false) {
      $response = [
        'status' => 'error',
        'message' => strip_tags(validation_errors())
      ];
      $this->output
        ->set_status_header(400)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }

    // Recuperar el token desde la sesión
    $token = $this->session->userdata('token_recuperacion');
    $valido = $this->usuariosModel->getUsuario_token($token);

    if (!isset($valido['token']) || empty($valido['token'])) {
      $response = ['status' => 'error', 'message' => 'Token inválido o no encontrado'];
      $this->output
        ->set_status_header(400)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }

    $contraseña1 = $this->input->post('contraseña1');
    $contraseña2 = $this->input->post('contraseña2');
    if ($contraseña1 !== $contraseña2) {
      $response = ['status' => 'error', 'message' => 'Las contraseñas no coinciden'];
      $this->output
        ->set_status_header(400)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }
    $contraseña1_hash = password_hash($contraseña1, PASSWORD_DEFAULT);

    try {

      // Cambiar la contraseña del usuario
      $consulta = $this->cambioContraseña_model->cambiar_contraseña($valido['id_Usuario_Empleado'], $contraseña1_hash);

      // Eliminar el token de recuperación
      $this->cambioContraseña_model->eliminarToken($token);


      if ($consulta > 0) {
        $response = ['status' => 'success', 'message' => 'Contraseña modificada con éxito'];
        $this->output
          ->set_status_header(200)
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
        $this->session->unset_userdata('token_recuperacion'); // Eliminar el token de la sesión
        return;
      }
    } catch (Exception $e) {

      log_message('error', 'Error al modificar la contraseña: ' . $e->getMessage());
      $response = ['status' => 'error', 'message' => 'Ocurrió un error al modificar la contraseña. Intente nuevamente más tarde.'
        . $e->getMessage()];
      $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }
  }
}
