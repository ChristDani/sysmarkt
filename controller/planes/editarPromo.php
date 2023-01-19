<?php
require_once "../../model/planes.php";

$planes = new planes();

$code = !empty($_POST['code']) ? $_POST['code'] : null;
$promo = !empty($_POST['promo']) ? $_POST['promo'] : null;
$promoactual = !empty($_POST['promoactual']) ? $_POST['promoactual'] : null;

$datos = [];
$datos['promo'] = '';

if ($promo != null)
{
    $planes->editarPromo($code,$promo);
    $datos['promo'] .= "Se actualizó la promoción '$promoactual' a: '$promo'";
}
else 
{
    $datos['promo'] .= "No se ingresó una promoción para su actualización";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>