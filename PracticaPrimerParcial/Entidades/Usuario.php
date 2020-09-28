<?php

require_once './filemanager.php';

Class Usuario{

    private $_email;
    private $_clave;

    public function __construct($email, $clave) {
        $this->_email = $email;
        $this->_clave = $clave;        
    }

    public function __get($name)
    {
        return $this->$name;
    }
    
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __toString()
    {
        return $this->_email.'*'.$this->_clave;
        //return json_encode($this);
    }

    public static function guardarUsuario($email, $clave){
        $usuario = new Usuario($email,$clave);
        filemanager::guardarJSON("Usuario.json", $usuario);
    }

    public static function LeerUsuario(){
        $arrayUsuarios = filemanager::LeerJSON("Usuario.json");
        if($arrayUsuarios == null){
            echo 'Se encuentra vacio';
        }else{
            var_dump($arrayUsuarios);
        }
    }

    public function verificar($array){
        $login = false;
        foreach($array as $item){
            if($item->_email == $this->_email){
                if($item->_clave == $this->_clave){
                    $login = true;
                }
            }
        }
        return $login;
    }

}