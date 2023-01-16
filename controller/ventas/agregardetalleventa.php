<?php 
require_once '../../model/ventas.php';

$venta = new ventas();

$sec = isset($_POST['sec']) ? $_POST['sec'] : null;
$referencia = !empty($_POST['referencia']) ? $_POST['referencia'] : '---';
$producto = isset($_POST['producto']) ? $_POST['producto'] : null;
$promocion = isset($_POST['promocion']) ? $_POST['promocion'] : null;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$telefop = !empty($_POST['telefop']) ? $_POST['telefop'] : '---';
$lineaproce = isset($_POST['lineaproce']) ? $_POST['lineaproce'] : null;
$operaceden = isset($_POST['operaceden']) ? $_POST['operaceden'] : null;
$modalidad = isset($_POST['modalidad']) ? $_POST['modalidad'] : null;
$modoreno = isset($_POST['modoreno']) ? $_POST['modoreno'] : null;
$plan = isset($_POST['plan']) ? $_POST['plan'] : null;
$equipo = isset($_POST['equipo']) ? $_POST['equipo'] : null;
$tipofija = isset($_POST['tipofija']) ? $_POST['tipofija'] : null;
$planfija = isset($_POST['planfija']) ? $_POST['planfija'] : null;
$modofija = isset($_POST['modofija']) ? $_POST['modofija'] : null;
$formapago = isset($_POST['formapago']) ? $_POST['formapago'] : null;
$distrito = !empty($_POST['distrito']) ? $_POST['distrito'] : '---';
$ubicacion = !empty($_POST['ubicacion']) ? $_POST['ubicacion'] : '---';
$observacion = !empty($_POST['observacion']) ? $_POST['observacion'] : '---';
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;

$datos = [];
$datos['detalleventa'] = '';

if ($sec != null) 
{
    $venta->agregarDetalleVenta($sec,$referencia,$producto,$promocion,$tipo,$telefop,$lineaproce,$operaceden,$modalidad,$modoreno,$plan,$equipo,$tipofija,$planfija,$modofija,$formapago,$distrito,$ubicacion,$observacion,$estado);
    $datos['detalleventa'] .= "Detalle de venta registrado a la venta con la SEC: '$sec'";
}
else 
{
    $datos['detalleventa'] .= "No se ingresó detalle de venta.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>