<?php
require_once "model/planes.php";

// planes
$planeslist = new planes;
$planesFija = $planeslist->listarFija();
?>
<div class="modal fade" id="planesFija" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Planes Fija</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="col-md-auto">
            <div class="d-none" id="contenidoagregarplan">
              <form action="controller/planes/agregarFija.php" method="post">
                <h3>Añadir Plan</h3>
                
                <div class="form-floating mb-3">
                  <input class="form-control" autocomplete="off" type="text" name="planFija" id="planFija" placeholder="..." required>
                  <label for="planFija">Plan</label>
                </div>
                <input class="btn color" type="button" value="Cancelar" onclick="ocultarAgregar();">
                <input class="btn color" type="submit" value="Agregar">
              </form>
            </div>
            <div class="d-none" id="contenidoeditarplan">
              <form action="controller/planes/editarFija.php" method="post">
                <h3>Editar Plan</h3>
                
                <div class="form-floating mb-3">
                  <input class="form-control" autocomplete="off" type="text" name="codigoFija" id="codigoFija" placeholder="...">
                  <label for="codigoFija">CodigoFija</label>
                </div>
                
                <div class="form-floating mb-3">
                  <input class="form-control" autocomplete="off" type="text" name="planeditFija" id="planeditFija" placeholder="...">
                  <label for="planeditFija">Plan</label>
                </div>
                <input class="btn color" type="button" value="Cancelar" onclick="ocultarEdicion();">
                <input class="btn color" type="submit" value="Editar">
              </form>
            </div>
          </div>
          <div class="col-md-auto" style="height: 60vh; overflow-x: auto;" id="listado">
              <table class="table">
                <thead>
                  <tr>
                    <th class="color">N°</th>
                    <th class="color">Descripción</th>
                    <th class="color" colspan=2>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  if ($planesFija != null) 
                  { $i=1;
                      foreach ($planesFija as $pr) 
                      {?>
                          <tr>
                            <th class="color"><?php echo $i; ?></th>
                            <th class="color d-none"><?php echo $pr[0]; ?></th>
                            <th class="color"><?php echo $pr[1]; ?></th>
                            <th onclick="mostrarEdicion();"><a href="#"><ion-icon name="create-outline"></ion-icon></a></th>
                            <th><a href="#"><ion-icon name="trash-outline"></ion-icon></a></th>
                          </tr>
                  <?php $i+=1; }
                  }?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="mostrarAgregar();">Agregar</button>
      </div>
    </div>
  </div>
</div>
<script>
  function mostrarAgregar()
  {
    document.getElementById('contenidoagregarplan').classList.remove('d-none');
    document.getElementById('contenidoeditarplan').classList.add('d-none');
  } 

  function ocultarAgregar()
  {
    document.getElementById('contenidoagregarplan').classList.add('d-none');
  } 

  function mostrarEdicion()
  {
    document.getElementById('contenidoeditarplan').classList.remove('d-none');
    document.getElementById('contenidoagregarplan').classList.add('d-none');
  } 

  function ocultarEdicion()
  {
    document.getElementById('contenidoeditarplan').classList.add('d-none');
  } 
</script>