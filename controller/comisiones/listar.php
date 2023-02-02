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
$dniModerador= !empty($_POST['dnimoderador']) ? $_POST['dnimoderador'] : null;


$output=[];
$output['movil']= '';
$output['fija']= '';

$comisionTotalFija = 0;

// suma de fijas
if ($planesFija != null) 
{
    foreach ($planesFija as $pr) 
    {
        $p = trim($pr[1]);
        if ($fecha == null)
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='0' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.planFija='$p' and dv.estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='0' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.planFija='$p' and dv.estado='1'";
        }

        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', substr($pr[1],10));
        $comisionFija = ($plan*$cantidad)*($porcentajeFija/100);
        $comisionTotalFija = $comisionTotalFija+$comisionFija;

        $output['fija'] .= "<div class='col-xl-3 col-md-6'>";
        $output['fija'] .= "<div class='card'>";
        $output['fija'] .= "<div class='card-body'>";
        $output['fija'] .= "<div class='head d-flex justify-content-around'>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p>".$pr[1]."</p>";
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

$comisionTotalRenovacionDesc = 0;
$cantidadTotalRenovacionDesc = 0;

$comisionTotalRenovacionAsc = 0;
$cantidadTotalRenovacionAsc = 0;

$cantidadTotalProta = 0;
if ($fecha == null)
{
    $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.tipo='1' and dv.modalidad='1' and dv.estado='1'";
}
elseif ($fecha != null) 
{
    $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.tipo='1' and dv.modalidad='1' and dv.estado='1'";
}

$resultado = mysqli_query($consulta,$sql);
$cantidadTotalProta = $resultado->num_rows;

if ($cantidadTotalProta >= 0 and $cantidadTotalProta <= 10) 
{
    $porcentajeMovilPrt = 60;
}
elseif ($cantidadTotalProta >= 11 and $cantidadTotalProta <= 15) 
{
    $porcentajeMovilPrt = 80;
}
elseif ($cantidadTotalProta >= 16 and $cantidadTotalProta <= 20) 
{
    $porcentajeMovilPrt = 100;
}
elseif ($cantidadTotalProta >= 21) 
{
    $porcentajeMovilPrt = 120;
}

// suma de lineas nuevas con equipo
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        $pmlne = trim($pr[1]);
        if ($fecha == null)
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmlne' and dv.tipo='0' and dv.equipo!='Chip' and dv.estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmlne' and dv.tipo='0' and dv.equipo!='Chip' and dv.estado='1'";
        }

        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[1]);
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
        $pmln = trim($pr[1]);
        if ($fecha == null)
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmln' and dv.tipo='0' and dv.equipo='Chip' and dv.estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmln' and dv.tipo='0' and dv.equipo='Chip' and dv.estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[1]);
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
        $pmpe = trim($pr[1]);
        if ($fecha == null)
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmpe' and dv.tipo='1' and dv.equipo!='Chip' and dv.estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmpe' and dv.tipo='1' and dv.equipo!='Chip' and dv.estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        if ($cantidadTotalProta >= 0 and $cantidadTotalProta <= 10) 
        {
            $porcentajeMovil = 60;
        }
        elseif ($cantidadTotalProta >= 11 and $cantidadTotalProta <= 15) 
        {
            $porcentajeMovil = 80;
        }
        elseif ($cantidadTotalProta >= 16 and $cantidadTotalProta <= 20) 
        {
            $porcentajeMovil = 100;
        }
        elseif ($cantidadTotalProta >= 21) 
        {
            $porcentajeMovil = 120;
        }

        $plan = str_replace($abecedario, '', $pr[1]);
        $comision = ($plan*$cantidad)*($porcentajeMovil/100);
        $comisionTotalProtaEquipo = $comisionTotalProtaEquipo+$comision;
        $cantidadTotalProtaEquipo = $cantidadTotalProtaEquipo+$cantidad;
    }
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
$output['movil'] .= "<p class='primary'>$porcentajeMovilPrt%</p>";
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
        $pmp = trim($pr[1]);
        if ($fecha == null)
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmp' and dv.tipo='1' and dv.equipo='Chip' and dv.estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmp' and dv.tipo='1' and dv.equipo='Chip' and dv.estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        if ($cantidadTotalProta >= 0 and $cantidadTotalProta <= 10) 
        {
            $porcentajeMovil = 60;
        }
        elseif ($cantidadTotalProta >= 11 and $cantidadTotalProta <= 15) 
        {
            $porcentajeMovil = 80;
        }
        elseif ($cantidadTotalProta >= 16 and $cantidadTotalProta <= 20) 
        {
            $porcentajeMovil = 100;
        }
        elseif ($cantidadTotalProta >= 21) 
        {
            $porcentajeMovil = 120;
        }

        $plan = str_replace($abecedario, '', $pr[1]);
        $comision = ($plan*$cantidad)*($porcentajeMovil/100);
        $comisionTotalProtaSinEquipo = $comisionTotalProtaSinEquipo+$comision;
        $cantidadTotalProtaSinEquipo = $cantidadTotalProtaSinEquipo+$cantidad;
    }
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
$output['movil'] .= "<p class='primary'>$porcentajeMovilPrt%</p>";
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

