<?php
require_once "../../model/conexion.php";
require_once "../../model/planes.php";

$model=new conexion();
$consulta=$model->conectar();

$abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();

$fecha= !empty($_POST['fecha']) ? $_POST['fecha'] : null;
$dniAsesor= !empty($_POST['dniasesor']) ? $_POST['dniasesor'] : null;
$dniModerador= !empty($_POST['dnimoderador']) ? $_POST['dnimoderador'] : null;
$tipo= !empty($_POST['tipo']) ? $_POST['tipo'] : null;

$output=[];
$output['data']= '';

$comisiontotal = 0;

if ($fecha == null)
{
    $sqlptm = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.tipo='1' and dv.estado='1'";
}
elseif ($fecha != null) 
{
    $sqlptm = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.tipo='1' and dv.estado='1'";
}

$resultadoptm = mysqli_query($consulta,$sqlptm);
$cantidadptm = $resultadoptm->num_rows;

if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        $pl = trim($pr[1]);
        if ($fecha == null)
        {
            if ($tipo == 'lne') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.equipo!='Chip' and dv.plan='$pl' and dv.tipo='0' and dv.estado='1'";
            }
            elseif ($tipo == 'ln') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.equipo='Chip' and dv.plan='$pl' and dv.tipo='0' and dv.estado='1'";
            }
            elseif ($tipo == 'pe') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.equipo!='Chip' and dv.plan='$pl' and dv.tipo='1' and dv.estado='1'";
            }
            elseif ($tipo == 'p') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.equipo='Chip' and dv.plan='$pl' and dv.tipo='1' and dv.estado='1'";
            }
            elseif ($tipo == 'rd') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.tipo='2' and dv.estado='1'";
            }
            elseif ($tipo == 'ra') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.tipo='2' and dv.estado='1'";
            }
        }
        elseif ($fecha != null) 
        {
            if ($tipo == 'lne') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.equipo!='Chip' and dv.tipo='0' and dv.estado='1'";
            }
            elseif ($tipo == 'ln') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.equipo='Chip' and dv.tipo='0' and dv.estado='1'";
            }
            elseif ($tipo == 'pe') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.equipo!='Chip' and dv.tipo='1' and dv.estado='1'";
            }
            elseif ($tipo == 'p') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.equipo='Chip' and dv.tipo='1' and dv.estado='1'";
            }
            elseif ($tipo == 'rd') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.tipo='2' and dv.estado='1'";
            }
            elseif ($tipo == 'ra') 
            {
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month('$fecha') and year(dv.registro)=year('$fecha')) and dv.producto='1' and v.dniAsesor like '%$dniAsesor%' and u.dniModerador like '%$dniModerador%' and dv.plan='$pl' and dv.tipo='2' and dv.estado='1'";
            }
        }

        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        if ($cantidadptm >= 0 and $cantidadptm <= 10) 
        {
            $porcentajeMovil = 60;
        }
        elseif ($cantidadptm >= 11 and $cantidadptm <= 15) 
        {
            $porcentajeMovil = 80;
        }
        elseif ($cantidadptm >= 16 and $cantidadptm <= 20) 
        {
            $porcentajeMovil = 100;
        }
        elseif ($cantidadptm >= 21) 
        {
            $porcentajeMovil = 120;
        }

        $plan = str_replace($abecedario, '', $pr[1]);

        if ($tipo == 'lne' or $tipo == 'ln') 
        {
            $comision = ($plan*$cantidad)*(50/100);
        }
        elseif ($tipo == 'pe' or $tipo == 'p') 
        {
            $comision = ($plan*$cantidad)*($porcentajeMovil/100);
        }
        elseif ($tipo == 'rd') 
        {
            $comision = ($plan*$cantidad)*(40/100);
        }
        elseif ($tipo == 'ra') 
        {
            $comision = ($plan*$cantidad)*(60/100);
        }

        $comisiontotal = $comisiontotal+$comision;
        
        $output['data'] .= "<div class='col-xl-6 col-md-6'>";
        $output['data'] .= "<div class='card'>";
        $output['data'] .= "<div class='card-body'>";
        $output['data'] .= "<div class='head d-flex justify-content-around'>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p>$pl</p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p class='primary'>$porcentajeMovil%</p>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='body'>";
        $output['data'] .= "<div class='row my-2'>";
        $output['data'] .= "<h4 class='text-center warning'>$cantidad</h4>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='row text-center'>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='col'>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "<div class='row text-center' style='border-top: 1px solid #b9b9b9;'>";
        $output['data'] .= "<p class='my-1 success'>S/ $comision</p>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
    }
}

$output['total'] = "S/ ".$comisiontotal;
        
echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>