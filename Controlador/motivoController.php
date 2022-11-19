<?php
require_once("../Modelo/modeloClass.php");
class motivoController{
	private $model;
	function __construct(){
        $this->model=new Modelo();
    }
    // MOSTRAR
    static function mostrarMotivo(){
    	$motivo 	=	new Modelo();
		$dato=$motivo->mostrarTodos("motivo");
        return $dato;
    }
}