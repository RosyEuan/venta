<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{

		$this->load->view('modal_login');
	}
	public function graficas2()
	{

		$this->load->view('graficas2');
	}
	public function mesas()
	{
		$this->load->view('mesas');
	}
	public function menu()
	{
		$this->load->view('menu');
	}
	public function personal()
	{
		$this->load->view('personal');
	}
	public function barra_lateral()
	{
		$this->load->view('barra_lateral');
	}
	public function modal_producto()
	{
		$this->load->view('modal_producto');
	}
	public function modal_proveedores()
	{
		$logged_in = $this->session->userdata('logged_in');
		$puesto = $this->session->userdata('puesto');
		if (($puesto != 'Proveedor' || $puesto != 'Administrador' || $puesto != 'Supervisor') && $logged_in == false) {
			echo json_encode(['status' => 'error', 'message' => 'No tienes acceso a esta vista']);
			return;
		}
		$this->load->view('modal_proveedores2', ['logged_in' => $logged_in, 'puesto_sesion' => $puesto]);
	}

	public function modal_utilidad()
	{
		$this->load->view('modal_utilidad');
	}
	public function formulario_reservaciones()
	{

		$this->load->view('formularioreservaciones');
	}
	public function reservaciones()
	{
		$this->load->view('Reservaciones');
	}
	public function modal_login()
	{
		$this->load->view('modal_login');
	}
	public function barra()
	{
		$this->load->view('barra');
	}
	public function pruebita()
	{
		$this->load->view('pruebita');
	}
	public function modal_pedidos()
	{
		$this->load->view('modal_pedidos');
	}
	public function perfil()
	{
		$this->load->view('perfil');
	}
	public function user()
	{
		$this->load->view('user');
	}
	public function actualizarPassword()
	{
		$this->load->view('actualizarPassword');
	}
}
