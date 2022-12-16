<div class="col d-flex justify-content-start align-items-center">          
    <h1>CLIENTES</h1>
    <div class="dropdown">
        <a class="dropdown-toggle d-flex align-items-baseline mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <h1 id="MostrarOrigenClientes">WHATSAPP</h1>
        </a>

        <ul class="dropdown-menu" id="origenClientes">
            <li><a class="dropdown-item" href="#" onclick="mostrarOrigenLanding();">LANDING</a></li>
        </ul>
    </div>        
</div>
<div class="card">
<?php include_once "whatsapp/contenidoClientesWhatsapp.php"; ?>
<?php include_once "landing/contenidoClientesLanding.php"; ?>
</div>

<script src="view/static/js/clientes.js"></script>
<script src="controller/whatsapp/validaciones.js"></script>
