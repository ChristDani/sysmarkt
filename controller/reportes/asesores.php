<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

$moderador= !empty($_POST['moderador']) ? $_POST['moderador'] : null;

$sql = "SELECT dni, nombre from usuarios where tipo='0' and dniModerador like '%$moderador%'";

$resultado=mysqli_query($con,$sql);

$filas = $resultado->num_rows;

$output=[];
$output['data'] = '';
$output['data'] .= "<option value=''>Todos</option>";

if ($filas>0) 
{
    while ($fila=mysqli_fetch_array($resultado)) 
    {
        $dni = $fila['dni'];
        $nombre = $fila['nombre'];
        $output['data'] .= "<option value='$dni'>$nombre</option>";
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>