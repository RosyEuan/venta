<?php
class Utilidad extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo
        $this->load->model('UtilidadM');
        $this->load->library('session');
    }


    // Método para mostrar las utilidades
    public function obtenerUtilidades() {
        // Obtener las utilidades del modelo
        $resultados = $this->UtilidadesM->obtenerUtilidades();

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


    public function insertarUtilidad()
    {
        // Recibir y validar los datos del formulario
        $nombre_utilidad = $this->input->post('nombre_utilidad');
        $descripcion = $this->input->post('descripcion');
        $cantidad = $this->input->post('cantidad');
        $estado = $this->input->post('estado');
        $id_proveedor = $this->input->post('id_proveedor');
        $fecha_adquisicion = $this->input->post('fecha_adquisicion');
        $precio_unitario = $this->input->post('precio_unitario');

        // Validación de datos
        if (empty($nombre_utilidad) || empty($descripcion) || empty($cantidad) || empty($estado) || empty($id_proveedor) || empty($fecha_adquisicion) || empty($precio_unitario)) {
            $response = [
                'status' => 'error',
                'message' => 'Datos inválidos o incompletos'
            ];
            $this->output
                ->set_status_header(400) // Bad Request
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        // Llamar al modelo para insertar la utilidad
        $insert = $this->UtilidadesM->insertarUtilidad(
            $nombre_utilidad, 
            $descripcion, 
            $cantidad, 
            $estado, 
            $id_proveedor, 
            $fecha_adquisicion, 
            $precio_unitario
        );

        // Verificar la respuesta del modelo
        if ($insert['status'] === 'success') {
            $response = [
                'status' => 'success',
                'message' => $insert['message']
            ];
            $this->output
                ->set_status_header(200) // OK
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $response = [
                'status' => 'error',
                'message' => $insert['message']
            ];
            $this->output
                ->set_status_header(500) // Internal Server Error
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
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

    public function actualizarUtilidad()
    {
        // Recibir los datos del formulario
        $id_utilidad = $this->input->post('id_utilidad');
        $nombre_utilidad = $this->input->post('nombre_utilidad');
        $descripcion = $this->input->post('descripcion');
        $cantidad = $this->input->post('cantidad');
        $estado = $this->input->post('estado');
        $id_proveedor = $this->input->post('id_proveedor');
        $fecha_adquisicion = $this->input->post('fecha_adquisicion');
        $precio_unitario = $this->input->post('precio_unitario');

        // Validar los datos
        if (empty($id_utilidad) || empty($nombre_utilidad) || empty($descripcion) || empty($cantidad) || empty($estado) || empty($id_proveedor) || empty($fecha_adquisicion) || empty($precio_unitario)) {
            $response = [
                'status' => 'error',
                'message' => 'Datos inválidos o incompletos'
            ];
            $this->output
                ->set_status_header(400) // Bad Request
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        // Llamar al modelo para actualizar la utilidad
        $result = $this->UtilidadesM->actualizarUtilidad(
            $id_utilidad,
            $nombre_utilidad,
            $descripcion,
            $cantidad,
            $estado,
            $id_proveedor,
            $fecha_adquisicion,
            $precio_unitario
        );

        // Enviar respuesta
        $this->output
            ->set_status_header(200) // OK
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }


    // Método para eliminar una utilidad
    public function eliminarUtilidad()
    {
        // Recibir el ID de la utilidad desde la solicitud POST
        $id_utilidad = $this->input->post('id_utilidad');

        // Validar el dato recibido
        if (empty($id_utilidad) || !is_numeric($id_utilidad)) {
            $response = [
                'status' => 'error',
                'message' => 'ID de utilidad inválido'
            ];
            $this->output
                ->set_status_header(400) // Bad Request
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        // Llamar al modelo para eliminar la utilidad
        $result = $this->UtilidadesM->eliminarUtilidad($id_utilidad);

        // Retornar la respuesta según el resultado
        if ($result['status'] === 'success') {
            $this->output
                ->set_status_header(200) // OK
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        } else {
            $this->output
                ->set_status_header(500) // Internal Server Error
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        }
    }

}

?>