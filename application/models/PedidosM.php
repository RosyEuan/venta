<?php
class PedidosM extends CI_Model{

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


        public function obtenerPlatillos()
        {
            try {
                $query = "SELECT id_platillo, nombre_platillo FROM platillos";
                $statement = $this->connect->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como un arreglo asociativo
            } catch (PDOException $e) {
                log_message('error', 'Error al obtener platillos: ' . $e->getMessage());
                return [
                    'status' => 'error',
                    'message' => 'Error al obtener el platillo: ' . $e->getMessage()
                ];
            }
        }
}
?>