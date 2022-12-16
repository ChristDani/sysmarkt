<div class="bare row d-flex justify-content-center align-items-center desaparecido" id="headerDac">
    <div class="col d-flex justify-content-start align-items-center">
        <div class="d-flex justify-content-center align-items-baseline">
            <p class="mx-1" for="numRegistrosdac">Mostrar</p>
            <select name="numRegistrosdac" id="numRegistrosdac" class="mx-1 form-select" aria-label="Default select example">
                <option value="12">12</option>
                <option value="28">28</option>
                <option value="52">52</option>
                <option value="100">100</option>
            </select>
            <p class="mx-1" for="numRegistrosdac">Registros</p>
        </div>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedadacdepa" id="busquedadacdepa" onkeyup="getDataDac(1);" placeholder="Buscar">
            <label for="busquedadacdepa">Departamento</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedadacprovin" id="busquedadacprovin" onkeyup="getDataDac(1);" placeholder="Buscar">
            <label for="busquedadacprovin">Provincia</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedadacdistri" id="busquedadacdistri" onkeyup="getDataDac(1);" placeholder="Buscar">
            <label for="busquedadacdistri">Distrito</label>
        </div>
    </div>
</div>

<div class="row mb-4 desaparecido" id="resultadosDac">

</div>

<div class="bare row d-flex justify-content-between mb-3 desaparecido" id="paginacionDac">
    <div id="munDac">

    </div>
</div>
<script src="controller/ubicaciones/dac/listar.js"></script>