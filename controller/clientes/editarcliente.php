<?php 
require_once "../../model/clientes.php";

$cliente = new cliente();

$dnicliente = isset($_POST['dni']) ? $_POST['dni'] : null;
$ubicacioncliente = !empty($_POST['ubicacion']) ? $_POST['ubicacion'] : '---';
$distritocliente = !empty($_POST['distrito']) ? $_POST['distrito'] : '---';

$datos = [];
$datos['cliente'] = '';

if ($dnicliente != null) 
{  
    $cliente->editarCliente($dnicliente,$ubicacioncliente,$distritocliente);
}
?>
<script>
    window.history.back();
</script>