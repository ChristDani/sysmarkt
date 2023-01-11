<?php
require_once "../../model/usuarios.php";
$model = new user();

$dni = $_POST['dni'];
$dniModerador = $_POST['dniModerador'];
$nombre = $_POST['nombre'];
$clave = sha1(strrev($dni));
$tipo = $_POST['tipo'];

$bus = $model->buscarUser($dni);

if ($bus != null) 
{
    $model->reactivar($dni);
}
else 
{
    $model->insertarUsuario($dni,$nombre,$clave,$tipo,$dniModerador);
}
?>
<script>
    window.history.back();
</script>