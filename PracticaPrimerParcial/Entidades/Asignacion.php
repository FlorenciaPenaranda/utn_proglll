<?php

class Asignacion{

    public $_legajoProfesor;
    public $_idMateria;
    public $_turno;

    public function __construct($legajoProfesor, $idMateria, $turno){
        $this->_legajoProfesor = $legajoProfesor;
        $this->_idMateria = $idMateria;
        $this->_turno = $turno;
    }    

}