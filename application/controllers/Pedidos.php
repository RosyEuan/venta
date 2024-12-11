<?php
class Pedidos extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo
        $this->load->model('PedidosM');
        $this->load->library('session');
    }

    public function obtenerPlatillos()
    {
        $platillos = $this->PedidosM->obtenerPlatillos();

        if (!empty($platillos)) {
            $response = [
                'status' => 'success',
                'data' => $platillos
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No se encontraron platillos'
            ];
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
?>