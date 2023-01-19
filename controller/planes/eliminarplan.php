<?php
require_once "../../model/planes.php";

$planes = new planes();

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$code = isset($_POST['code']) ? $_POST['code'] : null;
$plan = isset($_POST['plan']) ? $_POST['plan'] : null;

$datos = [];
if ($tipo == 0 || $tipo ==1) {
    $datos['plan'] = '';
}elseif ($tipo == 2) {
    $datos['promo'] = '';
}


if ($code != null)
{
    if ($tipo == "0") {
        $planes->eliminarFija($code);
        $datos['plan'] .= "Se eliminó el plan de lineas Fijas: '$plan'";
    }
    elseif ($tipo == "1") {
        $planes->eliminarMovil($code);
        $datos['plan'] .= "Se eliminó el plan de lineas Moviles: '$plan'";
    }
    elseif ($tipo == "2") {
        $planes->eliminarPromo($code);
        $datos['promo'] .= "Se eliminó la promoción: '$plan'";
    }
}
else 
{
    if ($tipo == 0 || $tipo ==1) {
        $datos['plan'] .= "No se ingresó un plan para su eliminación";
    }elseif ($tipo == 2) {
        $datos['promo'] .= "No se ingresó una promoción para su eliminación";
    }
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>