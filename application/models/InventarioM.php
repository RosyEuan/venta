<?php
class InventarioM extends CI_Model{
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

        // Controlador en CodeIgniter
        public function obtenerInventario()
        {
            // Preparar y ejecutar la consulta
            
            $query ="
                SELECT 
                    i.id_producto AS ID, 
                    i.nombre_producto AS Producto, 
                    i.id_proveedor AS ProveedorID,
                    p.nombre_proveedor AS Proveedores, 
                    i.stock AS Cantidad
                FROM inventario i 
                INNER JOIN proveedores p ON p.id_proveedor = i.id_proveedor
            ";
    
            $consulta = $this->connect->prepare($query);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function insertarInventario($id_proveedor, $nombre_producto, $stock)
        {
            try {
                $query = "INSERT INTO inventario (id_proveedor, nombre_producto, stock) 
                        VALUES (:id_proveedor, :nombre_producto, :stock)";
                
                $statement = $this->connect->prepare($query);
                
                // Bind de parámetros para evitar inyecciones SQL
                //$statement->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $statement->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
                $statement->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
                $statement->bindParam(':stock', $stock, PDO::PARAM_INT);

                // Ejecutar la consulta
                
                $result = $statement->execute();

                if ($result) {
                    return [
                        'status' => 'success',
                        'message' => 'Producto insertado correctamente'
                    ];
                } else {
                    return ['status' => 'error', 'message' => 'No se pudo insertar el producto.'];
                }

            } catch (PDOException $e) {
                log_message('error', 'Error al insertar en inventario: ' . $e->getMessage());
                return [
                    'status' => 'error',
                    'message' => 'Error al insertar en inventario: ' . $e->getMessage()
                ];
            }
        }

                public function obtenerProveedores()
        {
            try {
                $query = "SELECT id_proveedor, nombre_proveedor FROM proveedores";
                $statement = $this->connect->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como un arreglo asociativo
            } catch (PDOException $e) {
                log_message('error', 'Error al obtener proveedores: ' . $e->getMessage());
                return [
                    'status' => 'error',
                    'message' => 'Error al obtener el proveedor: ' . $e->getMessage()
                ];
            }
        }

        public function actualizarInventario($id_producto, $id_proveedor, $nombre_producto, $stock)
        {
            try {
                // Consulta para actualizar el inventario
                $query = "UPDATE inventario 
                        SET 
                            nombre_producto = :nombre_producto,
                            stock = :stock,
                            id_proveedor = :id_proveedor
                        WHERE 
                            id_producto = :id_producto";

                $statement = $this->connect->prepare($query);

                // Asignar valores a los parámetros
                $statement->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $statement->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
                $statement->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
                $statement->bindParam(':stock', $stock, PDO::PARAM_INT);

                // Ejecutar la consulta
                $statement->execute();
                $result = $statement->rowCount();

                if ($result>0) {
                    return [
                        'status' => 'success',
                        'message' => 'Producto actualizado correctamente'
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'No se pudo actualizar el producto.'
                    ];
                }
            } catch (PDOException $e) {
                log_message('error', 'Error al actualizar el inventario: ' . $e->getMessage());
                return [
                    'status' => 'error',
                    'message' => 'Error al actualizar el inventario: ' . $e->getMessage()
                ];
            }
        }

        public function eliminarInventario($id_producto)
        {
            try {
                // Preparar la consulta SQL
                $sql = "DELETE FROM inventario WHERE id_producto = :id_producto";
                $stmt = $this->connect->prepare($sql);
    
                // Bind del parámetro
                $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    
                // Ejecutar la consulta
                if ($stmt->execute()) {
                    return [
                        'status' => 'success',
                        'message' => 'Producto eliminado correctamente'
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'No se pudo eliminar el producto'
                    ];
                }
            } catch (PDOException $e) {
                // Manejo de errores
                return [
                    'status' => 'error',
                    'message' => 'Error al eliminar el producto: ' . $e->getMessage()
                ];
            }
        }




}
?>