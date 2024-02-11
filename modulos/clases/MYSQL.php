<?php
// clase para conexiones
class MYSQL
{
    // Datos de validacion para la conexión
    private $ipServidor = "localhost";
    private $usuarioBase = 'root';
    private $contrasena = '';

    private $conexion;
    private $resultadoConsulta;

    // Metodo para conectar la base de datos 
    public function conectar()
    {
        $this->conexion = mysqli_connect($this->ipServidor, $this->usuarioBase, $this->contrasena);
    }
    public function desconectar()
    {
        mysqli_close($this->conexion);
    }

    public function efectuarConsulta($consulta)
    {
        mysqli_query($this->conexion, "SET lc_time_names = 'es_Es'");
        // Añade el uso de caracteres especiales como tildes con el formato UTF-8
        mysqli_query($this->conexion, "SET NAMES 'utf8'");

        $this->resultadoConsulta = mysqli_query($this->conexion, $consulta);
        return $this->resultadoConsulta;
    }
}
