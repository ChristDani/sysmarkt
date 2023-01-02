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
$tipo= !empty($_POST['tipo']) ? $_POST['tipo'] : null;

$output=[];
$output['data']= '';

$comisiontotal = 0;

if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        if ($fecha == null)
        {
            if ($tipo == 'lne') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and equipo!='Chip' and planR='".trim($pr[0])."' and tipo='0' and estado='1'";
            }
            elseif ($tipo == 'ln') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and equipo='Chip' and planR='".trim($pr[0])."' and tipo='0' and estado='1'";
            }
            elseif ($tipo == 'pe') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and equipo!='Chip' and planR='".trim($pr[0])."' and tipo='1' and estado='1'";
            }
            elseif ($tipo == 'p') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and equipo='Chip' and planR='".trim($pr[0])."' and tipo='1' and estado='1'";
            }
            elseif ($tipo == 'r') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='2' and estado='1'";
            }
        }
        elseif ($fecha != null) 
        {
            if ($tipo == 'lne') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and equipo!='Chip' and tipo='0' and estado='1'";
            }
            elseif ($tipo == 'ln') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and equipo='Chip' and tipo='0' and estado='1'";
            }
            elseif ($tipo == 'pe') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and equipo!='Chip' and tipo='1' and estado='1'";
            }
            elseif ($tipo == 'p') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and equipo='Chip' and tipo='1' and estado='1'";
            }
            elseif ($tipo == 'r') 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month($fecha) and year(fechaRegistro)=year($fecha)) and dniAsesor like '%$dniAsesor%' and planR='".trim($pr[0])."' and tipo='2' and estado='1'";
            }
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

        if ($tipo == 'lne' or $tipo == 'ln') 
        {
            $comision = ($plan*$cantidad)*(50/100);
        }
        elseif ($tipo == 'pe' or $tipo == 'p') 
        {
            $comision = ($plan*$cantidad)*($porcentajeMovil/100);
        }
        elseif ($tipo == 'r') 
        {
            $comision = ($plan*$cantidad)*(40/100);
        }

        $comisiontotal = $comisiontotal+$comision;
        
        $output['data'] .= "<div class='col-xl-6 col-md-6'>";
        $output['data'] .= "<div class='card'>";
        $output['data'] .= "<div class='card-body'>";
        $output['data'] .= "<div class='head d-flex justify-content-around'>";
        $output['data'] .= "<p></p>";
        $output['data'] .= "<p>$pr[0]</p>";
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