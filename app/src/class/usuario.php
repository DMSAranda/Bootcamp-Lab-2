<?php
require_once('./interfaces/usuario.php');

class Usuario implements UsuarioInterface {
    
    private $nombre;
    private $email;
    public function __construct($nombre, $email) {
        $this->nombre = $nombre;
        $this->email = $email;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }


}
?>