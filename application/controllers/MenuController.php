<?php
require_once APPPATH . 'models/MenuModel.php'; // Carga el modelo basado en PDO

class MenuController extends CI_Controller
{
  private $menuModel;
  private $id_platillo;

  public function __construct()
  {
    parent::__construct();
    $this->menuModel = new MenuModel(); // Instancia el modelo basado en PDO
    $this->load->library('form_validation');
  }
  //-------------------------------------------------------------------------------------------------------------------

  public function GuardarPlatillo()
  {
    $this->validarFormularioPlatillo();

    if ($this->form_validation->run() === false) {
      return $this->GetResponse_data(400, 'error', strip_tags(validation_errors()));
    }
    // Subir imagen
    $imagen = $this->subirImagen($_FILES['imagen'], 'uploads/img/LogoCytisum.png');

    if (isset($imagen['error'])) {
      return $this->GetResponse_data(400, 'error', $imagen['error']);
    }

    $data = $this->obtenerDatosFormulario();
    $data['imagen_platillo'] = $imagen;

    $idMenu = $this->menuModel->obtenerIdMenu($data['categorias_platillo']);
    if (isset($idMenu['status']) && $idMenu['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $idMenu['message']);
    }

    $data['id_menu'] = $idMenu['id_menu'];

    // Guardar el platillo en la base de datos
    $this->id_platillo = $this->menuModel->guardarPlatillo($data);
    if (isset($data['status']) && $data['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $data['message']);
    }

    $data['id_platillo'] = $this->id_platillo;
    return $this->GetResponse_data(200, 'success', 'Platillo guardado correctamente.', $data);
  }

  //------------------------------------------------------------------------------------------

  public function ActualizarPlatillo()
  {
    $this->validarFormularioPlatillo();

    if ($this->form_validation->run() === false) {
      return $this->GetResponse_data(400, 'error', strip_tags(validation_errors()));
    }

    // Obtener datos del formulario
    $data = $this->obtenerDatosFormulario();
    $data = $this->obtenerDatosFormulario();
    //$data['imagen_platillo'] = $imagen;

    $idMenu = $this->menuModel->obtenerIdMenu($data['categorias_platillo']);
    if (isset($idMenu['status']) && $idMenu['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $idMenu['message']);
    }

    $data['id_menu'] = $idMenu['id_menu'];

    $data['id_platillo'] = $this->menuModel->ObtenerIdPlatillo($idMenu['id_menu'], $data['nombre_platillo']);

    // Subir nueva imagen si se proporciona
    if (!empty($_FILES['imagen']['name'])) {
      $imagen = $this->subirImagen($_FILES['imagen'], 'uploads/img/personal.png');
      if (isset($imagen['error'])) {
        return $this->GetResponse_data(400, 'error', $imagen['error']);
      }
      $data['imagen_platillo'] = $imagen;
    }

    // Actualizar el platillo en la base de datos
    $resultado = $this->menuModel->actualizarPlatillo($data);

    if (isset($resultado['status']) && $resultado['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $resultado['message'], []);
    }

    return $this->GetResponse_data(200, 'success', 'Platillo actualizado correctamente.', $data);
  }

  //-----------------------------------------------------------------------------------------------------------------

  public function obtenerMenu()
  {
    $menuItems = $this->menuModel->obtenerMenu();
    if (isset($menuItems['status']) && $menuItems['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $menuItems['message']);
    }

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json')
      ->set_output(json_encode($menuItems));
  }

  //-------------------------------------------------------------------------------------------------------------------------------------------------

  private function validarFormularioPlatillo()
  {
    $this->form_validation->set_rules('nombre_platillo', 'Nombre', 'required|trim', ['required' => 'El campo nombre es requerido']);
    $this->form_validation->set_rules('categorias_platillo', 'Categorías', 'required|trim', ['required' => 'El campo categorías es requerido']);
    $this->form_validation->set_rules('precio_platillo', 'Precio', 'required|trim|numeric', ['required' => 'El campo precio es requerido']);
    $this->form_validation->set_rules('descuento_platillo', 'Descuento', 'trim|numeric');
    $this->form_validation->set_rules('descripcion_platillo', 'Descripción', 'required|trim', ['required' => 'El campo descripción es requerido']);
  }

  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

  private function subirImagen($archivo, $imagenPorDefecto)
  {
    if (empty($archivo['name'])) {
      return base_url($imagenPorDefecto);
    }

    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 2048;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('imagen')) {
      return ['error' => $this->upload->display_errors()];
    }

    $uploadedData = $this->upload->data();
    return base_url('uploads/' . $uploadedData['file_name']);
  }

  //-----------------------------------------------------------------------------------------------------------------------------------------------------------

  private function obtenerDatosFormulario()
  {
    return [
      'nombre_platillo' => $this->input->post('nombre_platillo'),
      'categorias_platillo' => $this->input->post('categorias_platillo'),
      'precio' => $this->input->post('precio_platillo'),
      'descuento' => $this->input->post('descuento_platillo'),
      'descripcion' => $this->input->post('descripcion_platillo')
    ];
  }

  //----------------------------------------------------------------------------------------------------------------------------------

  private function GetResponse_data($status, $status_tipo, $message, $data = [])
  {
    $response = [
      'code' => $status,
      'status' => $status_tipo,
      'message' => $message,
      'data' => $data
    ];
    $this->output
      ->set_status_header($status)
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }
}
