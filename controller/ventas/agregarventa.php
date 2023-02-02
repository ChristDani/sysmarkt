<?php 
require_once "../../model/clientes.php";
require_once '../../model/ventas.php';
require_once "../../model/masiva.php";


$cliente = new cliente();
$venta = new ventas();
$masiva = new masiva();

$dniasesor = isset($_POST['dniasesor']) ? $_POST['dniasesor'] : null;
$dnicliente = isset($_POST['dnicliente']) ? $_POST['dnicliente'] : null;
$nombrecliente = isset($_POST['nombrecliente']) ? $_POST['nombrecliente'] : null;
$ubicacioncliente = !empty($_POST['ubicacioncliente']) ? $_POST['ubicacioncliente'] : "---";
$distritocliente = !empty($_POST['distritocliente']) ? $_POST['distritocliente'] : "---";
$sec = isset($_POST['sec']) ? $_POST['sec'] : null;

$datos = [];
$datos['cliente'] = '';
$datos['venta'] = '';

if ($dnicliente != null) 
{  
    $buscliente = $cliente->buscarCliente($dnicliente);

    if ($buscliente != null) 
    {
        $datos['cliente'] .= 'Cliente registrado anteriormente...';
    }
    else 
    {
        $cliente->insertarCliente($dnicliente,$nombrecliente,$ubicacioncliente,$distritocliente);
        $datos['cliente'] .= "Registrando al nuevo cliente '$nombrecliente'.";
        $masiva->eliminarpordni($dnicliente);
    }
    
    if ($sec != null) 
    {
        $venta->agregarVenta($dniasesor,$dnicliente,$sec);
        $datos['venta'] .= "Venta registrada mediante la SEC: '$sec'";
    }
    else 
    {
        $datos['venta'] .= "No se ingresó la sec de la venta.";
    }
}
else 
{
    $datos['cliente'] .= "No se ingresó ningun dato del cliente.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>