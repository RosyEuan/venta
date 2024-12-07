<?php
class Login extends CI_Model
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

    public function Iniciar_sesion($usuario)
    {
        try {
            $sql = "SELECT * FROM empleados e JOIN usuarios_empleados us JOIN puestos p
                    WHERE us.nombre_usuario = :usuario and e.id_empleado = us.id_empleado and p.id_puesto = e.puesto";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            } else {
                return ['status' => 'error', 'message' => 'Usuario no encontrado.'];
            }
        } catch (PDOException $e) {
            log_message('error', 'Error en la consulta de inicio de sesión: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error en la consulta de inicio de sesión.'];
        }
    }

    public function ExistenciaEmpleado($id_empleado)
    {
        try {
            $sqlVerify = "SELECT * FROM empleados WHERE id_empleado = :id_empleado";
            $stmt = $this->connect->prepare($sqlVerify);
            $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (isset($result['id_empleado']) && !empty($result['id_empleado'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            log_message('error', 'Error en la consulta de existencia de empleado: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error al verificar la existencia del empleado.'];
        }
    }

    public function Registrar_usuario($usuario, $contraseña, $id_empleado)
    {
        try {
            if (!$this->ExistenciaEmpleado($id_empleado)) {
                return ['status' => 'error', 'message' => 'El empleado no existe.'];
            }
            if ($this->ExistenciaUsuario($usuario)) {
                return ['status' => 'error', 'message' => 'El nombre de usuario ya está en uso.'];
            }

            $contraseña_segura = password_hash($contraseña, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios_empleados (id_empleado, nombre_usuario, contraseña) 
                     VALUES (:id_empleado, :nombre_usuario, :password)";

            $stmt = $this->connect->prepare($sql);

            $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
            $stmt->bindParam(':nombre_usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':password', $contraseña_segura, PDO::PARAM_STR);


            $result = $stmt->execute();

            if ($result) {
                return ['status' => 'success', 'message' => 'Cuenta creada correctamente.'];
            } else {
                $informacion_error = $stmt->errorInfo();
                return ['status' => 'error', 'message' => 'No se pudo crear la cuenta.' . $informacion_error[2]];
            }
        } catch (PDOException $e) {
            log_message('error', 'Error en la consulta de registro de usuario: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error al registrar el usuario. ' . $e->getMessage()];
        }
    }

    public function ExistenciaUsuario($nombre_usuario)
    {
        try {
            $sql = "SELECT nombre_usuario FROM usuarios_empleados WHERE nombre_usuario = :nombre_usuario";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($result['nombre_usuario']) && !empty($result['nombre_usuario'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            log_message('error', 'Error en la consulta de existencia de usuario: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error al verificar la existencia del usuario.'];
        }
    }

    public function VerificarPuesto($puesto)
    {
        try {
            $query = "SELECT * FROM empleados WHERE puesto = :puesto";
            $parameters = $this->connect->prepare($query);
            $parameters->bindParam(':puesto', $puesto);
            $parameters->execute();
            $result_1 = $parameters->fetch(PDO::FETCH_ASSOC);
            return $result_1;
        } catch (PDOException $e) {
            log_message('error', 'Error en la consulta de verificación de puesto: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Error al verificar el puesto.'];
        }
    }
    public function getPuestos()
    {
        try {
            $query = "SELECT * FROM puestos";
            $parameters = $this->connect->prepare($query);
            $parameters->execute();
            $result = $parameters->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error al obtener los puestos ' . $e->getMessage()];
        }
    }
}