// suma de renovaciones descendentes
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        $pmrd = trim($pr[1]);
        if ($fecha == null)
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmrd' and dv.tipo='2' and dv.modoReno='0' and dv.estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmrd' and dv.tipo='2' and dv.modoReno='0' and dv.estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[1]);
        $comision = ($plan*$cantidad)*(40/100);
        $comisionTotalRenovacionDesc = $comisionTotalRenovacionDesc+$comision;
        $cantidadTotalRenovacionDesc = $cantidadTotalRenovacionDesc+$cantidad;
    }
}

$output['movil'] .= "<div class='col-xl-3 col-md-6'>";
$output['movil'] .= "<div class='card'>";
$output['movil'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesComision' onclick=detalles('rd');>";
$output['movil'] .= "<div class='card-body'>";
$output['movil'] .= "<div class='head d-flex justify-content-around'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p>Renovación Descendente</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p class='primary'>40%</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='body'>";
$output['movil'] .= "<div class='row my-2'>";
$output['movil'] .= "<h4 class='text-center warning'>$cantidadTotalRenovacionDesc</h4>";
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
$output['movil'] .= "<p class='my-1 success'>S/ $comisionTotalRenovacionDesc</p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</a>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";

// suma de renovaciones ascendentes
if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        $pmra = trim($pr[1]);
        if ($fecha == null)
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmra' and dv.tipo='2' and dv.modoReno='1' and dv.estado='1'";
        }
        elseif ($fecha != null) 
        {
            $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pmra' and dv.tipo='2' and dv.modoReno='1' and dv.estado='1'";
        }
        
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[1]);
        $comision = ($plan*$cantidad)*(60/100);
        $comisionTotalRenovacionAsc = $comisionTotalRenovacionAsc+$comision;
        $cantidadTotalRenovacionAsc = $cantidadTotalRenovacionAsc+$cantidad;
    }
}

$output['movil'] .= "<div class='col-xl-3 col-md-6'>";
$output['movil'] .= "<div class='card'>";
$output['movil'] .= "<a href='#' type='button' data-bs-toggle='modal' data-bs-target='#DetallesComision' onclick=detalles('ra');>";
$output['movil'] .= "<div class='card-body'>";
$output['movil'] .= "<div class='head d-flex justify-content-around'>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p>Renovación Ascendente</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "<p class='primary'>60%</p>";
$output['movil'] .= "<p></p>";
$output['movil'] .= "</div>";
$output['movil'] .= "<div class='body'>";
$output['movil'] .= "<div class='row my-2'>";
$output['movil'] .= "<h4 class='text-center warning'>$cantidadTotalRenovacionAsc</h4>";
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
$output['movil'] .= "<p class='my-1 success'>S/ $comisionTotalRenovacionAsc</p>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
$output['movil'] .= "</a>";
$output['movil'] .= "</div>";
$output['movil'] .= "</div>";
     


$output['comiMovil']= 'S/ '.$comisionTotalNuevaEquipo+$comisionTotalNuevaSinEquipo+$comisionTotalProtaEquipo+$comisionTotalProtaSinEquipo+$comisionTotalRenovacionDesc+$comisionTotalRenovacionAsc;
$output['comiFija']= 'S/ '.$comisionTotalFija;
$output['comiTotal']= 'S/ '.$comisionTotalNuevaEquipo+$comisionTotalNuevaSinEquipo+$comisionTotalProtaEquipo+$comisionTotalProtaSinEquipo+$comisionTotalRenovacionDesc+$comisionTotalRenovacionAsc+$comisionTotalFija;
$output['c1mes']= 'S/ '.$comisionTotalNuevaEquipo+$comisionTotalProtaEquipo+$comisionTotalRenovacionDesc+$comisionTotalRenovacionAsc+$comisionTotalFija;
$output['c3meses']= 'S/ '.$comisionTotalNuevaSinEquipo+$comisionTotalProtaSinEquipo;

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>