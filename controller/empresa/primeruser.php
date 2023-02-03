<?php 
require_once '../../model/usuarios.php';

$usuarios = new user();

$dni = !empty($_POST['dni']) ? $_POST['dni'] : null;
$nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;

$datos = [];
$datos['usuario'] = '';

if ($dni != null && strlen($dni) == 8) 
{
    $clave = sha1(strrev($dni));
    $usuarios->insertarUsuario($dni,$nombre,$clave,'1','---');
    $datos['usuario'] .= "Se registró el primer usuario: '$nombre', con DNI: '$dni'";
}
else 
{
    $datos['usuario'] .= "No se ingresó un usuario a registrar.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>