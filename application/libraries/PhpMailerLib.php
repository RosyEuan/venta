<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PhpMailerLib
{

  public function __construct()
  {

    require_once(APPPATH . '../vendor/autoload.php');
  }
  public function getinstance()
  {
    return new PHPMAILER(true);
  }
}
