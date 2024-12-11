<?php

class ReportesModel extends CI_Model
{
  private $connect;
  public function __construct()
  {
    try {
      $this->connect = new PDO('mysql:host=localhost;dbname=pventa;charset=utf8mb4', 'root', '');
      $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      log_message('error', 'Error en la conexión a la base de datos: ' . $e->getMessage());
      throw new Exception('Hubo un error en la conexión con la base de datos.');
    }
  }
  public function VentasDia()
  {
    $query = "SELECT id_pago,pagos.id_factura,fecha_pago,hora_pago, monto_pago,menu.id_menu,nombre_menu FROM pagos JOIN facturas ON pagos.id_factura = facturas.id_factura
      JOIN detalles_pedidos ON facturas.id_detalle = detalles_pedidos.id_detalle 
      JOIN platillos ON detalles_pedidos.id_platillo = platillos.id_platillo
      JOIN menu ON menu.id_menu = platillos.id_menu
      WHERE estado_pago = 'Completado' AND fecha_pago = CURDATE()";

    $stmt = $this->connect->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function VentasSemana()
  {
    $query = "SELECT id_pago,pagos.id_factura,fecha_pago,hora_pago, monto_pago,menu.id_menu,nombre_menu FROM pagos JOIN facturas ON pagos.id_factura = facturas.id_factura
      JOIN detalles_pedidos ON facturas.id_detalle = detalles_pedidos.id_detalle 
      JOIN platillos ON detalles_pedidos.id_platillo = platillos.id_platillo
      JOIN menu ON menu.id_menu = platillos.id_menu 
    WHERE estado_pago = 'Completado' AND DATE(fecha_pago) >= (CURDATE() - INTERVAL 7 DAY)";

    $stmt = $this->connect->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function VentasMes()
  {
    $query = "SELECT id_pago,pagos.id_factura,fecha_pago,hora_pago, monto_pago,menu.id_menu,nombre_menu FROM pagos JOIN facturas ON pagos.id_factura = facturas.id_factura
      JOIN detalles_pedidos ON facturas.id_detalle = detalles_pedidos.id_detalle 
      JOIN platillos ON detalles_pedidos.id_platillo = platillos.id_platillo
      JOIN menu ON menu.id_menu = platillos.id_menu 
      WHERE estado_pago = 'Completado' AND( YEAR(fecha_pago) = YEAR(CURDATE()) AND MONTH(fecha_pago) = MONTH(CURDATE()))";

    $stmt = $this->connect->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function VentasAnuales()
  {
    $query = "SELECT id_pago,pagos.id_factura,fecha_pago,hora_pago, monto_pago,menu.id_menu,nombre_menu FROM pagos JOIN facturas ON pagos.id_factura = facturas.id_factura
      JOIN detalles_pedidos ON facturas.id_detalle = detalles_pedidos.id_detalle 
      JOIN platillos ON detalles_pedidos.id_platillo = platillos.id_platillo
      JOIN menu ON menu.id_menu = platillos.id_menu 
        WHERE estado_pago = 'Completado' AND( YEAR(fecha_pago) = YEAR(CURDATE()) )";

    $stmt = $this->connect->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}
