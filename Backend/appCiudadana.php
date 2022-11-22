<?php

require_once("../Controlador/motivoController.php");
require_once("../Controlador/requerimientoController.php");
require_once("../Controlador/submotivoController.php");
require_once("../Controlador/vecinoController.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$funcion = $request->funcion;

// Comprueba si el nombre de la funcion pasado como parametro existe.
if (function_exists($funcion)) {
    //Si existe la funcion, la ejecuta.
    call_user_func($funcion);
}

function guardarVecino()
{
    global $request;
    $datos = $request->data;
    $nombreVecino = $datos->nombreVecino;
    $cuitVecino = $datos->cuitVecino;
    $domicilioVecino = $datos->domicilioVecino;
    $localidadVecino = $datos->localidadVecino;
    $emailVecino = $datos->emailVecino;
    $contrasenia = $datos->contrasenia;

    $error = false;
    $mensaje = "";

    $_REQUEST['cuit'] = $cuitVecino;
    $_REQUEST['nombre'] = $nombreVecino;
    $_REQUEST['domicilio'] = $domicilioVecino;
    $_REQUEST['localidad'] = $localidadVecino;
    $_REQUEST['email'] = $emailVecino;
    $_REQUEST['contrasenia'] = $contrasenia;

    $nuevoVecino = vecinoController::guardar();

    if (!$nuevoVecino){
        $mensaje = "Error";
        $error = true;
    }

    $respuesta = array(
        "error" => $error,
        "mensaje" => $mensaje
    );

    $json = json_encode($respuesta);
    echo $json;
}

function iniciarSesion()
{
    global $request;
    $datos = $request->data;
    $cuitVecino = $datos->cuitVecino;
    $contrasenia = $datos->contrasenia;

    $error = false;
    $mensaje = "";

    $iniciarSesion = vecinoController::iniciarSesion($cuitVecino,$contrasenia);

    if (!$iniciarSesion){
        $mensaje = "Error";
        $error = true;
    }

    $respuesta = array(
        "error" => $error,
        "mensaje" => $mensaje
    );

    $json = json_encode($respuesta);
    echo $json;
}

function cargarVecino()
{
    global $request;
    $datos = $request->data;
    $cuitVecino = $datos->cuitVecino;

    $error = false;
    $mensaje = "";

    $cargaVecino = vecinoController::mostrar($cuitVecino);

    if (!$cargaVecino){
        $mensaje = "Error";
        $error = true;
    }else{
        $vecino['nombre'] = $cargaVecino['nombre'];
    }

    $respuesta = array(
        "error" => $error,
        "mensaje" => $mensaje,
        "vecino" => $vecino
    );

    $json = json_encode($respuesta);
    echo $json;
}

function guardarRequerimiento()
{
    global $request;
    $datos = $request->data;
    $cuitVecino = $datos->cuitVecino;
    $motivo = $datos->motivo;
    $detalle = $datos->detalle;
    $foto = $datos->foto;
    $observacion = $datos->observacion;

    $error = false;
    $mensaje = "";

    $_REQUEST['cuit'] = $cuitVecino;
    $_REQUEST['idMotivo'] = $motivo;
    $_REQUEST['idSubmotivo'] = $detalle;
    $_REQUEST['urlFoto'] = $foto;
    $_REQUEST['observacion'] = $observacion;
    $_REQUEST['ubicacion'] = '';


    $nuevoRequerimiento = requerimientoController::guardar();

    if (!$nuevoRequerimiento){
        $mensaje = "Error, no se pudo crear el requerimiento intente mas tarde";
        $error = true;
    }

    $respuesta = array(
        "error" => $error,
        "mensaje" => $mensaje
    );

    $json = json_encode($respuesta);
    echo $json;
}