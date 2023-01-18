<h1>DASHBOARD</h1>

<?php if ($tipoUsuario === "1" || $tipoUsuario === "2") { ?>

<h3>Ventas Totales</h3>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <ion-icon name="person-circle-outline"></ion-icon>                                  
                <h3>Gestion Total</h3>
                <h1><?php echo $ventasTotales; ?></h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mb-4">
            <div class="card-body warning-bg wait">
                <ion-icon name="alert-circle-outline"></ion-icon>
                <h3>Pendientes</h3>
                <h1><?php echo $ventasPendientes; ?></h1>
            </div>    
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mb-4">
            <div class="card-body success-bg income">
                <ion-icon name="arrow-up-circle-outline"></ion-icon>
                <h3>Concretados</h3>
                <h1><?php echo $ventasConcretadas; ?></h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mb-4">
            <div class="card-body danger-bg expenses">
                <ion-icon name="arrow-down-circle-outline"></ion-icon>
                <h3>Rechazados</h3>
                <h1><?php echo $ventasRechazadas; ?></h1>
            </div>
        </div>
    </div>                            
</div>

<?php } ?>

<?php
if ($tipoUsuario === "0" || $tipoUsuario === "1") 
{ 
if ($listar != null) 
{
    foreach ($listar as $x) 
    {
        if ($x[0] === $dniUsuario) 
        {
            //ventas totales asesor
            $sqla = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP))";
            // echo $sqla;
            $resultadoa = mysqli_query($consulta,$sqla);
            $ventasTotalesAsesor = $resultadoa->num_rows;
            // ventas rechazadas asesor
            $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='0'";
            $resultado3 = mysqli_query($consulta,$sql3);
            $ventasRechazadasAsesor = $resultado3->num_rows;
            // ventas concretadas asesor
            $sql1 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1'";
            $resultado1 = mysqli_query($consulta,$sql1);
            $ventasConcretadasAsesor = $resultado1->num_rows;
            // ventas pendientes asesor
            $sql2 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='2'";
            $resultado2 = mysqli_query($consulta,$sql2);
            $ventasPendientesAsesor = $resultado2->num_rows;
?>
            
            <h3>Tus Ventas</h3>
            
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <ion-icon name="person-circle-outline"></ion-icon>                                  
                            <h3>Gestion Total</h3>
                            <h1><?php echo $ventasTotalesAsesor ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body warning-bg wait">
                            <ion-icon name="alert-circle-outline"></ion-icon>
                            <h3>Pendientes</h3>
                            <h1><?php echo $ventasPendientesAsesor ?></h1>
                        </div>    
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body success-bg income">
                            <ion-icon name="arrow-up-circle-outline"></ion-icon>
                            <h3>Concretados</h3>
                            <h1><?php echo $ventasConcretadasAsesor ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4">
                        <div class="card-body danger-bg expenses">
                            <ion-icon name="arrow-down-circle-outline"></ion-icon>
                            <h3>Rechazados</h3>
                            <h1><?php echo $ventasRechazadasAsesor ?></h1>
                        </div>
                    </div>
                </div>                            
            </div>
<?php
        }
    }
}
}

if ($tipoUsuario === "1") 
{ 

    if ($listar != null) 
    {
        foreach ($listar as $x) 
        {
            if ($x[0] !== $dniUsuario && $x[3] === "0") 
            {
                //ventas totales asesor
                $sqla = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP))";
                // echo $sqla;
                $resultadoa = mysqli_query($consulta,$sqla);
                $ventasTotalesAsesor = $resultadoa->num_rows;
                // ventas rechazadas asesor
                $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='0'";
                $resultado3 = mysqli_query($consulta,$sql3);
                $ventasRechazadasAsesor = $resultado3->num_rows;
                // ventas concretadas asesor
                $sql1 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1'";
                $resultado1 = mysqli_query($consulta,$sql1);
                $ventasConcretadasAsesor = $resultado1->num_rows;
                // ventas pendientes asesor
                $sql2 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='2'";
                $resultado2 = mysqli_query($consulta,$sql2);
                $ventasPendientesAsesor = $resultado2->num_rows;
?>

                <h3>Ventas del Asesor(a) <?php echo $x[1] ?></h3>
                
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <ion-icon name="person-circle-outline"></ion-icon>                                  
                                <h3>Gestion Total</h3>
                                <h1><?php echo $ventasTotalesAsesor ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body warning-bg wait">
                                <ion-icon name="alert-circle-outline"></ion-icon>
                                <h3>Pendientes</h3>
                                <h1><?php echo $ventasPendientesAsesor ?></h1>
                            </div>    
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body success-bg income">
                                <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                <h3>Concretados</h3>
                                <h1><?php echo $ventasConcretadasAsesor ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body danger-bg expenses">
                                <ion-icon name="arrow-down-circle-outline"></ion-icon>
                                <h3>Rechazados</h3>
                                <h1><?php echo $ventasRechazadasAsesor ?></h1>
                            </div>
                        </div>
                    </div>                            
                </div>
<?php
            }
        }
    }
}
if ($tipoUsuario === "2") 
{ 
    if ($listar != null) 
    {
        foreach ($listar as $x) 
        {
            if ($x[0] !== $dniUsuario && $x[3] === "0" && $x[8] === $dniUsuario) 
            {
                //ventas totales asesor
                $sqla = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP))";
                // echo $sqla;
                $resultadoa = mysqli_query($consulta,$sqla);
                $ventasTotalesAsesor = $resultadoa->num_rows;
                // ventas rechazadas asesor
                $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='0'";
                $resultado3 = mysqli_query($consulta,$sql3);
                $ventasRechazadasAsesor = $resultado3->num_rows;
                // ventas concretadas asesor
                $sql1 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1'";
                $resultado1 = mysqli_query($consulta,$sql1);
                $ventasConcretadasAsesor = $resultado1->num_rows;
                // ventas pendientes asesor
                $sql2 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where v.dniAsesor='".$x[0]."' and (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='2'";
                $resultado2 = mysqli_query($consulta,$sql2);
                $ventasPendientesAsesor = $resultado2->num_rows;
?>
                <?php if ($x[3] === "1") { ?>
                    <h3>Ventas del Administrador <?php echo $x[1] ?></h3>
                <?php }elseif ($x[3] === "0") { ?>
                    <h3>Ventas del Asesor <?php echo $x[1] ?></h3>
                <?php }elseif ($x[3] === "2") { ?>
                    <h3>Ventas del Moderador <?php echo $x[1] ?></h3>
                <?php } ?>
                
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <ion-icon name="person-circle-outline"></ion-icon>                                  
                                <h3>Gestion Total</h3>
                                <h1><?php echo $ventasTotalesAsesor ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body warning-bg wait">
                                <ion-icon name="alert-circle-outline"></ion-icon>
                                <h3>Pendientes</h3>
                                <h1><?php echo $ventasPendientesAsesor ?></h1>
                            </div>    
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body success-bg income">
                                <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                <h3>Concretados</h3>
                                <h1><?php echo $ventasConcretadasAsesor ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body danger-bg expenses">
                                <ion-icon name="arrow-down-circle-outline"></ion-icon>
                                <h3>Rechazados</h3>
                                <h1><?php echo $ventasRechazadasAsesor ?></h1>
                            </div>
                        </div>
                    </div>                            
                </div>
<?php
            }
        }
    }
}
