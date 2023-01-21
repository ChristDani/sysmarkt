<?php 
require_once "../../model/clientes.php";

$cliente = new cliente();

$dnicliente = isset($_POST['dni']) ? $_POST['dni'] : null;
$nombrecliente = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$ubicacioncliente = !empty($_POST['ubicacion']) ? $_POST['ubicacion'] : "---";
$distritocliente = !empty($_POST['distrito']) ? $_POST['distrito'] : "---";

$datos = [];
$datos['cliente'] = '';

if ($dnicliente != null) 
{  
    $buscliente = $cliente->buscarCliente($dnicliente);

    if ($buscliente != null) 
    {
        $datos['cliente'] .= 'Cliente registrado anteriormente...';
    }
    else 
    {
        $datos['cliente'] .= 'Cliente no registrado anteriormente...';
        $cliente->insertarCliente($dnicliente,$nombrecliente,$ubicacioncliente,$distritocliente);
        $datos['cliente'] .= " // ";
        $datos['cliente'] .= "Registrando al nuevo cliente '$nombrecliente'.";

    }
}
else 
{
    $datos['cliente'] .= "No se ingresó ningun dato del cliente.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>