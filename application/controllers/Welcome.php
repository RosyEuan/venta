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

	private function ValidacionAcceso($puestosPermitidos)
	{
		$logged_in = $this->session->userdata('logged_in');

		$puesto = $this->session->userdata('puesto');

		if ($logged_in == false) {
			echo json_encode(['status' => 'error', 'message' => 'No has iniciado sesion']);
			return false;
		}

		if (!in_array($puesto, $puestosPermitidos)) {
			echo json_encode(['status' => 'error', 'message' => 'No tienes acceso debido a tu puesto']);
			return false;
		}

		return true;
	}
	/*private function QuitarCache()
	{

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	}
*/
	public function index()
	{

		$logged_in = $this->session->userdata('logged_in');
		if (isset($logged_in) && $logged_in) {
			$logged_in = false;
		}
		$this->load->view('modal_login');
	}

	public function graficas2()
	{
		//$this->QuitarCache();

		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('graficas2', $data);
	}

	public function mesas()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Mesero', 'Recepcionista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('mesas', $data);
	}

	public function menu()
	{
		//$this->QuitarCache();

		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Mesero', 'Recepcionista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('menu', $data);
	}

	public function personal()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('personal', $data);
	}

	public function modal_producto()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Almacenista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('modal_producto', $data);
	}

	public function modal_proveedores()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Almacenista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('modal_proveedores', $data);
	}

	public function modal_utilidad()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Almacenista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('modal_utilidad', $data);
	}

	public function reservaciones()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Mesero', 'Recepcionista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('Reservaciones', $data);
	}

	/*public function modal_login()
	{
		$data = ['logged_in' => $logged_in, 'puesto_sesion' => $puesto, 'usuario_login' => $usuario];
		$this->load->view('modal_login', $data);
	}
*/
	public function pruebita()
	{
		//$data = ['logged_in' => $logged_in, 'puesto_sesion' => $puesto, 'usuario_login' => $usuario];
		$this->load->view('pruebita');
	}

	public function modal_pedidos()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Cajero'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('modal_pedidos', $data);
	}

	public function perfil()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Cajero', 'Mesero', 'Recepcionista', 'Almacenista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('perfil', $data);
	}

	public function user()
	{
		//$this->QuitarCache();
		if (!$this->ValidacionAcceso(['Administrador', 'Supervisor', 'Cajero', 'Mesero', 'Recepcionista', 'Almacenista'])) {
			return;
		}
		$data = [
			'logged_in' => $this->session->userdata('logged_in'),
			'puesto_sesion' => $this->session->userdata('puesto'),
			'usuario_login' => $this->session->userdata('usuario')
		];
		$this->load->view('user', $data);
	}
}
