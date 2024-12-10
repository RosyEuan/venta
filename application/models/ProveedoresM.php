<?php
class ProveedoresM extends CI_Model{
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

    public function obtenerProveedores()
    {
        try {
            $query = "SELECT id_proveedor AS ID,
            nombre_proveedor AS Nombre,
            telefono AS Telefono,
            correo AS Correo
            FROM proveedores";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un arreglo asociativo con los resultados
        } catch (PDOException $e) {
            log_message('error', 'Error al obtener proveedores: ' . $e->getMessage());
            return []; // Devuelve un arreglo vacío en caso de error
        }
    }
    public function insertarProveedor($nombre, $telefono, $correo)
    {
        try {
            $query = "INSERT INTO proveedores (nombre_proveedor, telefono, correo) VALUES (:nombre, :telefono, :correo)";
            $stmt = $this->connect->prepare($query);

            // Vincular parámetros para evitar inyecciones SQL
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Proveedor insertado correctamente'
            ];
        } catch (PDOException $e) {
            log_message('error', 'Error al insertar proveedor: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Hubo un problema al insertar el proveedor: ' . $e->getMessage()
            ];
        }
    }

    public function actualizarProveedor($id, $nombre, $telefono, $correo)
    {
        try {
            $sql = "UPDATE proveedores 
                    SET nombre_proveedor = :nombre, 
                        telefono = :telefono, 
                        correo = :correo 
                    WHERE id_proveedor = :id";
            
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return ['status' => 'success', 'message' => 'Proveedor actualizado correctamente.'];
            } else {
                return ['status' => 'error', 'message' => 'No se pudo actualizar el proveedor.'];
            }
        } catch (PDOException $e) {
            log_message('error', 'Error al actualizar proveedor: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()];
        }
    }

    public function eliminarProveedor($id_proveedor)
    {
        try {
            $sql = "DELETE FROM proveedores WHERE id_proveedor = :id_proveedor";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);

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