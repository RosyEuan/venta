<?php
class MEditar_Perfil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Datos_Perfil');  // Cargamos el modelo para obtener los datos del perfil
        //$this->load->library('form_validation');
        $this->load->library('session');
    }

    public function obtenerPerfil()
    {
        if (!$this->session->userdata('logged_in')) {
            $response = ['status' => 'error', 'message' => 'Debe iniciar sesión para acceder al perfil'];
            $this->output
            ->set_status_header(400) // Tipo de error, 400 es un error de cliente
            ->set_content_type('application/json') // El tipo de dato que retorna hacia el ajax
            ->set_output(json_encode($response)); // Para enviar directo al navegador
            return;
        }

        $id_usuario = $this->session->userdata('id_usuario');

        // Depuración del ID de usuario
        log_message('info', 'ID de usuario en sesión: ' . $id_usuario); // Esto solo si tienes logs activados en codeigniter

        if (!$id_usuario) {
            
            $response = ['status' => 'error', 'message' => 'ID de usuario no encontrado en la sesión'];
            $this->output
            ->set_status_header(400) // Tipo de error, 400 es un error de cliente
            ->set_content_type('application/json') // El tipo de dato que retorna hacia el ajax
            ->set_output(json_encode($response)); // Para enviar directo al navegador
            return;
           
        }

        $datosUsuario = $this->Datos_Perfil->obtenerDatosPerfil($id_usuario);

        // Depuración de los datos obtenidos
        if (empty($datosUsuario['error'])) {
            log_message('info', 'Datos del perfil obtenidos: ' . print_r($datosUsuario, true));
            $response = ['status' => 'success', 'data' => $datosUsuario];
            $this->output
            ->set_status_header(200) // El 200 es un ok, verifica que sea un success
            ->set_content_type('application/json') // El tipo de dato que retorna hacia el ajax
            ->set_output(json_encode($response)); // Para enviar directo al navegador
            return;
        } else {
            log_message('error', 'No se encontraron datos para el ID de usuario: ' . $id_usuario);
            $response = ['status' => 'error', 'message' => 'No se encontraron datos del usuario'];
            $this->output
            ->set_status_header(500) // Tipo de error, 400 es un error de cliente
            ->set_content_type('application/json') // El tipo de dato que retorna hacia el ajax
            ->set_output(json_encode($response)); // Para enviar directo al navegador
            return;
        }
    }


    public function actualizarPerfil()
    {
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
            return;
        }
    
        $id_usuario = $this->session->userdata('id_usuario');
        // Recibir datos del formulario (post)
        $datos = [
            'domicilio' => $this->input->post('domicilio'),
            'nombre_usuario' => $this->input->post('usuario'),
            'email' => $this->input->post('correo'),
            'telefono' => $this->input->post('telefono')
        ];
    
        // Llamar al modelo para actualizar
        $resultado = $this->Datos_Perfil->actualizarDatosPerfil($id_usuario,$datos);
    
        // Enviar respuesta en formato JSON
        echo json_encode($resultado);
    }
    
}
?>