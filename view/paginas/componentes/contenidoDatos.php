<h1>DATOS</h1>

<!-- formulario para obtener la consulta de php para exportar a excel -->
<form hidden action="controller/masiva/reportexcel.php" method="post">
    <input type="text" name="busquedareportedepartamentomasiva" id="busquedareportedepartamentomasiva">
    <input type="text" name="busquedareporteprovinciamasiva" id="busquedareporteprovinciamasiva">
    <input type="text" name="busquedareportedistritomasiva" id="busquedareportedistritomasiva">
    <input id="btngenerarreportemasiva" name="btngenerarreportemasiva" type="submit" value="send">
</form>

<div class="card">
    <div class="bare row d-flex justify-content-center align-items-center">
        <div class="col d-flex justify-content-start align-items-center">
            <div class="d-flex justify-content-center align-items-baseline">
                <p class="mx-1" for="numRegistrosM">Mostrar</p>
                <select name="numRegistrosM" id="numRegistrosM" class="mx-1 form-select" aria-label="Default select example">
                    <option value="12">12</option>
                    <option value="28">28</option>
                    <option value="52">52</option>
                    <option value="100">100</option>
                </select>
                <p class="mx-1" for="numRegistrosM">Registros</p>
            </div>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <label for="btngenerarreportemasiva" class="btn success-bg">
                <div>CSV</div>
            </label>
        </div>
        <div class="col d-flex justify-content-end align-items-center">
            <div class="form-floating">
                <input type="text" class="form-control" id="busquedadepartamentoM" placeholder="Departamento" onkeyup="getDataM(1);pasardato();">
                <label for="busquedadepartamentoM">Departamento</label>
            </div>
        </div>
        <div class="col d-flex justify-content-end align-items-center">
            <div class="form-floating">
                <input type="text" class="form-control" id="busquedaprovinciaM" placeholder="Provincia" onkeyup="getDataM(1);pasardato();">
                <label for="busquedaprovinciaM">Provincia</label>
            </div>
        </div>
        <div class="col d-flex justify-content-end align-items-center">
            <div class="form-floating">
                <input type="text" class="form-control" id="busquedadistritoM" placeholder="Distrito" onkeyup="getDataM(1);pasardato();">
                <label for="busquedadistritoM">Distrito</label>
            </div>
        </div>
    </div>

    <div class="row mb-4" id="resultadosM">
        
    </div>
    
    <div class="bare row d-flex justify-content-between mb-3">
        <div id="munM">
            
        </div>
    </div>
</div>

<script src="controller/masiva/listarMasiva.js"></script>

<script>
    function pasardato() 
    {
        busquedadepa = document.getElementById('busquedadepartamentoM').value;
        busquedaprovi = document.getElementById('busquedaprovinciaM').value;
        busquedadistri = document.getElementById('busquedadistritoM').value;

        busquereportdepa = document.getElementById('busquedareportedepartamentomasiva');
        busquereportprovi = document.getElementById('busquedareporteprovinciamasiva');
        busquereportdistri = document.getElementById('busquedareportedistritomasiva');

        busquereportdepa.value = busquedadepa;
        busquereportprovi.value = busquedaprovi;
        busquereportdistri.value = busquedadistri;
    }
</script>
