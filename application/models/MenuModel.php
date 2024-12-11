<?php
class MenuModel
{
  private $pdo;

  public function __construct()
  {
    try {
      // Conexión a la base de datos usando PDO
      $this->pdo = new PDO('mysql:host=localhost;dbname=pventa', 'root', '');
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Error al conectar a la base de datos: ' . $e->getMessage());
    }
  }


  public function guardarPlatillo($data)
  {
    try {
      $sql = "INSERT INTO platillos (id_menu, nombre_platillo, imagen_platillo, descripcion, precio, descuento) 
              VALUES (:id_menu, :nombre_platillo, :imagen_platillo, :descripcion, :precio, :descuento)";
      $stmt = $this->pdo->prepare($sql);

      $stmt->execute([
        ':id_menu' => $data['id_menu'],
        ':nombre_platillo' => $data['nombre_platillo'],
        ':imagen_platillo' => $data['imagen_platillo'],
        ':descripcion' => $data['descripcion'],
        ':precio' => $data['precio'],
        ':descuento' => $data['descuento']
      ]);

      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Error al insertar el platillo: ' . $e->getMessage()];
    }
  }

  public function actualizarPlatillo($data)
  {
    try {
      $sql = "UPDATE platillos 
              SET nombre_platillo = :nombre_platillo, 
                  id_menu = :id_menu, 
                  descripcion = :descripcion, 
                  precio = :precio, 
                  descuento = :descuento 
              WHERE id_platillo = :id_platillo";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':nombre_platillo', $data['nombre_platillo'], PDO::PARAM_STR);
      $stmt->bindParam(':id_menu', $data['id_menu'], PDO::PARAM_INT);
      $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
      $stmt->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
      $stmt->bindParam(':descuento', $data['descuento'], PDO::PARAM_STR);
      $stmt->bindParam(':id_platillo', $data['id_platillo'], PDO::PARAM_INT);

      $stmt->execute();

      return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Error al actualizar el platillo: ' . $e->getMessage()];
    }
  }
  public function obtenerMenu()
  {
    try {
      $sql = "SELECT 
                p.id_platillo, 
                p.nombre_platillo, 
                p.descripcion, 
                p.precio, 
                p.descuento, 
                p.imagen_platillo, 
                m.nombre_menu 
              FROM platillos p
              JOIN menu m ON p.id_menu = m.id_menu";
      $stmt = $this->pdo->query($sql);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Error al obtener el menú: ' . $e->getMessage()];
    }
  }
  public function obtenerIdMenu($nombre_menu)
  {
    try {
      $sql = "SELECT id_menu FROM menu WHERE nombre_menu = :nombre_menu";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([':nombre_menu' => $nombre_menu]);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Error al obtener el ID del menú: ' . $e->getMessage()];
    }
  }
  public function ObtenerIdPlatillo($id_menu, $nombre_platillo)
  {
    try {

      $sql = "SELECT id_platillo FROM platillos WHERE id_menu = :id_menu AND nombre_platillo = :nombre_platillo";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':id_menu', $id_menu, PDO::PARAM_INT);
      $stmt->bindParam(':nombre_platillo', $nombre_platillo, PDO::PARAM_STR);

      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resultado['id_platillo'];
    } catch (PDOException $e) {
      return ['status' => 'error', 'message' => 'Error al obtener el ID del menú: ' . $e->getMessage()];
    }
  }
}
