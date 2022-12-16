<div class="col d-flex justify-content-start align-items-center"> 
    <h1>UBICACIONES</h1>
    <div class="dropdown">
        <a class="dropdown-toggle d-flex align-items-baseline mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <h1 id="MostrarOrigenUbicacion">CAC'S</h1>
        </a>

        <ul class="dropdown-menu" id="origenUbicacion">
            <li><a class="dropdown-item" href="#" onclick="mostrarUbidac();">DAC'S</a></li>
            <li><a class="dropdown-item" href="#" onclick="mostrarUbiacd();">ACD'S</a></li>
            <li><a class="dropdown-item" href="#" onclick="mostrarUbicadena();">CADENAS</a></li>
        </ul>
    </div>
</div>
<div class="card">
    <?php include_once "contenidoUbicacionCac.php"; ?>
    <?php include_once "contenidoUbicacionDac.php"; ?>
    <?php include_once "contenidoUbicacionAcd.php"; ?>
    <?php include_once "contenidoUbicacionCadena.php"; ?>
</div>

<script src="view/static/js/ubicaciones.js"></script>
