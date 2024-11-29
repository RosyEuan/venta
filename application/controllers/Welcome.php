<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
}

	public function index()
	{
	    /*sirve para cargar una vista*/
		$this->load->view('graficas');
	}
	public function graficas(){
		$this->load->view('graficas');
	}
	public function menu(){
		$this->load->view('menu');
	}
	public function barra_lateral(){
		$this->load->view('barra_lateral');
	}
	public function modal_producto(){
		$this->load->view('modal_producto');
	}
	public function modal_proveedores(){
		$this->load->view('modal_proveedores');
	}public function modal_utilidad(){
		$this->load->view('modal_utilidad');
	}
	public function formulario_reservaciones(){

		$this->load->view('formularioreservaciones');
	}
	public function reservaciones(){
		$this->load->view('Reservaciones');
	}
	public function login(){
		$this->load->view('login');
	}
}
