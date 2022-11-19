<?php
require_once("modelo/modeloClass.php");
class vecinoController{
	private $model;
	function __construct(){
        $this->model=new Modelo();
    }
    // MOSTRAR
    function mostrar($cuit){
    	$vecino 	=	new Modelo();
		$dato=$vecino->mostrar("vecino","cuit = ".$cuit);
		return $dato;
    }

    function guardar(){
    	$cuit 	=	$_REQUEST['cuit'];
    	$nombre 	=	$_REQUEST['nombre'];
    	$domicilio 	=	$_REQUEST['domicilio'];
    	$localidad 	=	$_REQUEST['localidad'];
    	$email 	=	$_REQUEST['email'];
    	$contrasenia 	=	$_REQUEST['contraseña'];
        $data       =   "'".$cuit."','".$nombre."','".$domicilio."','".$localidad."','".$email."','".$contrasenia."'";
    	$vecino 	=	new Modelo();
		$dato 		=	$vecino->insertar("vecino",$data);
		header("location:http://localhost:8080/pobretito/Vista/");
    }
}