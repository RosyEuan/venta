<?php
class dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Login');
    $this->load->library('session');
  }

  public function dashboard()
  {
    $rolBase = $this->Login->getPuestos();
    $puesto = $this->session->userdata('id_puesto');

    switch ($puesto) {
      case $rolBase[0]['id_puesto']:
      case $rolBase[1]['id_puesto']:

        $this->load->view('graficas2');
        break;
      case $rolBase[2]['id_puesto']:

        $this->load->view('modal_producto');
        break;
      case $rolBase[3]['id_puesto']:

        $this->load->view('modal_pedidos');
        break;
      case $rolBase[4]['id_puesto']:

        $this->load->view('Reservaciones');
        break;
      case $rolBase[5]['id_puesto']:

        $this->load->view('menu');
        break;
      default:

        redirect('/');
        break;
    }
  }
}
