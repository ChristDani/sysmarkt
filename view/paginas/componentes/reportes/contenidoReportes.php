<?php
// usuarios
$user = new user();
$listUser = $user->listar();
?>
<p class="d-none" id="vt"></p>
<p class="d-none" id="vc"></p>
<p class="d-none" id="vp"></p>
<p class="d-none" id="vr"></p>

<!-- formulario para obtener la consulta de php para exportar a excel -->
<form hidden action="controller/reportes/reportexcel.php" method="post">
    <input type="date" name="busquedareportefechaventa" id="busquedareportefechaventa">
    <input type="text" name="busquedareportemoderadorventa" id="busquedareportemoderadorventa">
    <input type="text" name="busquedareporteasesorventa" id="busquedareporteasesorventa">
    <input type="text" name="busquedareporteestadoventa" id="busquedareporteestadoventa">
    <input type="text" name="busquedareporteventa" id="busquedareporteventa">
    <input id="btngenerarreporteventas" name="btngenerarreporteventas" type="submit" value="send">
</form>

<div class="d-flex gap-3 align-items-start">
    <h1>REPORTES</h1>
    <input type="date" class="form-control-sm " name="fecharequerida" id="fecharequerida">
</div>

<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="bare row d-flex justify-content-center align-items-center">
                    <div class="col d-flex justify-content-start align-items-center">
                        <div class="d-flex justify-content-center align-items-baseline">
                            <p class="mx-1" for="numRegistrosRM">Mostrar</p>
                            <select name="numRegistrosRM" id="numRegistrosRM" class="mx-1 form-select" aria-label="Default select example">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <p class="mx-1" for="numRegistrosRM">Registros</p>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center">
                        <label for="btngenerarreporteventas" class="btn success-bg">
                            <div>EXCEL</div>
                        </label>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <div class="form-floating">
                            <select class="form-select" aria-label="Floating label select example" name="busquedaxmoderadormetas" id="busquedaxmoderadormetas">
                                <option value="">Todos</option>
                                <?php if ($listar != null) 
                                        {
                                            foreach ($listar as $x) 
                                            { 
                                                if ($x[3] == "2") 
                                                { ?>
                                                <option value="<?php echo $x[0]; ?>"><?php echo $x[1]; ?></option>
                                    <?php       }
                                            }
                                        }?>
                            </select>
                            <label for="busquedaxmoderadormetas">Moderadores</label>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <div class="form-floating">
                            <select class="form-select" aria-label="Floating label select example" name="busquedaxasesormetas" id="busquedaxasesormetas">
                                
                            </select>
                            <label for="busquedaxasesormetas">Asesores</label>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <div class="form-floating">
                            <select class="form-select" aria-label="Floating label select example" name="busquedaestadoRM" id="busquedaestadoRM">
                                <option value="">Todos</option>
                                <option value="0">En Proceso</option>
                                <option value="1">Cerradas</option>
                            </select>
                            <label for="busquedaestadoRM">Estado</label>
                        </div>
                    </div> 
                    <div class="col d-flex justify-content-end align-items-center">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="busquedaRM" placeholder="Buscar" onkeyup="getDataRM(1);ahsdgjahdgasd();pasardatorv();">
                            <label for="busquedaRM">Buscar SEC</label>
                        </div>
                    </div>
                </div>
                <table class="table table-responsive-lg color">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">N??</th>
                            <th scope="col">Asesor</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">SEC</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Registro</th>
                            <th scope="col">Productos</th>
                            <th scope="col">Detalles</th>
                        </tr>
                    </thead>
                    <tbody id="resultadosRM">
                        
                    </tbody>
                </table>
                <div class="bare row d-flex justify-content-between">
                    <div id="munRM" class="col">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5" id="graficosfeos">    
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-container" style="position: relative; height:50%; width:100%">
                    <canvas id="pie"></canvas>
                </div>
            </div>
        </div>
    </div>   

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-container" style="position: relative; height:45%; width:100%">
                    <canvas id="bar"></canvas>
                </div>  
            </div>
        </div>
    </div>
</div>

<?php include_once "modaldetallereportemes.php"; ?>

<script src="controller/reportes/listar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="controller/reportes/estadisticas.js"></script>
<script src="controller/reportes/modal.js"></script>

<script>
    document.getElementById('fecharequerida').addEventListener("change", function() {
        pasardatorv()
    }, false)

    document.getElementById('busquedaestadoRM').addEventListener("change", function() {
        pasardatorv()
    }, false)

    document.getElementById('busquedaxasesormetas').addEventListener("change", function() {
        pasardatorv()
    }, false)

    document.getElementById('busquedaxmoderadormetas').addEventListener("change", function() {
        pasardatorv()
    }, false)

    function pasardatorv() 
    {
        busquedafecha = document.getElementById('fecharequerida').value;
        busquedaasesor = document.getElementById('busquedaxasesormetas').value;
        busquedamoderador = document.getElementById('busquedaxmoderadormetas').value;
        busquedaestado = document.getElementById('busquedaestadoRM').value;
        busqueda = document.getElementById('busquedaRM').value;

        busquereportfecha = document.getElementById('busquedareportefechaventa');
        busquereportasesor = document.getElementById('busquedareporteasesorventa');
        busquereportmoderador = document.getElementById('busquedareportemoderadorventa');
        busquereportestado = document.getElementById('busquedareporteestadoventa');
        busquereport = document.getElementById('busquedareporteventa');

        busquereportfecha.value = busquedafecha;
        busquereportasesor.value = busquedaasesor;
        busquereportmoderador.value = busquedamoderador;
        busquereportestado.value = busquedaestado;
        busquereport.value = busqueda;
    }
</script>