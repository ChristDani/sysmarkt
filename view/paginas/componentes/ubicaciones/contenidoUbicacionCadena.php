<div class="bare row d-flex justify-content-center align-items-center desaparecido" id="headerCade">
    <div class="col d-flex justify-content-start align-items-center">
        <div class="d-flex justify-content-center align-items-baseline">
            <p class="mx-1" for="numRegistroscade">Mostrar</p>
            <select name="numRegistroscade" id="numRegistroscade" class="mx-1 form-select" aria-label="Default select example">
                <option value="12">12</option>
                <option value="28">28</option>
                <option value="52">52</option>
                <option value="100">100</option>
            </select>
            <p class="mx-1" for="numRegistroscade">Registros</p>
        </div>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedacadedepa" id="busquedacadedepa" onkeyup="getDataCade(1);" placeholder="Buscar">
            <label for="busquedacadedepa">Departamento</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedacadeprovin" id="busquedacadeprovin" onkeyup="getDataCade(1);" placeholder="Buscar">
            <label for="busquedacadeprovin">Provincia</label>
        </div>

        <div class="form-floating mx-1">
            <input type="text" class="form-control" name="busquedacadedistri" id="busquedacadedistri" onkeyup="getDataCade(1);" placeholder="Buscar">
            <label for="busquedacadedistri">Distrito</label>
        </div>
    </div>
</div>

<div class="row mb-4 desaparecido" id="resultadosCade">

</div>

<div class="bare row d-flex justify-content-between mb-3 desaparecido" id="paginacionCade">
    <div id="munCade">

    </div>
</div>
<script src="controller/ubicaciones/cadena/listar.js"></script>