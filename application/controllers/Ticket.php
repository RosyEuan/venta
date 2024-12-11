<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        // $this->load->library('TicketLib');
    }

    public function generate_ticket() {
         // Carga la clase TicketLib
         $this->load->library('TicketLib');
        $ticket = new TicketLib();
        $ticket->Ticket(); // Genera el PDF
    }
}