<?php

class usuariosModel extends CI_Model
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
  }

  public function getUsuario_correo($correo)
  {
    try {
      $query = $this->connect->prepare("SELECT * FROM usuarios_empleados us JOIN empleados e
    WHERE us.id_empleado = e.id_empleado AND e.email = :email");
      $query->bindParam(':email', $correo, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);

      if ($query->execute()) {

        return $result;
      } else {
        return ['status' => 'error', 'message' => 'Hubo un error'];
      }
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error ' . $e->getMessage()];
    }
  }
  public function GuardarToken($id, $token)
  {
    $query = "UPDATE usuarios_empleados SET token = :token, expiracion_token = Date_ADD(NOW(), INTERVAL 1 HOUR)
     WHERE id_Usuario_Empleado = :id";
    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->rowCount();
  }

  public function getUsuario_token($token)
  {
    $query = "SELECT * FROM usuarios_empleados WHERE token = :token AND expiracion_token > NOW()";
    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
}
