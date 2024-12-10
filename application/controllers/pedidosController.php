<?php
class pedidosController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('pedidosModel');
  }
  private function registrarCliente()
  {
    $this->validarFormularioCliente();
    if ($this->form_validation->run() === FALSE) {
      return $this->GetResponse_data(400, 'error', strip_tags(validation_errors()));
    }
    $data = $this->obtenerDatosFormularioCliente();
    $id_cliente = $this->pedidosModel->insertCliente($data['registro_nombre'], $data['registro_correo']);

    if (isset($id_cliente['status']) && $id_cliente['status'] == 'error') {
      return $this->GetResponse_data(500, 'error', 'El id del cliente no se encontro');
    }
    $cliente = $this->pedidosModel->selectClienteId($id_cliente);

    if (isset($cliente['status']) && $cliente['status'] == 'error') {
      return $this->GetResponse_data(500, 'error', 'El cliente no se guardo correctamente');
    }

    return $this->GetResponse_data(200, 'success', 'El cliente fue insertado correctamente', $cliente);
  }
  //----------------------------------------------------------------------------------------------------------------
  private function registrarMesa()
  {
    $this->validarFormularioMesa();
    if ($this->form_validation->run() === FALSE) {
      return $this->GetResponse_data(400, 'error', strip_tags(validation_errors()));
    }

    $data = $this->obtenerDatosFormularioMesa();
    $id_mesa = $this->pedidosModel->insertMesa($data['id_mesa']);

    if (isset($id_mesa['status']) && $id_mesa['status'] == 'error') {
      return $this->GetResponse_data(500, 'error', 'El id de la mesa no se encontro');
    }
    $mesa = $this->pedidosModel->selectMesaId($id_mesa);

    if (isset($mesa['status']) && $mesa['status'] == 'error') {
      return $this->GetResponse_data(500, 'error', 'La mesa no se guardo correctamente');
    }

    return $this->GetResponse_data(200, 'success', 'El cliente fue insertado correctamente', $mesa);
  }
  //-------------------------------------------------------------------------------------------------------------------------
  private function registrarPedido($id_cliente, $id_empleado, $id_mesa)
  {
    $this->validarFormularioPedidos();
    if ($this->form_validation->run() === FALSE) {
      return $this->GetResponse_data(400, 'error', strip_tags(validation_errors()));
    }

    $data_pedido = $this->obtenerDatosFormularioPedidos();
    $id_pedido = $this->pedidosModel->insertPedido($id_cliente, $id_empleado, $id_mesa);

    if (isset($data_pedido['status']) && $data_pedido['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', strip_tags(validation_errors()));
    }
    $pedido = $this->pedidosModel->selectIdPedido($id_pedido);
  }


  //----------------------------------------------------------------------------------------------------------------------------
  private function validarFormularioCliente()
  {
    $this->form_validation->set_rules('registro_nombre', 'Nombre', 'required|trim', ['required' => 'El campo nombre es requerido']);
    $this->form_validation->set_rules('registro_correo', 'Correo', 'required|trim', ['required' => 'El campo correo es requerido']);
  }
  //----------------------------------------------------------------------------------------------------------------------------------
  private function validarFormularioMesa()
  {
    $this->form_validation->set_rules('registro_mesa', 'Mesa', 'required|trim', ['required' => 'El campo mesa es requerido']);
  }
  //--------------------------------------------------------------------------------------------------------------------------------
  private function validarFormularioPedidos()
  {
    $this->form_validation->set_rules('registro_pedido', 'Platillo', 'required|trim', ['required' => 'El campo de platillo es requerido']);
    $this->form_validation->set_rules('descripcion_cantidad', 'Cantidad', 'required|trim|numeric', ['required' => 'El cantidad descripción es requerido']);
  }
  //-----------------------------------------------------------------------------------------------------------------------------
  private function obtenerDatosFormularioCliente()
  {
    return [
      'registro_nombre' => $this->input->post('registro_nombre'),
      'registro_correo' => $this->input->post('registro_correo')
    ];
  }
  //--------------------------------------------------------------------------------------------------------------
  private function obtenerDatosFormularioMesa()
  {
    return ['registro_mesa' => $this->input->post('registro_mesa')];
  }
  //---------------------------------------------------------------------------------------------------------------
  private function obtenerDatosFormularioPedidos()
  {
    return [
      'registro_pedido' => $this->input->post('registro_pedido'),
      'descripcion_cantidad' => $this->input->post('descripcion_cantidad')
    ];
  }
  //------------------------------------------------------------------------------------------------------------
  private function GeneraPedido() {}
  //-----------------------------------------------------------------------------------------------------------
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
