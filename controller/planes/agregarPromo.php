<?php
require_once "../../model/planes.php";

$promocion = new planes();

$promo = !empty($_POST['promo']) ? $_POST['promo'] : null;

$datos = [];
$datos['promo'] = '';

if ($promo != null)
{
    $promocion->agregarPromo($promo);
    $datos['promo'] .= "Se agregó la promoción: '$promo'";
}
else 
{
    $datos['promo'] .= "No se ingresó una promoción";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>