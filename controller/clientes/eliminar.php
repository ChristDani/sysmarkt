<?php 
require_once '../../model/clientes.php';

$cliente = new cliente();

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;

if ($tipo == "0") 
{
    $cliente->eliminarCliente($codigo);
}
elseif ($tipo == "1") 
{
    $cliente->eliminarTelefono($codigo);
}
?>
<script>
    window.history.back();
</script>