<?php
require_once '../../model/conexion.php';

$model=new conexion();
$con=$model->conectar();

// posicion de registro
$dnib = isset($_POST['dni']) ? $_POST['dni'] : null;

// llamamos al registro
$sql = "SELECT dni, nombre, ubicacion, distrito from clientes where dni='$dnib'";

$resultado=mysqli_query($con,$sql);

// para saber el numero de filas
$filas = $resultado->num_rows;

$output=[];
$output['data']= '';

if ($filas>0) 
{
    while ($fila=mysqli_fetch_array($resultado)) 
    {
        // variables asignadas de la base de datos

        $dni = $fila['dni'];
        $nombre = $fila['nombre'];
        $distrito = $fila['distrito'];
        $ubicacion = $fila['ubicacion'];
        
        $output['data'].= "<div class='form-floating mb-3 d-none'>";
        $output['data'].= "<input class='form-control' type='text' name='dni' id='dni' value='$dni'>";
        $output['data'].= "<label for='dni'>DNI</label>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='row text-center'>";

        $output['data'].= "<div class='col'>";
        $output['data'].= "<div class='card'>";
        $output['data'].= "<div class='card-body'>";        
        $output['data'].= "<p class='text-muted'>Nombre</p>";
        $output['data'].= "<h3 class='text-info'>$nombre</h3>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        $output['data'].= "</div>";
        
        $output['data'].= "</div>";

        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='text' name='distrito' id='distrito' value='$distrito'>";
        $output['data'].= "<label for='distrito'>distrito</label>";
        $output['data'].= "</div>";

        $output['data'].= "<div class='form-floating mb-3'>";
        $output['data'].= "<input class='form-control' type='text' name='ubicacion' id='ubicacion' value='$ubicacion'>";
        $output['data'].= "<label for='ubicacion'>ubicacion</label>";
        $output['data'].= "</div>";
    }
}


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...

?>