<div class="bare row d-flex justify-content-center align-items-center desaparecido" id="headerAcd">
    <div class="col d-flex justify-content-start align-items-center">
        <div class="d-flex justify-content-center align-items-baseline">
            <p class="mx-1" for="numRegistrosacd">Mostrar</p>
            <select name="numRegistrosacd" id="numRegistrosacd" class="mx-1 form-select" aria-label="Default select example">
                <option value="12">12</option>
                <option value="28">28</option>
                <option value="52">52</option>
                <option value="100">100</option>
            </select>
            <p class="mx-1" for="numRegistrosacd">Registros</p>
        </div>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedaacddepa" id="busquedaacddepa" onkeyup="getDataAcd(1);" placeholder="Buscar">
            <label for="busquedaacddepa">Departamento</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedaacdprovin" id="busquedaacdprovin" onkeyup="getDataAcd(1);" placeholder="Buscar">
            <label for="busquedaacdprovin">Provincia</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedaacddistri" id="busquedaacddistri" onkeyup="getDataAcd(1);" placeholder="Buscar">
            <label for="busquedaacddistri">Distrito</label>
        </div>
    </div>
</div>

<div class="row mb-4 desaparecido" id="resultadosAcd">

</div>

<div class="bare row d-flex justify-content-between mb-3 desaparecido" id="paginacionAcd">
    <div id="munAcd">

    </div>
</div>
<script src="controller/ubicaciones/acd/listar.js"></script>