<?php
require_once "../../model/conexion.php";
require_once "../../model/planes.php";

$model=new conexion();
$consulta=$model->conectar();

$abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];

$porcentajeFija = 50;

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();
$planesFija = $planeslist->listarFija();

$fecha= !empty($_POST['fecha']) ? $_POST['fecha'] : null;
$dniAsesor= !empty($_POST['dniasesor']) ? $_POST['dniasesor'] : null;


$output=[];
$output['movil']= '';
$output['fija']= '';

$comisionTotalFija = 0;

// suma de fijas
if ($planesFija != null) 
{
    foreach ($planesFija as $pr) 
    {
        if ($fecha == null)
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and planFija='".trim($pr[0])."' and estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planFija='".trim($pr[0])."' and estado='1'";
        }

        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', substr($pr[0],10));
        $comisionFija = ($plan*$cantidad)*($porcentajeFija/100);
        $comisionTotalFija = $comisionTotalFija+$comisionFija;

        $output['fija'] .= "<div class='col-xl-3 col-md-6'>";
        $output['fija'] .= "<div class='card'>";
        $output['fija'] .= "<div class='card-body'>";
        $output['fija'] .= "<div class='head d-flex justify-content-around'>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p>".$pr[0]."</p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p class='primary'>$porcentajeFija%</p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "<div class='body'>";
        $output['fija'] .= "<div class='row my-2'>";
        $output['fija'] .= "<h4 class='text-center warning'>$cantidad</h4>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "<div class='row text-center'>";
        $output['fija'] .= "<div class='col'>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "<div class='col'>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "<div class='col'>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
        $output['fija'] .= "<p class='my-1 success'>S/ $comisionFija</p>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "</div>";
    }
}

$comisionTotalNuevaEquipo = 0;
$cantidadTotalNuevaEquipo = 0;

$comisionTotalNuevaSinEquipo = 0;
$cantidadTotalNuevaSinEquipo = 0;

$comisionTotalProtaEquipo = 0;
$cantidadTotalProtaEquipo = 0;

$comisionTotalProtaSinEquipo = 0;
$cantidadTotalProtaSinEquipo = 0;

$comisionTotalRenovacion = 0;
$cantidadTotalRenovacion = 0;


// suma de lineas nuevas con equipo
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        if ($fecha == null)
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='0' and equipo!='Chip' and estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='0' and equipo!='Chip' and estado='1'";
        }

        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[0]);
        $comision = ($plan*$cantidad)*(50/100);
        $comisionTotalNuevaEquipo = $comisionTotalNuevaEquipo+$comision;
        $cantidadTotalNuevaEquipo = $cantidadTotalNuevaEquipo+$cantidad;
    }
}

$output['movil'] .= "<div class='col-xl-3 col-md-6'>";
$output['movil'] .= "<div class='card'>";
$output['movil'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesComision' onclick=detalles('lne');>";
$output['movil'] .= "<div class='card-body'>";
$output['movil'] .= "<div class='head d-flex justify-content-around'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p>Linea Nueva con Equipo</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p class='primary'>50%</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='body'>";
$output['movil'] .= "<div class='row my-2'>";
$output['movil'] .= "<h4 class='text-center warning'>$cantidadTotalNuevaEquipo</h4>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center'>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
$output['movil'] .= "<p class='my-1 success'>S/ $comisionTotalNuevaEquipo</p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</a>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";

// suma de lineas nuevas sin equipo
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        if ($fecha == null)
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='0' and equipo='Chip' and estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='0' and equipo='Chip' and estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[0]);
        $comision = ($plan*$cantidad)*(50/100);
        $comisionTotalNuevaSinEquipo = $comisionTotalNuevaSinEquipo+$comision;
        $cantidadTotalNuevaSinEquipo = $cantidadTotalNuevaSinEquipo+$cantidad;
    }
}

$output['movil'] .= "<div class='col-xl-3 col-md-6'>";
$output['movil'] .= "<div class='card'>";
$output['movil'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesComision' onclick=detalles('ln');>";
$output['movil'] .= "<div class='card-body'>";
$output['movil'] .= "<div class='head d-flex justify-content-around'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p>Linea Nueva sin Equipo</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p class='primary'>50%</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='body'>";
$output['movil'] .= "<div class='row my-2'>";
$output['movil'] .= "<h4 class='text-center warning'>$cantidadTotalNuevaSinEquipo</h4>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center'>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
$output['movil'] .= "<p class='my-1 success'>S/ $comisionTotalNuevaSinEquipo</p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</a>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";

// suma de portabilidades con equipo
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        if ($fecha == null)
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='1' and equipo!='Chip' and estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='1' and equipo!='Chip' and estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        if ($cantidad >= 0 and $cantidad <= 10) 
        {
            $porcentajeMovil = 60;
        }
        elseif ($cantidad >= 11 and $cantidad <= 15) 
        {
            $porcentajeMovil = 80;
        }
        elseif ($cantidad >= 16 and $cantidad <= 20) 
        {
            $porcentajeMovil = 100;
        }
        elseif ($cantidad >= 21) 
        {
            $porcentajeMovil = 120;
        }

        $plan = str_replace($abecedario, '', $pr[0]);
        $comision = ($plan*$cantidad)*($porcentajeMovil/100);
        $comisionTotalProtaEquipo = $comisionTotalProtaEquipo+$comision;
        $cantidadTotalProtaEquipo = $cantidadTotalProtaEquipo+$cantidad;
    }
}

