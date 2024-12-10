<?php
class UtilidadM extends CI_Model{

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

    public function obtenerUtilidades()
    {
        $query = "
            SELECT 
                i.id_utilidad AS ID,
                i.nombre_utilidad AS Utilidad,
                i.descripcion AS Descripción,
                i.cantidad AS Cantidad,
                i.estado AS Estado,
                p.nombre_proveedor AS Proveedor,
                i.fecha_adquisicion AS FechaAdquisicion,
                i.precio_unitario AS PrecioUnitario
            FROM inventario_utilidades i
            INNER JOIN proveedores p ON i.id_proveedor = p.id_proveedor
        ";

        // Preparar y ejecutar la consulta
        $consulta = $this->connect->prepare($query);
        $consulta->execute();
        // Obtener los resultados
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }


    public function insertarUtilidad($nombre_utilidad, $descripcion, $cantidad, $estado, $id_proveedor, $fecha_adquisicion, $precio_unitario)
    {
        try {
            // Consulta SQL para insertar una nueva utilidad
            $query = "
                INSERT INTO inventario_utilidades (nombre_utilidad, descripcion, cantidad, estado, id_proveedor, fecha_adquisicion, precio_unitario)
                VALUES (:nombre_utilidad, :descripcion, :cantidad, :estado, :id_proveedor, :fecha_adquisicion, :precio_unitario)
            ";

            // Preparar la consulta
            $statement = $this->connect->prepare($query);

            // Bind de parámetros para evitar inyecciones SQL
            $statement->bindParam(':nombre_utilidad', $nombre_utilidad, PDO::PARAM_STR);
            $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $statement->bindParam(':estado', $estado, PDO::PARAM_STR);
            $statement->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
            $statement->bindParam(':fecha_adquisicion', $fecha_adquisicion, PDO::PARAM_STR);
            $statement->bindParam(':precio_unitario', $precio_unitario, PDO::PARAM_STR);

            // Ejecutar la consulta
            $result = $statement->execute();

            if ($result) {
                return [
                    'status' => 'success',
                    'message' => 'Utilidad insertada correctamente'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'No se pudo insertar la utilidad.'
                ];
            }

        } catch (PDOException $e) {
            log_message('error', 'Error al insertar en inventario_utilidades: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Error al insertar en inventario_utilidades: ' . $e->getMessage()
            ];
        }
    }

    public function actualizarUtilidad($id_utilidad, $nombre_utilidad, $descripcion, $cantidad, $estado, $id_proveedor, $fecha_adquisicion, $precio_unitario)
    {
        try {
            // Consulta para actualizar la utilidad
            $query = "UPDATE inventario_utilidades i
                    JOIN proveedores p ON i.id_proveedor = p.id_proveedor
                    SET 
                        i.nombre_utilidad = :nombre_utilidad,
                        i.descripcion = :descripcion,
                        i.cantidad = :cantidad,
                        i.estado = :estado,
                        i.fecha_adquisicion = :fecha_adquisicion,
                        i.precio_unitario = :precio_unitario,
                        i.id_proveedor = :id_proveedor
                    WHERE i.id_utilidad = :id_utilidad";
            
            $statement = $this->connect->prepare($query);

            // Asignar los parámetros
            $statement->bindParam(':id_utilidad', $id_utilidad, PDO::PARAM_INT);
            $statement->bindParam(':nombre_utilidad', $nombre_utilidad, PDO::PARAM_STR);
            $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $statement->bindParam(':estado', $estado, PDO::PARAM_STR);
            $statement->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
            $statement->bindParam(':fecha_adquisicion', $fecha_adquisicion, PDO::PARAM_STR);
            $statement->bindParam(':precio_unitario', $precio_unitario, PDO::PARAM_STR);

            // Ejecutar la consulta
            $statement->execute();
            $result = $statement->rowCount();

            // Verificar si se actualizó algo
            if ($result > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Utilidad actualizada correctamente'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'No se pudo actualizar la utilidad.'
                ];
            }

        } catch (PDOException $e) {
            log_message('error', 'Error al actualizar la utilidad: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Error al actualizar la utilidad: ' . $e->getMessage()
            ];
        }


    }


    // Método para eliminar una utilidad
    public function eliminarUtilidad($id_utilidad)
    {
        try {
            // Consulta SQL para eliminar la utilidad
            $sql = "DELETE FROM inventario_utilidades WHERE id_utilidad = :id_utilidad";
            $stmt = $this->connect->prepare($sql);

            // Bind del parámetro
            $stmt->bindParam(':id_utilidad', $id_utilidad, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return [
                    'status' => 'success',
                    'message' => 'Utilidad eliminada correctamente'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'No se pudo eliminar la utilidad'
                ];
            }
        } catch (PDOException $e) {
            // Manejo de errores
            return [
                'status' => 'error',
                'message' => 'Error al eliminar la utilidad: ' . $e->getMessage()
            ];
        }
    }
}

?>