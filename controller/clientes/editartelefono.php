<?php 
require_once '../../model/clientes.php';

$cliente = new cliente();

$dni = isset($_POST['dni']) ? $_POST['dni'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$operador = isset($_POST['operador']) ? $_POST['operador'] : null;
$linea = isset($_POST['tipoLinea']) ? $_POST['tipoLinea'] : '-';

$datos = [];
$datos['telefono'] = '';

if ($telefono != null) 
{
    $cliente->editarTelefono($dni,$telefono,$tipo,$operador,$linea);
}
?>
<script>
    window.history.back();
</script>