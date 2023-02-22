<?php
require_once "../../model/usuarios.php";

$dni = isset($_POST['dni']) ? $_POST['dni'] : null;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;

$datos = [];
$datos['state'] = '';

$model = new user();

if ($tipo == "1") 
{
    $model->activarEstado($dni);
    $datos['state'] .= "Usuario Reconectado.";
}
elseif ($tipo == "2") 
{
    $model->reposarEstado($dni);
    $datos['state'] .= "Usuario Ausente.";
}
elseif ($tipo == "3")
{
    $model->desactivarEstado($dni);
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>