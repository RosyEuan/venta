
<?php

class Mailer extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('PhpMailerLib');
    $this->load->library('session');
    $this->load->model('usuariosModel');
    $this->load->helper('url');
  }
  public function SolicitudRecuperar()
  {
    $correo = $this->input->post('solicitud_recuperar');
    $response = $this->usuariosModel->getUsuario_correo($correo);

    if (isset($response['status']) && $response['status'] === 'false') {
      $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }
    //genero un token random
    $token = bin2hex(random_bytes(32));
    //$fecha = date('Y-m-d H:i:s', strtotime('+1 hour')); // expira en una hora desde que se genera
    $almacenado = $this->usuariosModel->GuardarToken($response['id_Usuario_Empleado'], $token);

    if ($almacenado < 0) {

      $response = ['status' => 'error', 'message' => 'Su token de validacion no se genero'];
      $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
      return;
    }
    $url = base_url('recuperar/' . $token);

    $enviar = $this->SendMail($correo, $url);

    if (isset($enviar['status']) && $enviar['status'] === 'error') {

      $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode($enviar));
      return;
    }
    //$enviar['token'] = $token;
    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json')
      ->set_output(json_encode($enviar));


    return;
  }

  public function SendMail($correo, $mensaje)
  {

    $mail = $this->phpmailerlib->getinstance();
    try {
      //Configuracion de phpmailer para enviar correos
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   =  true;
      $mail->Username   = 'tunjafet97@gmail.com';
      $mail->Password   = 'dqsd ayyj uljp rmcq'; // contraseña para aplicaciones de google (propia)
      $mail->SMTPSecure =  PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      // Configuración del correo
      $mail->setFrom('tunjafet97@gmail.com', 'Cytisum');
      $mail->addAddress($correo);
      $mail->Subject = 'Recuperación de contraseña'; // Por defeceto enviar que se trata de recuperación de contraseña
      $mail->isHTML(true); // Para agregar etiquetas html
      $mail->Body    = 'Este es el cuerpo del mensaje. 
            <a href="' . $mensaje . '">Este link es para recuperar tu contraseña</a>'; //asi se envia el link para recuperar contraseña
      // $mail->addAttachment('/ruta/al/archivo/adjunto'); //Para adjuntar archivos
      $enviado = $mail->send();

      if ($enviado) {
        $response = ['status' => 'success', 'message' => 'Correo enviado con exito, por favor revisa tu correo electronico'];

        return $response;
      } else {
        $response = ['status' => 'error', 'message' => 'Error al enviar correo'];
        return $response;
      }
    } catch (Exception $e) {
      //echo "Error al enviar el correo: {$mail->ErrorInfo}";
      return ['status' => 'error', 'message' => 'Hubo un error al enviar el correo:'
        . $e->getMessage() . ' mas detalles ' . $mail->ErrorInfo];
    }
  }
}

?>