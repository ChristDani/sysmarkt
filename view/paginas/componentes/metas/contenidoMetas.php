<?php require_once "operaciones.php"; ?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="Metas" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title" id="offcanvasRightLabel">Progreso del Mes</h1>
    
    <button type="button" class="btn-close bg-danger" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="row">
        <div class="col-xl-12 col-md-6">
            <div class="card mb-4">
                <div class="card-body">  
                    <h3>Progreso total del mes</h3>                                              
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgreTotVen"></div>
                    </div>
                    <p class="text-center text-muted" id="total"><span id="progreTotVen"><?php echo $ventasTotalesPr ?></span> de <span id="totven"><?php echo $metatotal ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>Portabilidad menores a 69.90</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgrevenprotmen69"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progrevenprotmen69"><?php echo $ventasMen69 ?></span> de <span id="portmen69"><?php echo $portamen69 ?></span></p>            
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>Portabilidad mayores a 69.90</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgrevenprotmay69"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progrevenprotmay69"><?php echo $ventasMay69 ?></span> de <span id="portmay69"><?php echo $portamay69 ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>Alta Postpago</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="Barraprogrevenaltpost"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progrevenaltpost"><?php echo $ventasAltPost ?></span> de <span id="altpost"><?php echo $altapost ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>Alta Prepago</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgreVenAltPre"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progrevenaltpre"><?php echo $ventasAltPre ?></span> de <span id="altpre"><?php echo $altaprepa ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>Portabilidad Prepago</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgreportprepa"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progreportprepa"><?php echo $ventasPortPre ?></span> de <span id="portpre"><?php echo $portaprepa ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>Renovacion</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgrevenrenova"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progrevenrenova"><?php echo $ventasReno ?></span> de <span id="reno"><?php echo $renovacion ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>HFC, FTTH</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgrevenfijaftth"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progrevenfijaftth"><?php echo $ventasFijaFtth ?></span> de <span id="ftth"><?php echo $hfc_ftth ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card mb-4">
                <div class="card-body">                                                   
                    <h3>IFI</h3>
                    <div class="progress my-2">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="BarraProgrevenfijaifi"></div>
                    </div>
                    <p class="text-center text-muted"><span id="progrevenfijaifi"><?php echo $ventasFijaIfi ?></span> de <span id="ifi"><?php echo $ifi ?></span></p>
                </div>
            </div>
        </div>
    </div>
  </div>
    <?php if ($tipoUsuario === "1") {?>
        <div class="offcanvas-footer">
            <button type="submit" class="btn btn-primary my-3 ml-4" data-bs-toggle="modal" data-bs-target="#editarMetas">Editar Metas</button>
        </div>
    <?php } ?>
</div>
<?php include_once "view/paginas/componentes/configuraciones/contenidoModalEditarMetas.php"; ?>
<script src="controller/metas/progres.js"></script>
