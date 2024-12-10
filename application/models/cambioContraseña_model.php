<?php

class cambioContraseña_model extends CI_Model
{
  private $connect;

  public function __construct()
  {
    parent::__construct();
    try {
      $this->connect = new PDO('mysql:host=localhost;dbname=pventa;charset=utf8mb4', 'root', '');
      $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      log_message('error', 'Error en la conexión a la base de datos: ' . $e->getMessage());
      throw new Exception('Hubo un error en la conexión con la base de datos.');
    }
    $this->load->model('usuariosModel');
  }

  public function cambiar_contraseña($id, $contraseña)
  {
    if (empty($id) || empty($contraseña)) {
      throw new Exception('Los datos enviados son inválidos.');
    }
    $sql = "UPDATE usuarios_empleados SET contraseña = :pass WHERE id_Usuario_Empleado = :id_usuario";
    $query = $this->connect->prepare($sql);
    $query->bindParam(':pass', $contraseña);
    $query->bindParam(':id_usuario', $id);
    $query->execute();
    return $query->rowCount();
  }
  public function eliminarToken($token)
  {
    $sql = "UPDATE usuarios_empleados SET token = :new_token, expiracion_token = :expiracion_token WHERE token = :old_token";
    $query = $this->connect->prepare($sql);
    $newToken = null;
    $newExpiracion = null;
    $query->bindParam(':new_token', $newToken, PDO::PARAM_NULL);
    $query->bindParam(':expiracion_token', $newExpiracion, PDO::PARAM_NULL);
    $query->bindParam(':old_token', $token);
    $query->execute();
    return $query->rowCount();
  }
}
