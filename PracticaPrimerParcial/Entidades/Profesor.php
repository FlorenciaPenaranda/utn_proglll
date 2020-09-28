<?php

require_once './filemanager.php';

Class Profesor{

    private $_nombre;
    private $_legajo;

    public function __construct($nombre, $legajo) {
        $this->_nombre = $nombre;
        $this->_legajo = $legajo;        
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
        return $this->_nombre.'*'.$this->_legajo;
        //return json_encode($this);
    }

    public static function guardarProfesor($nombre, $legajo){
        $profesor = new Profesor($nombre, $legajo);
        filemanager::guardarJSON("Profesor.json", $profesor);
    }

    public static function LeerProfesor(){
        $arrayProfesores = filemanager::LeerJSON('Profesor.json');
        if($arrayProfesores == null){
            echo 'Se encuentra vacio';
        }else{
            var_dump($arrayProfesores);
        }
    }

}