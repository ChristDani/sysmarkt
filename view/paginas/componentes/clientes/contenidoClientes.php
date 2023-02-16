<!-- formulario para obtener la consulta de php para exportar a excel -->
<form hidden action="controller/clientes/reportexcel.php" method="post">
    <input type="text" name="busquedaclientereportes" id="busquedaclientereportes">
    <input id="btngenerarreporteclientes" name="btngenerarreporteclientes" type="submit" value="send">
</form>

<h1>CLIENTES</h1>

<div class="card">
    <div class="bare row d-flex justify-content-center align-items-center">
        <div class="col d-flex justify-content-start align-items-center">
            <div class="d-flex justify-content-center align-items-baseline">
                <p class="mx-1" for="numRegistrosClientes">Mostrar</p>
                <select name="numRegistrosClientes" id="numRegistrosClientes" class="mx-1 form-select" aria-label="Default select example">
                    <option value="12">12</option>
                    <option value="28">28</option>
                    <option value="52">52</option>
                    <option value="100">100</option>
                </select>
                <p class="mx-1" for="numRegistrosClientes">Registros</p>
            </div>
        </div>
        <div class="col d-flex justify-content-between align-items-center">
            <a href="#" class="color" type="button" data-bs-toggle="modal" data-bs-target="#AgregarCliente">
                <ion-icon name="add-circle-outline"></ion-icon>
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <label for="btngenerarreporteclientes" class="btn success-bg">
                <div>EXCEL</div>
            </label>
        </div>
        <div class="col d-flex justify-content-end align-items-center">
            <div class="form-floating">
                <input type="text" class="form-control" id="busquedaCliente" placeholder="Buscar" onkeyup="getDataClientes(1);pasardatorc();">
                <label for="busquedaCliente">Buscar</label>
            </div>
        </div>
    </div>

    <div class="row mb-4" id="resultadosClientes">
        
    </div>

    <div class="bare row d-flex justify-content-between mb-3">
        <div id="munClientes" class="col">

        </div>
    </div>
    
</div>

<input hidden type="text" id="tipouser" value="<?php echo $tipoUsuario ; ?>">

<?php include_once "contenidoModalAgregarClientes.php"; ?>
<?php include_once "contenidoModalDetalleClientes.php"; ?>

<script src="controller/clientes/listar.js"></script>  
<script src="controller/clientes/validaciones.js"></script>
<script>
    function pasardatorc() 
    {
        let busqueda = document.getElementById('busquedaCliente').value;

        let formulario = document.getElementById('busquedaclientereportes');

        formulario.value = busqueda;
    }
</script>