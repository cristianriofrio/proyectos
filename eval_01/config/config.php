<?php
class ClaseConectar
{
    public $conexion;
    protected $db;
    private $host = "localhost";
    private $usuario = "root";
    private $pass = "root";
    private $base = "recetario";

    public function ProcedimientoParaConectar()
    {
        // Establecer la conexión con la base de datos
        $this->conexion = mysqli_connect($this->host, $this->usuario, $this->pass, $this->base);

        // Verificar si hubo un error de conexión
        if (!$this->conexion) {
            die("Error al conectar con el servidor: " . mysqli_connect_error());
        }

        // Configurar la codificación de caracteres a UTF-8
        mysqli_set_charset($this->conexion, "utf8");

        // Asignar la conexión a la propiedad db
        $this->db = $this->conexion;

        // Verificar si la conexión a la base de datos fue exitosa
        if ($this->db == false) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        // Retornar la conexión
        return $this->conexion;
    }
}
?>