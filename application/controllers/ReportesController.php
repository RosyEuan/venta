<?php

class ReportesController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ReportesModel');
  }
  public function Get_ventasDiarias()
  {
    $data = $this->ReportesModel->VentasDia();
    echo json_encode($data);
  }

  public function Get_ventasSemanales()
  {
    $data = $this->ReportesModel->VentasSemana();
    echo json_encode($data);
  }

  public function Get_ventasMensuales()
  {
    $data = $this->ReportesModel->VentasMes();
    echo json_encode($data);
  }

  public function Get_ventasAnuales()
  {
    $data = $this->ReportesModel->VentasAnuales();
    echo json_encode($data);
  }
}
