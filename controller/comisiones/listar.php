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
$dniAsesor= !empty($_POST['dniasesor']) ? $_POST['dniasesor'] : '73179455';


$output=[];
$output['movil']= '';
$output['fija']= '';

if ($planesFija != null) 
{
    foreach ($planesFija as $pr) 
    {
        $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniAsesor and planFija='".trim($pr[0])."' and estado='1'";
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', substr($pr[0],10));
        $comisionFija = ($plan*$cantidad)*($porcentajeFija/100);

        $output['fija'] .= "<div class='col-xl-3 col-md-6'>";
        $output['fija'] .= "<div class='card'>";
        $output['fija'] .= "<div class='card-body'>";
        $output['fija'] .= "<div class='head d-flex justify-content-around'>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p>".$pr[0]."</p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "<p class='warning'>$porcentajeFija%</p>";
        $output['fija'] .= "<p></p>";
        $output['fija'] .= "</div>";
        $output['fija'] .= "<div class='body'>";
        $output['fija'] .= "<div class='row my-2'>";
        $output['fija'] .= "<h4 class='text-center'>$cantidad</h4>";
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


echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>














































































<?php

// $abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];
// $comisionTotalMovil = 0;
// $comisionTotalFija = 0;

// $porcentajeFija = 50;

// // planes
// $planeslist = new planes;
// $planesMov = $planeslist->listar();
// $planesFija = $planeslist->listarFija();

// if ($planesMov != null) 
// {
//     foreach ($planesMov as $pr) 
//     {
//         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planR='".trim($pr[0])."' and estado='1'";
//         $resultado = mysqli_query($consulta,$sql);
//         $cantidad = $resultado->num_rows;

//         if ($cantidad >= 0 and $cantidad <= 10) 
//         {
//             $porcentajeMovil = 60;
//         }
//         elseif ($cantidad >= 11 and $cantidad <= 15) 
//         {
//             $porcentajeMovil = 80;
//         }
//         elseif ($cantidad >= 16 and $cantidad <= 20) 
//         {
//             $porcentajeMovil = 100;
//         }
//         elseif ($cantidad >= 21) 
//         {
//             $porcentajeMovil = 120;
//         }

//         $plan = str_replace($abecedario, '', $pr[0]);
//         $comi = ($plan*$cantidad)*($porcentajeMovil/100);
//         $comisionTotalMovil = $comisionTotalMovil+$comi;
//     }
// }
// if ($planesFija != null) 
// {
//     foreach ($planesFija as $pr) 
//     {
//         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planFija='".trim($pr[0])."' and estado='1'";
//         $resultado = mysqli_query($consulta,$sql);
//         $cantidad = $resultado->num_rows;

//         $plan = str_replace($abecedario, '', substr($pr[0],10));
//         $comiF = ($plan*$cantidad)*($porcentajeFija/100);
//         $comisionTotalFija = $comisionTotalFija+$comiF;
//     }
// }

// $comisionTotal = $comisionTotalMovil+$comisionTotalFija;
?>
<!-- <div class="d-flex gap-3 align-items-start">
    <h1>Comisiones del Mes</h1>
    <input type="date" class="form-control-sm " name="fecharequerida" id="fecharequerida">
    <h1 class='success' id="comisionTotalMovil">S/ <?php //echo $comisionTotal; ?></h1>
</div>

<h1>Movil - <span class='success' id="comisionTotalMovil">S/ <?php //echo $comisionTotalMovil; ?></span></h1>
<div class="row mb-4">
    <?php
        // if ($planesMov != null) 
        // {
        //     foreach ($planesMov as $pr) 
        //     {
        //         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planR='".trim($pr[0])."' and estado='1'";
        //         $resultado = mysqli_query($consulta,$sql);
        //         $cantidad = $resultado->num_rows;

        //         if ($cantidad >= 0 and $cantidad <= 10) 
        //         {
        //             $porcentajeMovil = 60;
        //         }
        //         elseif ($cantidad >= 11 and $cantidad <= 15) 
        //         {
        //             $porcentajeMovil = 80;
        //         }
        //         elseif ($cantidad >= 16 and $cantidad <= 20) 
        //         {
        //             $porcentajeMovil = 100;
        //         }
        //         elseif ($cantidad >= 21) 
        //         {
        //             $porcentajeMovil = 120;
        //         }

        //         $plan = str_replace($abecedario, '', $pr[0]);
        //         $comision = ($plan*$cantidad)*($porcentajeMovil/100);
                ?>
                <div class='col-xl-3 col-md-6'>
                <div class='card'>
                <div class='card-body'>
                <div class='head d-flex justify-content-around'>
                <p></p>
                <p><?php //echo $pr[0]; ?></p>
                <p></p>
                <p></p>
                <p></p>
                <p class="warning"><?php //echo $porcentajeMovil; ?>%</p>
                <p></p>
                </div>
                <div class='body'>
                <div class='row my-2'>
                <h4 class='text-center'><?php //echo $cantidad; ?></h4>
                </div>
                <div class='row text-center'>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                </div>
                <div class='row text-center' style='border-top: 1px solid #b9b9b9;'>
                <p class='my-1 success'>S/ <?php //echo $comision; ?></p>
                </div>
                </div>
                </div>
                </div>
                </div>
    <?php   //}
        // }
    ?>
</div>

<h1>Fija - <span class='success' id="comisionTotalFija">S/ <?php //echo $comisionTotalFija; ?></span></h1>
<div class="row mb-4">
    <?php
        // if ($planesFija != null) 
        // {
        //     foreach ($planesFija as $pr) 
        //     {
        //         $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planFija='".trim($pr[0])."' and estado='1'";
        //         $resultado = mysqli_query($consulta,$sql);
        //         $cantidad = $resultado->num_rows;

        //         $plan = str_replace($abecedario, '', substr($pr[0],10));
        //         $comisionFija = ($plan*$cantidad)*($porcentajeFija/100);
                ?>
                <div class='col-xl-3 col-md-6'>
                <div class='card'>
                <div class='card-body'>
                <div class='head d-flex justify-content-around'>
                <p></p>
                <p><?php //echo $pr[0]; ?></p>
                <p></p>
                <p></p>
                <p></p>
                <p class="warning"><?php //echo $porcentajeFija; ?>%</p>
                <p></p>
                </div>
                <div class='body'>
                <div class='row my-2'>
                <h4 class='text-center'><?php //echo $cantidad; ?></h4>
                </div>
                <div class='row text-center'>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                <div class='col'>
                <p></p>
                </div>
                </div>
                <div class='row text-center' style='border-top: 1px solid #b9b9b9;'>
                <p class='my-1 success'>S/ <?php //echo $comisionFija; ?></p>
                </div>
                </div>
                </div>
                </div>
                </div>
    <?php   //}
        // }
    ?>
</div> -->