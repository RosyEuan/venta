<?php
class pedidosModel extends CI_Model
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
  public function insertCliente($nombre_cliente, $correo)
  {
    try {
      $query = "INSERT INTO clientes(nombre_cliente,correo)
      VALUES(:nombre_cliente,:correo)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
      $pdo->bindParam(':correo', $correo, PDO::PARAM_STR);
      $pdo->execute();
      $resultado = $this->connect->lastInsertId();
      return $resultado;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta' . $e->getMessage()];
    }
  }
  public function selectClienteId($id_cliente)
  {
    try {
      $query = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
      $resultado = $pdo->fetch(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta' . $e->getMessage()];
    }
  }
  public function insertMesas($mesa)
  {
    try {
      $query = "INSERT INTO mesas(num_mesa,seccion_mesa,planta,capacidad,estado)
               VALUES(:num_mesa,:seccion_mesa,:planta,:capacidad,:estado)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':num_mesa', $mesa, PDO::PARAM_INT);
      $pdo->bindParam(':seccion_mesa', 'A', PDO::PARAM_STR);
      $pdo->bindParam(':planta', 'Baja', PDO::PARAM_STR);
      $pdo->bindParam(':capacidad', 5, PDO::PARAM_INT);
      $pdo->bindParam(':estado', 'Ocupado', PDO::PARAM_STR);
      $pdo->execute();
      $resultado = $this->connect->lastInsertId();
      return $resultado;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta' . $e->getMessage()];
    }
  }
  public function insertPedidos($id_cliente, $id_empleado, $id_mesa)
  {
    try {
      $query = "INSERT INTO pedidos(id_cliente,id_empleado,id_mesa,estado_pedido) 
            VALUES(:id_cliente,:id_empleado,:id_mesa,:estado_pedido)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
      $pdo->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
      $pdo->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);
      $pdo->bindParam(':estado_pedido', 'En espera', PDO::PARAM_STR);
      $pdo->execute();
      $resultado = $this->connect->lastInsertId();
      return $resultado;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta' . $e->getMessage()];
    }
  }
  public function selectPedidos($id_pedido)
  {
    try {
      $query = "SELECT * FROM pedidos where id_pedido = :id_pedido";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
      $resultado = $pdo->fetch(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta' . $e->getMessage()];
    }
  }
  public function insertDetalles($id_pedido, $id_platillo, $cantidad, $precio_total)
  {
    try {
      $query = "INSERT INTO detalles_pedidos(id_pedido,id_platillo,cantidad,precio_total)
              VALUES(:id_pedido,:id_platillo,:cantidad,:precio_total)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
      $pdo->bindParam(':id_platillo', $id_platillo, PDO::PARAM_INT);
      $pdo->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
      $pdo->bindParam(':precio_total', $precio_total, PDO::PARAM_STR);
      $resultado = $this->connect->lastInsertId();
      return $resultado;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta' . $e->getMessage()];
    }
  }
  public function selectDetalles($id_detalle)
  {
    try {
      $query = "SELECT * FROM detalles_pedidos WHERE id_detalle = :id_detalle";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':id_detalle', $id_detalle, PDO::PARAM_INT);
      $resultado = $pdo->fetch(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta' . $e->getMessage()];
    }
  }
}
