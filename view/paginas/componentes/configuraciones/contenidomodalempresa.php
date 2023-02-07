<?php 
require_once "model/empresa.php";

$contenidoempre = new empresa();

$listadeempresa = $contenidoempre->listar();
?>
<div class="modal fade" id="Empresad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Configuración de Empresa</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                if ($listadeempresa != null) 
                {
                    foreach ($listadeempresa as $le) 
                    { 
                        $nombre = $le[0];
                        $logo = $le[1];
                        $icono = $le[2];?>

                        <form id="formularioeditarempresa" action="controller/empresa/editar.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col text-center">
                                    <h2>Cambia de estilo a tu Página</h2>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" autocomplete="off" type="text" name="nombreempresa" id="nombreempresa" placeholder="..." value="<?php echo $nombre; ?>" required>
                                        <label for="nombreempresa">Nombre</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row text-center">
                                <div class="col">
                                    <input hidden type="text" name="textlogoempresa" value="<?php echo $logo; ?>">
                                    <label class="filein p-3 w-100">
                                        <input type="file" name="logoempresa" id="logoempresa">
                                        <h3 class="my-auto" id="letrerologo"><?php echo $logo; ?></h3>
                                    </label>
                                </div>
                                <div class="col">
                                    <img src="view/static/empresa/<?php echo $logo; ?>" style="max-height: 4em;" id="contimagendelogoempresa">
                                </div>
                            </div>

                            <div class="row text-center">
                                <div class="col">
                                    <input hidden type="text" name="texticonoempresa" value="<?php echo $icono; ?>">
                                    <label class="filein p-3 w-100">
                                        <input type="file" name="iconoempresa" id="iconoempresa">
                                        <h3 class="my-auto" id="letreroicono"><?php echo $icono; ?></h3>
                                    </label>
                                </div>
                                <div class="col">
                                    <img src="view/static/empresa/<?php echo $icono; ?>" style="max-height: 4em;" id="contimagendeiconoempresa">
                                </div>
                            </div>
                        </form>
            <?php   }
                }
                else
                {?>
                    <form id="formularioagregarempresa" action="controller/empresa/agregar.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col text-center">
                                <h2>Otorgale estilo a tu Página</h2>
                                <div class="form-floating mb-3">
                                    <input class="form-control" autocomplete="off" type="text" name="nombreempresa" id="nombreempresa" placeholder="..." required>
                                    <label for="nombreempresa">Nombre</label>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center">
                        <div class="col">
                                <label class="filein p-3 w-100">
                                    <input type="file" name="logoempresa" id="logoempresa">
                                    <h3 class="my-auto" id="letrerologo">Logo</h3>
                                </label>
                            </div>
                            <div class="col">
                                <img src="view/static/img/carpeta.png" style="max-height: 4em;" id="contimagendelogoempresa">
                            </div>
                        </div>

                        <div class="row text-center">
                        <div class="col">
                                <label class="filein p-3 w-100">
                                    <input type="file" name="iconoempresa" id="iconoempresa">
                                    <h3 class="my-auto" id="letreroicono">Icono</h3>
                                </label>
                            </div>
                            <div class="col">
                                <img src="view/static/img/carpeta.png" style="max-height: 4em;" id="contimagendeiconoempresa">
                            </div>
                        </div>
                    </form>
        <?php   }
                ?>
            </div>
            <div class="modal-footer">
            <?php 
                if ($listadeempresa != null) 
                { ?>
                    <button form="formularioeditarempresa" class="btn btn-primary">Editar</button>
        <?php   } 
                else
                {?>
                    <button form="formularioagregarempresa" class="btn btn-primary">Agregar</button>
        <?php   }?>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('logoempresa').addEventListener("change", function() 
    {
        let valor = document.getElementById('logoempresa').files[0].name;
        let letrero = document.getElementById('letrerologo')

        letrero.innerHTML = valor;

        const input = document.getElementById("logoempresa")
        const preview = document.getElementById("contimagendelogoempresa")

        const [file] = input.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }, false)

    document.getElementById('iconoempresa').addEventListener("change", function() 
    {
        let valor = document.getElementById('iconoempresa').files[0].name;
        let letrero = document.getElementById('letreroicono')

        letrero.innerHTML = valor;
        
        const input = document.getElementById("iconoempresa")
        const preview = document.getElementById("contimagendeiconoempresa")

        const [file] = input.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }, false)
</script>