<?php
class usuarios
{
    public $usuario;
    public $id;

    public function setId($id)
    {
        $this->id = $id;
    }
    // Captura el nombre lo almacena en nombre

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function getUsuario()
    {

        return $this->usuario;
    }
}
