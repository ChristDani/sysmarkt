<?php
require_once "../../model/planes.php";

$planes = new planes();

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$code = isset($_POST['code']) ? $_POST['code'] : null;
$plan = isset($_POST['plan']) ? $_POST['plan'] : null;

$datos = [];
$datos['plan'] = '';

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
}
else 
{
    $datos['plan'] .= "No se ingresó un plan para su eliminación";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>