if ($cantidadTotalProtaEquipo >= 0 and $cantidadTotalProtaEquipo <= 10) 
{
    $porcentajeMovilPortaEquipo = 60;
}
elseif ($cantidadTotalProtaEquipo >= 11 and $cantidadTotalProtaEquipo <= 15) 
{
    $porcentajeMovilPortaEquipo = 80;
}
elseif ($cantidadTotalProtaEquipo >= 16 and $cantidadTotalProtaEquipo <= 20) 
{
    $porcentajeMovilPortaEquipo = 100;
}
elseif ($cantidadTotalProtaEquipo >= 21) 
{
    $porcentajeMovilPortaEquipo = 120;
}

$output['movil'] .= "<div class='col-xl-3 col-md-6'>";
$output['movil'] .= "<div class='card'>";
$output['movil'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesComision' onclick=detalles('pe');>";
$output['movil'] .= "<div class='card-body'>";
$output['movil'] .= "<div class='head d-flex justify-content-around'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p>Portabilidad con Equipo</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p class='primary'>$porcentajeMovilPortaEquipo%</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='body'>";
$output['movil'] .= "<div class='row my-2'>";
$output['movil'] .= "<h4 class='text-center warning'>$cantidadTotalProtaEquipo</h4>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center'>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
$output['movil'] .= "<p class='my-1 success'>S/ $comisionTotalProtaEquipo</p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</a>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
     
// suma de portabilidades sin equipo
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        if ($fecha == null)
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='1' and equipo='Chip' and estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='1' and equipo='Chip' and estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        if ($cantidad >= 0 and $cantidad <= 10) 
        {
            $porcentajeMovil = 60;
        }
        elseif ($cantidad >= 11 and $cantidad <= 15) 
        {
            $porcentajeMovil = 80;
        }
        elseif ($cantidad >= 16 and $cantidad <= 20) 
        {
            $porcentajeMovil = 100;
        }
        elseif ($cantidad >= 21) 
        {
            $porcentajeMovil = 120;
        }

        $plan = str_replace($abecedario, '', $pr[0]);
        $comision = ($plan*$cantidad)*($porcentajeMovil/100);
        $comisionTotalProtaSinEquipo = $comisionTotalProtaSinEquipo+$comision;
        $cantidadTotalProtaSinEquipo = $cantidadTotalProtaSinEquipo+$cantidad;
    }
}

if ($cantidadTotalProtaSinEquipo >= 0 and $cantidadTotalProtaSinEquipo <= 10) 
{
    $porcentajeMovilPortaSinEquipo = 60;
}
elseif ($cantidadTotalProtaSinEquipo >= 11 and $cantidadTotalProtaSinEquipo <= 15) 
{
    $porcentajeMovilPortaSinEquipo = 80;
}
elseif ($cantidadTotalProtaSinEquipo >= 16 and $cantidadTotalProtaSinEquipo <= 20) 
{
    $porcentajeMovilPortaSinEquipo = 100;
}
elseif ($cantidadTotalProtaSinEquipo >= 21) 
{
    $porcentajeMovilPortaSinEquipo = 120;
}

$output['movil'] .= "<div class='col-xl-3 col-md-6'>";
$output['movil'] .= "<div class='card'>";
$output['movil'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesComision' onclick=detalles('p');>";
$output['movil'] .= "<div class='card-body'>";
$output['movil'] .= "<div class='head d-flex justify-content-around'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p>Portabilidad sin Equipo</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p class='primary'>$porcentajeMovilPortaSinEquipo%</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='body'>";
$output['movil'] .= "<div class='row my-2'>";
$output['movil'] .= "<h4 class='text-center warning'>$cantidadTotalProtaSinEquipo</h4>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center'>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
$output['movil'] .= "<p class='my-1 success'>S/ $comisionTotalProtaSinEquipo</p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</a>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";

// suma de renovaciones
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        if ($fecha == null)
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='2' and estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='2' and estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[0]);
        $comision = ($plan*$cantidad)*(40/100);
        $comisionTotalRenovacion = $comisionTotalRenovacion+$comision;
        $cantidadTotalRenovacion = $cantidadTotalRenovacion+$cantidad;
    }
}

$output['movil'] .= "<div class='col-xl-3 col-md-6'>";
$output['movil'] .= "<div class='card'>";
$output['movil'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesComision' onclick=detalles('r');>";
$output['movil'] .= "<div class='card-body'>";
$output['movil'] .= "<div class='head d-flex justify-content-around'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p>Renovación</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
// $output['movil'] .= "<p class='primary'>40% - 60%</p>";
$output['movil'] .= "<p class='primary'>40%</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='body'>";
$output['movil'] .= "<div class='row my-2'>";
$output['movil'] .= "<h4 class='text-center warning'>$cantidadTotalRenovacion</h4>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center'>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='col'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
$output['movil'] .= "<p class='my-1 success'>S/ $comisionTotalRenovacion</p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</a>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
     


$output['comiMovil']= 'S/ '.$comisionTotalNuevaEquipo+$comisionTotalNuevaSinEquipo+$comisionTotalProtaEquipo+$comisionTotalProtaSinEquipo+$comisionTotalRenovacion;
$output['comiFija']= 'S/ '.$comisionTotalFija;
$output['comiTotal']= 'S/ '.$comisionTotalNuevaEquipo+$comisionTotalNuevaSinEquipo+$comisionTotalProtaEquipo+$comisionTotalProtaSinEquipo+$comisionTotalRenovacion+$comisionTotalFija;
$output['c1mes']= 'S/ '.$comisionTotalNuevaEquipo+$comisionTotalProtaEquipo+$comisionTotalRenovacion+$comisionTotalFija;
$output['c3meses']= 'S/ '.$comisionTotalNuevaSinEquipo+$comisionTotalProtaSinEquipo;

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>