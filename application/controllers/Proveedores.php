<?php
class Proveedores extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo
        $this->load->model('ProveedoresM');
        $this->load->library('session');
    }

    public function obtenerProveedores()
    {
        try {
            // Llamar al modelo para obtener los proveedores
            $proveedores = $this->ProveedoresM->obtenerProveedores();

            // Verificar si se obtuvieron resultados
            if (!empty($proveedores)) {
                $response = [
                    'status' => 'success',
                    'message'=>'Se ejecuto la consulta',
                    'data' => $proveedores
                ];
                $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
                return;
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No se encontraron proveedores.'
                ];
            }

            // Devolver los resultados como JSON
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } catch (Exception $e) {
            // Manejar errores inesperados
            $response = [
                'status' => 'error',
                'message' => 'Hubo un problema al obtener los proveedores: ' . $e->getMessage()
            ];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function insertarProveedores()
    {

        // Obtener datos desde la solicitud POST
        $nombre = $this->input->post('nombre');
        $telefono = $this->input->post('telefono');
        $correo = $this->input->post('correo');

        // Validar los datos
        if (empty($nombre) || empty($telefono) || empty($correo)) {
            $response = [
                'status' => 'error',
                'message' => 'Todos los campos son obligatorios.'
            ];
            $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
            return;
        }
            // Llamar al modelo para insertar el proveedor
            $insert = $this->ProveedoresM->insertarProveedor($nombre, $telefono, $correo);

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

    public function actualizar()
    {
        try {
            // Obtener los datos enviados desde el frontend
            $id = $this->input->post('id');
            $nombre = $this->input->post('nombre');
            $telefono = $this->input->post('telefono');
            $correo = $this->input->post('correo');

            // Validar los datos
            if (empty($id) || empty($nombre) || empty($telefono) || empty($correo)) {
                $response = [
                    'status' => 'error',
                    'message' => 'Todos los campos son obligatorios.'
                ];
            } else {
                // Llamar al modelo para actualizar el proveedor
                $resultado = $this->ProveedoresM->actualizarProveedor($id, $nombre, $telefono, $correo);

                $response = $resultado;
            }

            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()
            ]);
        }
    }

    public function eliminar()
    {
        $id_proveedor = $this->input->post('id'); // Ajustado para coincidir con el frontend

        if (empty($id_proveedor) || !is_numeric($id_proveedor)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID de proveedor inválido.'
            ]);
            return;
        }

        $result = $this->ProveedoresM->eliminarProveedor($id_proveedor);

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