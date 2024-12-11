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

  public function closeConnection()
  {
    $this->connect = null;
  }

  public function selectById($table, $column, $value)
  {
    try {
      $query = "SELECT * FROM {$table} WHERE {$column} = :value";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':value', $value, PDO::PARAM_INT);
      $pdo->execute();
      return $pdo->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Error en consulta: ' . $e->getMessage()];
    }
  }

  public function insertCliente($nombre_cliente, $correo)
  {
    try {
      $query = "INSERT INTO clientes(nombre_cliente, correo) VALUES(:nombre_cliente, :correo)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
      $pdo->bindParam(':correo', $correo, PDO::PARAM_STR);
      $pdo->execute();
      return ['status' => 'success', 'id' => $this->connect->lastInsertId()];
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta: ' . $e->getMessage()];
    }
  }

  public function selectClienteId($id_cliente)
  {
    return $this->selectById('clientes', 'id_cliente', $id_cliente);
  }

  public function insertMesas($num_mesa, $seccion_mesa = 'A', $planta = 'Baja', $capacidad = 5, $estado = 'Ocupado')
  {
    try {
      $query = "INSERT INTO mesas(num_mesa, seccion_mesa, planta, capacidad, estado)
                      VALUES(:num_mesa, :seccion_mesa, :planta, :capacidad, :estado)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':num_mesa', $num_mesa, PDO::PARAM_INT);
      $pdo->bindParam(':seccion_mesa', $seccion_mesa, PDO::PARAM_STR);
      $pdo->bindParam(':planta', $planta, PDO::PARAM_STR);
      $pdo->bindParam(':capacidad', $capacidad, PDO::PARAM_INT);
      $pdo->bindParam(':estado', $estado, PDO::PARAM_STR);
      $pdo->execute();
      return ['status' => 'success', 'id' => $this->connect->lastInsertId()];
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta: ' . $e->getMessage()];
    }
  }

  public function insertPedidos($id_cliente, $id_empleado, $id_mesa, $estado_pedido = 'En espera')
  {
    try {
      $query = "INSERT INTO pedidos(id_cliente, id_empleado, id_mesa, estado_pedido)
                      VALUES(:id_cliente, :id_empleado, :id_mesa, :estado_pedido)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
      $pdo->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
      $pdo->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);
      $pdo->bindParam(':estado_pedido', $estado_pedido, PDO::PARAM_STR);
      $pdo->execute();
      return ['status' => 'success', 'id' => $this->connect->lastInsertId()];
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta: ' . $e->getMessage()];
    }
  }

  public function selectPedidos($id_pedido)
  {
    return $this->selectById('pedidos', 'id_pedido', $id_pedido);
  }

  public function insertDetalles($id_pedido, $id_platillo, $cantidad, $precio_total)
  {
    try {
      $query = "INSERT INTO detalles_pedidos(id_pedido, id_platillo, cantidad, precio_total)
                      VALUES(:id_pedido, :id_platillo, :cantidad, :precio_total)";
      $pdo = $this->connect->prepare($query);
      $pdo->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
      $pdo->bindParam(':id_platillo', $id_platillo, PDO::PARAM_INT);
      $pdo->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
      $pdo->bindParam(':precio_total', $precio_total, PDO::PARAM_STR);
      $pdo->execute();
      return ['status' => 'success', 'id' => $this->connect->lastInsertId()];
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Hubo un error en consulta: ' . $e->getMessage()];
    }
  }

  public function selectDetalles($id_detalle)
  {
    return $this->selectById('detalles_pedidos', 'id_detalle', $id_detalle);
  }

  public function selectPlatillo($id_platillo)
  {
    return $this->selectById('platillos', 'id_platillo', $id_platillo);
  }
}
