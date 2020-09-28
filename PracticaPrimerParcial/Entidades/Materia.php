<?php

require_once './filemanager.php';

Class Materia {

    public $_id;
    public $_nombre;
    public $_cuatrimestre;

    public function __construct($id, $nombre, $cuatrimeste) {
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_cuatrimestre = $cuatrimeste;        
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
        return $this->_id.'*'.$this->_nombre.'*'.$this->_cuatrimestre;
        //return json_encode($this);
    }

    public static function guardarMateria($id, $nombre, $cuatrimestre){
        $materia = new Materia($id, $nombre,$cuatrimestre);
        filemanager::guardarJSON("Materia.json", $materia);
    }

    public static function LeerMateria(){
        $arrayMaterias = filemanager::LeerJSON('Materia.json');
        if($arrayMaterias == null){
            echo 'Se encuentra vacio';
        }else{
            var_dump($arrayMaterias);
        }
    }

}