<div class="bare row d-flex justify-content-center align-items-center" id="headerCac">
    <div class="col d-flex justify-content-start align-items-center">
        <div class="d-flex justify-content-center align-items-baseline">
            <p class="mx-1" for="numRegistroscac">Mostrar</p>
            <select name="numRegistroscac" id="numRegistroscac" class="mx-1 form-select" aria-label="Default select example">
                <option value="12">12</option>
                <option value="28">28</option>
                <option value="52">52</option>
                <option value="100">100</option>
            </select>
            <p class="mx-1" for="numRegistroscac">Registros</p>
        </div>
    </div>
    <div class="col d-flex justify-content-end">
    <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedacacdepa" id="busquedacacdepa" onkeyup="getDataCac(1);" placeholder="Buscar">
            <label for="busquedacacdepa">Departamento</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedacacprovin" id="busquedacacprovin" onkeyup="getDataCac(1);" placeholder="Buscar">
            <label for="busquedacacprovin">Provincia</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedacacdistri" id="busquedacacdistri" onkeyup="getDataCac(1);" placeholder="Buscar">
            <label for="busquedacacdistri">Distrito</label>
        </div>
    </div>
</div>

<div class="row mb-4" id="resultadosCac">

</div>

<div class="bare row d-flex justify-content-between mb-3" id="paginacionCac">
    <div id="munCac">

    </div>
</div>
<script src="controller/ubicaciones/cac/listar.js"></script>