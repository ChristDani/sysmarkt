<?php
require_once "../../model/conexion.php";

$model=new conexion();
$con=$model->conectar();

$sql = "SELECT * from planes";

$resultado=mysqli_query($con,$sql);

$filas = $resultado->num_rows;

$output=[];
$output['data']= '';

if ($filas>0)
{ 
    $i=1;
    while ($fila=mysqli_fetch_array($resultado))
    {
        $code = $fila['codigo']; 
        $plan = $fila['nombre']; 
        $output['data'] .= "<tr>";
        $output['data'] .= "<th class='color'>$i</th>";
        $output['data'] .= "<th class='color d-none'>$code</th>";
        $output['data'] .= "<th class='color'>$plan</th>";
        $output['data'] .= "<th onclick='mostrarEdicionMovil(\"$code\",\"$plan\");'><a href='#'><ion-icon name='create-outline'></ion-icon></a></th>";
        $output['data'] .= "<th data-bs-toggle='modal' data-bs-target='#eliminarplan' onclick='eliminarplan(\"1\",\"$code\",\"$plan\");'><a href='#'><ion-icon name='trash-outline'></ion-icon></a></th>";
        $output['data'] .= "</tr>";
        $i+=1; 
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>