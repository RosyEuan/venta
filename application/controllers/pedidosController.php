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

  private function validarFormularioCliente($data)
  {
    if (empty($data['registro_nombre']) || empty($data['registro_correo'])) {
      return 'El campo nombre y correo son requeridos';
    }
    return true;
  }

  private function validarFormularioMesa($data)
  {
    if (empty($data['registro_mesa'])) {
      return 'El campo mesa es requerido';
    }
    return true;
  }

  private function validarFormularioPedidos($data)
  {
    if (empty($data['registro_pedido']) || empty($data['registro_cantidad'])) {
      return 'El campo de platillo y cantidad son requeridos';
    }
    if (!is_numeric($data['registro_cantidad'])) {
      return 'La cantidad debe ser un número';
    }
    return true;
  }

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

  public function GenerarPedido()
  {
    // Leer los datos JSON recibidos en el body de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data)) {
      return $this->GetResponse_data(400, 'error', 'No se recibieron datos.');
    }

    // Validar los formularios
    $validationError = $this->validarFormularioCliente($data);
    if ($validationError !== true) {
      return $this->GetResponse_data(400, 'error', $validationError);
    }

    $validationError = $this->validarFormularioMesa($data);
    if ($validationError !== true) {
      return $this->GetResponse_data(400, 'error', $validationError);
    }

    // Validar que al menos un platillo esté incluido
    if (empty($data['items']) || !is_array($data['items'])) {
      return $this->GetResponse_data(400, 'error', 'Se deben incluir al menos un platillo en el pedido.');
    }

    // Registrar cliente
    $clienteResult = $this->pedidosModel->insertCliente($data['registro_nombre'], $data['registro_correo']);

    if ($clienteResult['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $clienteResult['message']);
    }

    $cliente = $this->pedidosModel->selectClienteId($clienteResult['id']);
    if (!$cliente) {
      return $this->GetResponse_data(500, 'error', 'Error al recuperar cliente registrado.');
    }

    // Registrar mesa
    $mesaResult = $this->pedidosModel->insertMesas($data['registro_mesa']);

    if ($mesaResult['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $mesaResult['message']);
    }

    $mesa = $this->pedidosModel->selectById('mesas', 'id_mesa', $mesaResult['id']);
    if (!$mesa) {
      return $this->GetResponse_data(500, 'error', 'Error al recuperar mesa registrada.');
    }

    // Registrar pedido
    $pedidoResult = $this->pedidosModel->insertPedidos($clienteResult['id'], 3, $mesaResult['id']);

    if ($pedidoResult['status'] === 'error') {
      return $this->GetResponse_data(500, 'error', $pedidoResult['message']);
    }

    $pedido = $this->pedidosModel->selectPedidos($pedidoResult['id']);
    if (!$pedido) {
      return $this->GetResponse_data(500, 'error', 'Error al recuperar pedido registrado.');
    }

    // Registrar detalles del pedido (múltiples platillos)
    $detalles = [];
    foreach ($data['items'] as $item) {
      // Verificar que cada item tenga un platillo y cantidad
      if (empty($item['food']) || empty($item['quantity']) || !is_numeric($item['quantity'])) {
        return $this->GetResponse_data(400, 'error', 'Cada platillo debe tener nombre y cantidad válida.');
      }

      // Buscar el platillo
      $platillo = $this->pedidosModel->selectPlatillo($item['food']);
      if (!$platillo) {
        return $this->GetResponse_data(500, 'error', 'Platillo no encontrado: ' . $item['food']);
      }

      // Calcular el precio total
      $precioTotal = $item['quantity'] * $platillo['precio'];

      // Insertar el detalle
      $detalleResult = $this->pedidosModel->insertDetalles(
        $pedidoResult['id'],
        $platillo['id_platillo'],
        $item['quantity'],
        $precioTotal
      );

      if ($detalleResult['status'] === 'error') {
        return $this->GetResponse_data(500, 'error', $detalleResult['message']);
      }

      // Almacenar el detalle insertado
      $detalles[] = $this->pedidosModel->selectDetalles($detalleResult['id']);
    }

    // Respuesta final con todos los detalles
    return $this->GetResponse_data(200, 'success', 'Pedido generado correctamente', [
      'cliente' => $cliente,
      'mesa' => $mesa,
      'pedido' => $pedido,
      'detalles' => $detalles
    ]);
  }
}
