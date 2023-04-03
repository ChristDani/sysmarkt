<div class="modal fade" id="Añadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Usuario</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/usuario/agregar.php" method="post" enctype="multipart/form-data">
          <div>
            <div class='col text-center'>
              <div class='card'>
                <div class='card-body m-2'>       
                  <p class='text-muted'>Nombre del Nuevo Usuario</p>
                  <h3 id="mostrarnameuser"></h3>
                </div>
              </div>
            </div>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" autocomplete="off" required type="text" maxlength="8" name="dni" id="dni" onkeyup="arreglarnombrenewuser();" placeholder="dni" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
            <label for="dni">DNI</label>
          </div>
          <div class="form-floating mb-3 d-none">
            <input class="form-control" placeholder="Nombre" autocomplete="off" required type="text" name="nombre" id="nombre">
            <label for="nombre">Nombre</label>
          </div>
          <?php if ($tipoUsuario === "1") { ?>
          <div class="form-floating mb-3">
            <?php } elseif ($tipoUsuario === "2") { ?>
          <div class="form-floating mb-3 d-none">
            <?php } ?>
            <select class="form-select form-select-sm" name="tipo" id="tipo">
              <option value="0">Asesor</option>
                <option value="1">Administrador</option>
                <option value="2">Moderador</option>
            </select>
            <label for="tipo">Tipo de Usuario</label>
          </div>
      <?php if ($tipoUsuario === "1") { ?>
          <div class="form-floating mb-3">
            <select class="form-select form-select-sm" name="dniModerador" id="dniModerador">
              <option value="---">(vacio)</option>
                <?php
                if ($listar != null) 
                {
                  foreach ($listar as $x) 
                  {
                    if ($x[3] === "2") 
                    {

                      echo "<option value='".$x[0]."'>".$x[1]."</option>";
                    }
                    }
                    }?>
            </select>
            <label for="dniModerador">Moderador</label>
          </div>
      <?php } elseif ($tipoUsuario === "2") { ?>
        <div class="form-floating mb-3 d-none">
            <input class="form-control" placeholder="..." autocomplete="off" required type="text" name="dniModerador" id="dniModerador" value="<?php echo $dniUsuario; ?>">
            <label for="dniModerador">Moderador</label> 
          </div>
<?php } ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function arreglarnombrenewuser()
  {
    let dni = document.getElementById('dni');
    let nombre = document.getElementById('nombre');
    let muestranombre = document.getElementById('mostrarnameuser');
    
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