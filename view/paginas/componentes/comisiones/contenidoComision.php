<input hidden type="text" id="dniasesor" value="<?php echo $dniUsuario ; ?>">
<input hidden type="text" id="dnimoderador" value="<?php echo $dniUsuario ; ?>">
<input hidden type="text" id="tipoasesor" value="<?php echo $tipoUsuario ; ?>">

<div class="d-flex gap-3 align-items-start">
    <h1>Comisiones del Mes</h1>
    <input type="date" class="form-control-sm " name="fechacomision" id="fechacomision">
    <h1 class='success' id="comisionTotal"></h1>
</div>
<div class="d-flex gap-3 align-items-start">
    <h3> // Al Siguiente Mes</h3>
    <h3 class='success' id="comision1mes"></h3>
    <h3> // Al Tercer Mes</h3>
    <h3 class='success' id="comision3meses"></h3>
</div>

<h1>Movil - <span class='success' id="comisionTotalMovil"></span></h1>
<div class="row mb-4" id= "contenidoMovilComision">

</div>

<h1>Fija - <span class='success' id="comisionTotalFija"></span></h1>
<div class="row mb-4" id= "contenidoFijaComision">

</div>

<?php include_once "detallesComision.php"; ?>
<script src="controller/comisiones/listar.js"></script>
