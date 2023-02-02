<?php 

require_once '../../model/ventas.php';

$model = new ventas();

$codigo = $_POST['codigo'];

$sec = $_POST['sec'];

$telefonoRef = $_POST['telefonoRef'];

$promocion = isset($_POST['promocion']) ? $_POST['promocion'] : '---';

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '-';

$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '---';

$lineaProce = isset($_POST['lineaProce']) ? $_POST['lineaProce'] : '---';

$operadorCeden = isset($_POST['operadorCeden']) ? $_POST['operadorCeden'] : '---';

$modalidad = isset($_POST['modalidad']) ? $_POST['modalidad'] : '-';

$modoReno = isset($_POST['modoReno']) ? $_POST['modoReno'] : '-';

$plan = isset($_POST['plan']) ? $_POST['plan'] : '---';

$equipos = isset($_POST['equipos']) ? $_POST['equipos'] : '---';

$tipoFija = isset($_POST['tipoFija']) ? $_POST['tipoFija'] : '-';

$planFija = isset($_POST['planFija']) ? $_POST['planFija'] : '---';

$modoFija = isset($_POST['modoFija']) ? $_POST['modoFija'] : '---';

$formaPago = $_POST['formaPago'];

$distrito = $_POST['distrito'];

$ubicacion = $_POST['ubicacion'];

$observacion = $_POST['observaciones'];

$estado = $_POST['estado'];




$model->editarDetalle($codigo,$sec,$telefonoRef,$promocion,$tipo,$telefono,$lineaProce,$operadorCeden,$modalidad,$modoReno,$plan,$equipos,$tipoFija,$planFija,$modoFija,$formaPago,$distrito,$ubicacion,$observacion,$estado);
?>
<script>
    window.history.back();
</script>