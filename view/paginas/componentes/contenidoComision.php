<?php
require_once "model/conexion.php";
require_once 'model/planes.php';

$abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];
$comisionTotalMovil = 0;
$porcentaje = 80;

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();
$planesFija = $planeslist->listarFija();

if ($planesMov != null) 
{
    foreach ($planesMov as $pr) 
    {
        $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planR='".trim($pr[0])."' and estado='1'";
        $resultado = mysqli_query($consulta,$sql);
        $cantidad = $resultado->num_rows;

        $plan = str_replace($abecedario, '', $pr[0]);
        $comi = ($plan*$cantidad)*($porcentaje/100);
        $comisionTotalMovil = $comisionTotalMovil+$comi;
    }
}
?>
<div class="d-flex gap-3 align-items-start">
    <h1>Comisiones del Mes</h1>
    <!-- <input type="date" class="form-control-sm " name="fecharequerida" id="fecharequerida"> -->
</div>

<h1>Movil - <span class='success' id="comisionTotal">S/ <?php echo $comisionTotalMovil; ?></span></h1>
<div class="row mb-4">
    <?php
        if ($planesMov != null) 
        {
            foreach ($planesMov as $pr) 
            {
                $sql = "select * from whatsapp where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) and dniAsesor=$dniUsuario and planR='".trim($pr[0])."' and estado='1'";
                $resultado = mysqli_query($consulta,$sql);
                $cantidad = $resultado->num_rows;

                $plan = str_replace($abecedario, '', $pr[0]);
                $comision = ($plan*$cantidad)*($porcentaje/100);
                ?>
                <div class='col-xl-3 col-md-6'>
                <div class='card'>
                <div class='card-body'>
                <div class='head d-flex justify-content-around'>
                <p></p>
                <p><?php echo $pr[0]; ?></p>
                <p></p>
                <p></p>
                <p></p>
                <p><?php echo $cantidad; ?></p>
                <p></p>
                </div>
                <div class='body'>
                <div class='row my-2'>
                <h4 class='text-center'></h4>
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
                <p class='my-1 success'>S/ <?php echo $comision; ?></p>
                </div>
                </div>
                </div>
                </div>
                </div>
    <?php   }
        }
    ?>
</div>

<h1>Fija - <span>Comision total</span></h1>
<div class="row mb-4">
    <?php
        if ($planesFija != null) 
        {
            foreach ($planesFija as $pr) 
            {?>
                <div class='col-xl-3 col-md-6'>
                <div class='card'>
                <div class='card-body'>
                <div class='head d-flex justify-content-around'>
                <p></p>
                <p><?php echo $pr[0]; ?></p>
                <p></p>
                <p></p>
                <p></p>
                <p>5</p>
                <p></p>
                </div>
                <div class='body'>
                <div class='row my-2'>
                <h4 class='text-center'></h4>
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
                <p class='my-1 success'>comision</p>
                </div>
                </div>
                </div>
                </div>
                </div>
    <?php   }
        }
    ?>
</div>