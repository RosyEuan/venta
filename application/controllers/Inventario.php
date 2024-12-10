<?php
// controllers/Inventario.php
class Inventario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo
        $this->load->model('InventarioM');
        $this->load->library('session');
    }

    public function obtenerInventario()
    {
        // Obtener los productos desde el modelo
        $resultados = $this->InventarioM->obtenerInventario();

        // Verificar si hay resultados
        if (!empty($resultados)) {

            $response = ['status'=>'success','message'=>'Se ejecuto la consulta','data'=>$resultados];
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
            return;
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No se muestra el inventario'
              ];
              $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
              return;
        }
    }
        public function insertarinventario()
    {
        // Recibir y validar los datos
        //$id_producto = $this->input->post('id_producto');
        $id_proveedor = $this->input->post('id_proveedor');
        $nombre_producto = $this->input->post('nombre_producto');
        $stock = $this->input->post('stock');

        if (empty($id_proveedor) || empty($nombre_producto) || !is_numeric($stock)) {
            $response = [
                'status' => 'error',
                'message' => 'Datos inválidos o incompletos'
            ];
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        // Llamar al modelo
        $insert = $this->InventarioM->insertarInventario($id_proveedor, $nombre_producto, $stock);

        // Verificar la respuesta del modelo
        if ($insert['status'] === 'success') {
            $response = [
                'status' => 'success',
                'message' => $insert['message']
            ];
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $response = [
                'status' => 'error',
                'message' => $insert['message']
            ];
            $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

        public function obtenerProveedores()
    {
        $proveedores = $this->InventarioM->obtenerProveedores();

        if (!empty($proveedores)) {
            $response = [
                'status' => 'success',
                'data' => $proveedores
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No se encontraron proveedores'
            ];
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function actualizarInventario()
    {
        $id_producto =  $this->input->post('id_producto');
        $id_proveedor =  $this->input->post('id_proveedor');
        $nombre_producto = $this->input->post('nombre_producto');
        $stock = $this->input->post('stock');

        // Validar los datos
        if (empty($id_producto) || empty($id_proveedor) || empty($nombre_producto) || !is_numeric($stock)) {
            $response = [
                'status' => 'error',
                'message' => 'Datos inválidos o incompletos'
            ];
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        // Llamar al modelo
        $result = $this->InventarioM->actualizarInventario($id_producto, $id_proveedor, $nombre_producto, $stock);

        // Enviar respuesta
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    // controllers/Inventario.php
    public function eliminarProducto()
    {
        // Recibir el ID del producto desde la solicitud POST
        $id_producto = $this->input->post('id_producto');

        // Validar el dato recibido
        if (empty($id_producto) || !is_numeric($id_producto)) {
            $response = [
                'status' => 'error',
                'message' => 'ID del producto inválido'
            ];
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        // Llamar al modelo para eliminar el producto
        $result = $this->InventarioM->eliminarInventario($id_producto);

        // Retornar la respuesta según el resultado
        if ($result['status'] === 'success') {
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        } else {
            $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        }
    }




}

?>