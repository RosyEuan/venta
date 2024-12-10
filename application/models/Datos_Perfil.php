<?php
class Datos_Perfil extends CI_Model{
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

    public function obtenerDatosPerfil()
    {
        // Obtener el id del usuario de la sesión
        $id_usuario = $this->session->userdata('id_usuario');
        
        if (!$id_usuario) {
            return ['status' => 'error', 'message' => 'Usuario no autenticado'];
        }

        try {
            // Consulta adaptada con el id_Usuario_Empleado de la sesión
            $sql = "SELECT 
                        e.nombre_empleado, 
                        e.apellidos_empleado,
                        e.fecha_nacimiento, 
                        e.domicilio,
                        u.nombre_usuario, 
                        u.contraseña, 
                        e.email, 
                        e.telefono, 
                        e.CURP, 
                        e.RFC, 
                        p.nombre_puesto, 
                        e.salario 
                    FROM 
                        empleados e
                    INNER JOIN 
                        usuarios_empleados u ON e.id_empleado = u.id_empleado
                    INNER JOIN 
                        puestos p ON e.puesto = p.id_puesto
                    WHERE 
                        u.id_Usuario_Empleado = :id_usuario";

            // Preparar la consulta
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se obtuvieron resultados
            if (isset($result['nombre_empleado']) && !empty($result['nombre_empleado'])) {
                return $result;
            } else {
                return ['status' => 'error', 'message' => 'No se encontraron datos de perfil'];
            }

        } catch (PDOException $e) {
            log_message('error', 'Error al obtener los datos del perfil: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error al obtener los datos del perfil '.$e->getMessage()];
        }
    }

    public function actualizarDatosPerfil($datos)
    {
        try {
            // Obtener el ID del usuario desde la sesión
            $id_usuario = $this->session->userdata('id_usuario');

            // Verificar si el ID del usuario está disponible
            if (!$id_usuario) {
                return ['status' => 'error', 'message' => 'Usuario no autenticado'];
            }

            // Consulta SQL con parámetros preparados
            $sql = "
                UPDATE 
                    empleados e
                INNER JOIN 
                    usuarios_empleados u ON e.id_empleado = u.id_empleado
                SET
                    e.domicilio = :domicilio,
                    u.nombre_usuario = :nombre_usuario,
                    e.email = :email,
                    e.telefono = :telefono
                WHERE 
                    u.id_Usuario_Empleado = :id_usuario;
            ";

            // Preparar la consulta
            $stmt = $this->db->prepare($sql);

            // Asociar los parámetros
            $stmt->bindParam(':domicilio', $datos['domicilio'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre_usuario', $datos['nombre_usuario'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return ['status' => 'success', 'message' => 'Perfil actualizado correctamente'];
            } else {
                return ['status' => 'error', 'message' => 'Error al actualizar el perfil'];
            }

        } catch (PDOException $e) {
            // Registrar el error en los logs y devolver mensaje de error
            log_message('error', 'Error al modificar los datos del perfil: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error al modificar los datos del perfil: ' . $e->getMessage()];
        }
    }


}
?>