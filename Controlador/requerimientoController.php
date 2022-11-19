<?php
require_once("modelo/modeloClass.php");
class vecinoController{
	private $model;
	function __construct(){
        $this->model=new Modelo();
    }

    function guardar(){
    	$idRequerimiento 	=	$_REQUEST['idRequerimiento'];
    	$cuit 	=	$_REQUEST['cuit'];
    	$idMotivo 	=	$_REQUEST['idMptivo'];
    	$idSubmotivo 	=	$_REQUEST['idSubmotivo'];
    	$urlFoto 	=	$_REQUEST['urlFoto'];
    	$observacion 	=	$_REQUEST['observacion'];
    	$ubicacion 	=	$_REQUEST['ubicacion'];
        $data       =   "'".$idRequerimiento."','".$cuit."',".$idMotivo.",".$idSubmotivo.",'".$urlFoto."','".$observacion."','".$ubicacion."'";
    	$requerimiento 	=	new Modelo();
		$dato 		=	$requerimiento->insertar("requerimiento",$data);
		header("location:http://localhost:8080/pobretito/Vista/home");
    }
}