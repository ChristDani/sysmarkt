<h1>VENTAS</h1>

<div class="card">
<div class="bare row d-flex justify-content-center align-items-center">
    <div class="col d-flex justify-content-start align-items-center">
        <div class="d-flex justify-content-center align-items-baseline">
            <p class="mx-1" for="numRegistrosVenta">Mostrar</p>
            <select name="numRegistrosVenta" id="numRegistrosVenta" class="mx-1 form-select" aria-label="Default select example">
                <option value="12">12</option>
                <option value="28">28</option>
                <option value="52">52</option>
                <option value="100">100</option>
            </select>
            <p class="mx-1" for="numRegistrosVenta">Registros</p>
        </div>
    </div>
    <div class="col d-flex justify-content-between align-items-center">
        <a href="#" class="primary" type="button" data-bs-toggle="modal" data-bs-target="#AgregarVenta">
            <ion-icon name="add-circle-outline"></ion-icon>
        </a>
    </div>
    <?php if ($tipoUsuario === "1" || $tipoUsuario === "2") {?>
        <div class="col d-flex justify-content-end align-items-center">
            <div class="form-floating">
                <select class="form-select" aria-label="Floating label select example" name="busquedaxasesor" id="busquedaxasesor">
                    <option value="">Todos</option>
                    <?php if ($listar != null) 
                            {
                                foreach ($listar as $x) 
                                {?>
                                    <option value="<?php echo $x[0]; ?>"><?php echo $x[1]; ?></option>
                            <?php
                                }
                            }?>
                </select>
                <label for="busquedaxasesor">Asesores</label>
            </div>
        </div>
    <?php } ?>
    <div class="col d-flex justify-content-end align-items-center">
        <div class="form-floating">
            <select class="form-select" aria-label="Floating label select example" name="busquedaestadoventa" id="busquedaestadoventa">
                <option value="">Todos</option>
                <option value="0">En Curso</option>
                <option value="1">Cerradas</option>
            </select>
            <label for="busquedaestadoventa">Estado</label>
        </div>
    </div> 
    <div class="col d-flex justify-content-end align-items-center">
        <div class="form-floating">
            <select class="form-select" aria-label="Floating label select example" name="busquedaVenta" id="busquedaVenta">
                <option value="">Todos</option>
                <?php if ($listCliente != null) 
                        {
                            foreach ($listCliente as $c) 
                            {?>
                                <option value="<?php echo $c[0]; ?>"><?php echo $c[1]; ?></option>
                        <?php
                            }
                        }?>
            </select>
            <label for="busquedaVenta">Clientes</label>
        </div>
    </div>
    <div class="col d-flex justify-content-end align-items-center">
        <div class="form-floating">
            <input type="number" class="form-control" id="busquedaVentaSec" placeholder="Buscar" onkeyup="getDataVentas(1);" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
            <label for="busquedaVentaSec">Buscar Sec</label>
        </div>
    </div>
</div>

<div class="row mb-4" id="resultadosVenta">
    
</div>

<div class="bare row d-flex justify-content-between mb-3">
    <div id="munVenta" class="col">

    </div>
</div>

<?php include_once "contenidoModalAgregarVenta.php"; ?>
<?php include_once "contenidoModalDetalleVenta.php"; ?>

<input hidden type="text" id="dniAsesor" value="<?php echo $dniUsuario;?>">
<input hidden type="text" id="tipoasesor" value="<?php echo $tipoUsuario ; ?>">

<script src="controller/ventas/listar.js"></script> 
<script src="controller/whatsapp/validaciones.js"></script>
<script src="controller/ventas/modal.js"></script>
