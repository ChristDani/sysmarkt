<?php
require_once "../../model/planes.php";

$planes = new planes();

$code = !empty($_POST['code']) ? $_POST['code'] : null;
$plan = !empty($_POST['plan']) ? $_POST['plan'] : null;
$planactual = !empty($_POST['planactual']) ? $_POST['planactual'] : null;

$datos = [];
$datos['plan'] = '';

if ($plan != null)
{
    $planes->editarMovil($code,$plan);
    $datos['plan'] .= "Se actualizó el plan '$planactual' a: '$plan'";
}
else 
{
    $datos['plan'] .= "No se ingresó un plan para su actualización";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>