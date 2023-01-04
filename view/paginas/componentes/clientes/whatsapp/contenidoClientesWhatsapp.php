<div class="bare row d-flex justify-content-center align-items-center" id="headerWhatsapp">
    <div class="col d-flex justify-content-start align-items-center">
        <div class="d-flex justify-content-center align-items-baseline">
            <p class="mx-1" for="numRegistrosW">Mostrar</p>
            <select name="numRegistrosW" id="numRegistrosW" class="mx-1 form-select" aria-label="Default select example">
                <option value="12">12</option>
                <option value="28">28</option>
                <option value="52">52</option>
                <option value="100">100</option>
            </select>
            <p class="mx-1" for="numRegistrosW">Registros</p>
        </div>
    </div>
    <!-- <div class="col d-flex justify-content-between align-items-center">
        <a href="#" class="primary" type="button" data-bs-toggle="modal" data-bs-target="#AgregarWhatsapp">
            <ion-icon name="add-circle-outline"></ion-icon>
        </a>
    </div> -->
    <div class="col d-flex justify-content-end align-items-center">
        <div class="form-floating">
            <input type="text" class="form-control" id="busquedaW" placeholder="Buscar" onkeyup="getDataW(1);">
            <label for="busquedaW">Buscar</label>
        </div>
    </div>
</div>

<input hidden type="text" name="tipoUser" id="tipoUser" value="<?php echo $tipoUsuario; ?>">

<div class="row mb-4" id="resultadosW">
    
</div>

<div class="bare row d-flex justify-content-between mb-3" id="paginacionW">
    <div id="munW" class="col">

    </div>
</div>

<?php include_once "contenidoModalAgregarWhatsapp.php"; ?>
<?php include_once "contenidoModalDetalleWhatsapp.php"; ?>

<?php if ($tipoUsuario === "1" || $tipoUsuario === "2") { ?>
<script src="controller/whatsapp/listarWhatsapp.js"></script>  
<?php } elseif ($tipoUsuario === "0") { ?>
    <input hidden type="text" name="dniAsesor" id="dniAsesor" value="<?php echo $dniUsuario;?>">
    <script src="controller/whatsapp/listarWhatsappAsesor.js"></script>  
<?php } ?>
<script src="controller/whatsapp/validaciones.js"></script>
<script src="controller/whatsapp/modal.js"></script>
