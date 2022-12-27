<?php
require_once 'model/planes.php';

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();
$planesFija = $planeslist->listarFija();
?>
<div class="d-flex gap-3 align-items-start">
    <h1>Comisiones del Mes</h1>
    <input type="date" class="form-control-sm " name="fecharequerida" id="fecharequerida">
</div>

<h1>Movil - <span>S/ 1200.00</span></h1>
<div class="row mb-4">
    <?php
        if ($planesMov != null) 
        {
            foreach ($planesMov as $pr) 
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
                <p>80%</p>
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
                <p>80%</p>
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