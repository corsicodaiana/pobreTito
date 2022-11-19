<?php
require_once("../Modelo/modeloClass.php");
class submotivoController{
	private $model;
	function __construct(){
        $this->model=new Modelo();
    }
    // MOSTRAR
    static function mostrarSubmotivo($idMotivo){
    	$submotivo 	=	new Modelo();
		$dato=$submotivo->mostrar("submotivo","idMotivo = ".$idMotivo);
        return $dato;
    }
}