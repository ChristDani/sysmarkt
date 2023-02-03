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
    <div class="align-items-center d-flex justify-content-center vh-100">
        <div class="card">
            <div class="card-body text-center">
                <h2>Primer Usuario</h2>
                <form id="formularioprimeruser" action="" method="post">
                    <div class="form-floating mb-3 d-none">
                        <input class="form-control" autocomplete="off" type="text" id="nombreprimeruser" placeholder="..." required>
                        <label for="nombre">Nombre</label>
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
                        <label for="dni">DNI</label>
                    </div>
                </form>
                <button form="formularioprimeruser" class="btn">Añadir</button>
            </div>
        </div>
    </div>
    <!-- <div class="card">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <h2>Otorgale estilo a tu Página</h2>
                <div class="form-floating mb-3 /*d-none*/">
                    <input class="form-control" autocomplete="off" type="text" id="nombreprimeruser" placeholder="..." required>
                    <label for="nombre">Nombre</label>
                </div>

                <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                    <input type="file" name="dac" id="dac">
                    <h3 class="my-auto" id="letrerodac">Logo</h3>
                </label>

                <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                    <input type="file" name="dac" id="dac">
                    <h3 class="my-auto" id="letrerodac">Icono</h3>
                </label>
            </form>
            <label class="btn">Omitir</label>
            <label class="btn">Asignar</label>
        </div>
    </div> -->
</body>
<script>
  function arreglarnombreprimeruser()
  {
    let dni = document.getElementById('dniprimiruser');
    let nombre = document.getElementById('nombreprimeruser');
    let muestranombre = document.getElementById('mostrarnameprimeruser');
    
    if (dni.value.length == 8) 
    { 
      let url='controller/arreglarnombre.php';
      let formaData = new FormData()
      formaData.append('dni', dni.value)

      fetch(url,{
          method: "POST",
          body: formaData
      }).then(response=>response.json())
      .then(data=>{
          nombre.value=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
          muestranombre.innerHTML=data.data.nombres+" "+data.data.apellidoPaterno+" "+data.data.apellidoMaterno;
      }).catch(err=>console.log(err))
    }
  }
</script>
</html>