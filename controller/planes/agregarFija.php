<?php
require_once "../../model/planes.php";

$planes = new planes();

$plan = !empty($_POST['plan']) ? $_POST['plan'] : null;

$datos = [];
$datos['plan'] = '';

if ($plan != null)
{
    $planes->agregarFija($plan);
    $datos['plan'] .= "Se agregó el plan: '$plan'";
}
else 
{
    $datos['plan'] .= "No se ingresó un plan";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>