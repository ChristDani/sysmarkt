<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sysmarkt | Bienvenido</title>
    <link rel="icon" href="view/static/img/<?php echo $iconoglobalyfijodeempresa; ?>">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="view/static/css/styles.css">
    <link rel="stylesheet" href="view/static/css/style.css">
</head>
<body>
    <div class="align-items-center d-flex justify-content-center vh-100 gap-2">
        <div id="conteusu" class="card">
            <div class="card-body text-center">
                <h2>Primer Usuario</h2>
                <div class="form-floating mb-3 d-none">
                    <input class="form-control" autocomplete="off" type="text" id="nombreprimeruser" placeholder="..." required>
                    <label for="nombreprimeruser">Nombre</label>
                </div>
    
                <div class='col text-center'>
                    <div class='card'>
                        <div class='card-body m-2'>       
                            <p class='text-muted'>Nombre del Usuario</p>
                            <h3 id="mostrarnameprimeruser"></h3>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" autocomplete="off" type="number" id="dniprimiruser" maxlength=8 placeholder="..." onkeyup="arreglarnombreprimeruser();" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="dniprimiruser">DNI</label>
                </div>

                <label class="btn" onclick="agregarprimerusuario();">Añadir</label>
            </div>
        </div>

        <div id="contempr" class="card d-none">
            <div class="card-body text-center">
                <!-- <form action="" method="post" enctype="multipart/form-data"> -->
                    <h2>Otorgale estilo a tu Página</h2>
                    <div class="form-floating mb-3">
                        <input class="form-control" autocomplete="off" type="text" id="nombreempresa" placeholder="..." required>
                        <label for="nombreempresa">Nombre</label>
                    </div>
    
                    <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                        <input type="file" name="logo" id="logo">
                        <h3 class="my-auto" id="letrerologo">Logo</h3>
                    </label>
    
                    <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                        <input type="file" name="icono" id="icono">
                        <h3 class="my-auto" id="letreroicono">Icono</h3>
                    </label>
                <!-- </form> -->
                <label class="btn" onclick="cambio(2);">Omitir</label>
                <label class="btn" onclick="cambio(2);">Asignar</label>
            </div>
        </div>

        <div id="contemetas" class="card d-none">
            <div class="card-body text-center">
                <h2>Asigne las primeras metas</h2>

                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="Portabilidad menor a 69" autocomplete="off" maxlength="4" type="number" name="portamen69" id="portamen69" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="portamen69">Portabilidad menor a 69</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="Portabilidad mayor a 69" autocomplete="off" maxlength="4" type="number" name="portamay69" id="portamay69" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="portamay69">Portabilidad mayor a 69</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="Alta Postpago" autocomplete="off" maxlength="4" type="number" name="altapost" id="altapost" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="altapost">Alta Postpago</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="Alta Prepago" autocomplete="off" maxlength="4" type="number" name="altaprepa" id="altaprepa" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="altaprepa">Alta Prepago</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="Portabilidad Prepago" autocomplete="off" maxlength="4" type="number" name="portaprepa" id="portaprepa" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="portaprepa">Portabilidad Prepago</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="Renovacion" autocomplete="off" maxlength="4" type="number" name="renovacion" id="renovacion" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="renovacion">Renovacion</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="HFC_FTTH" autocomplete="off" maxlength="4" type="number" name="hfc_ftth" id="hfc_ftth" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="hfc_ftth">HFC, FTTH</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" placeholder="IFI" autocomplete="off" maxlength="4" type="number" name="ifi" id="ifi" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                    <label for="ifi">IFI</label>
                </div>
                
                <label class="btn">Omitir</label>
                <label class="btn">Asignar</label>
            </div>
        </div>
    </div>
</body>
<script src="controller/empresa/acciones.js"></script>
</html>