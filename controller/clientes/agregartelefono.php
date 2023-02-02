<?php 
require_once '../../model/clientes.php';
require_once "../../model/masiva.php";

$cliente = new cliente();
$masiva = new masiva();

$dni = isset($_POST['dni']) ? $_POST['dni'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$operador = isset($_POST['operador']) ? $_POST['operador'] : null;
$linea = isset($_POST['tipoLinea']) ? $_POST['tipoLinea'] : null;

$datos = [];
$datos['telefono'] = '';

if ($dni != null) 
{
    $bustelefono = $cliente->buscarTelefono($telefono);

    if ($bustelefono == null) 
    {
        $cliente->insertarTelefono($dni,$telefono,$tipo,$operador,$linea);
        $masiva->eliminarportelefono($telefono);
        $datos['telefono'] .= "Se registró el telefono: '$telefono', del cliente: '$dni'";
    }
    else 
    {
        $datos['telefono'] .= "El telefono: '$telefono' ya se encuentra registrado";
    }
}
else 
{
    $datos['telefono'] .= "No se ingresó un telefono a registrar.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>