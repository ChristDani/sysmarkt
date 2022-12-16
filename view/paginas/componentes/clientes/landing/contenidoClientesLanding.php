<div class="bare row d-flex justify-content-center align-items-center desaparecido" id="headerLanding">
    <div class="col d-flex justify-content-start align-items-center">
        <div class="d-flex justify-content-center align-items-baseline">
            <p class="mx-1" for="numRegistrosL">Mostrar</p>
            <select name="numRegistrosL" id="numRegistrosL" class="mx-1 form-select" aria-label="Default select example">
                <option value="12">12</option>
                <option value="28">28</option>
                <option value="52">52</option>
                <option value="100">100</option>
            </select>
            <p class="mx-1" for="numRegistrosL">Registros</p>
        </div>
    </div>
    <div class="col d-flex justify-content-end align-items-center">
        <div class="form-floating">
            <input type="text" class="form-control" id="busquedaL" placeholder="Buscar" onkeyup="getDataL(1);">
            <label for="busquedaL">Buscar</label>
        </div>
    </div>
</div>

<div class="row mb-4 desaparecido" id="resultadosL">
    
</div>

<div class="bare d-flex justify-content-between mb-3 desaparecido" id="paginacionL">
    <div class="mensaje">
        <h3 class="text-muted m-3" id="msgL"></h3>
    </div>
    <div id="munL">

    </div>
</div>

<script src="controller/landing/listarLanding.js"></script>  
