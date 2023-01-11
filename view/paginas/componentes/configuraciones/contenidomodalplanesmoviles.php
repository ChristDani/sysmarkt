<?php
require_once "model/planes.php";

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();
?>
<div class="modal fade" id="planesMoviles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Planes Moviles</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-between">
          <div style="height: 70vh; overflow-x: auto;">
            <!-- <h3>Listado</h3> -->
            <div id="listado">
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
                  if ($planesMov != null) 
                  {
                      foreach ($planesMov as $pr) 
                      {?>
                          <tr>
                            <th class="color"><?php echo $pr[0]; ?></th>
                            <th class="color"><?php echo $pr[1]; ?></th>
                            <th><a href="#"><ion-icon name="create-outline"></ion-icon></a></th>
                            <th><a href="#"><ion-icon name="trash-outline"></ion-icon></a></th>
                          </tr>
                  <?php }
                  }?>
                </tbody>
              </table>
            </div>
          </div>
          <div>
            <div>
              <form action="controller/planes/agregarMovil.php" method="post">
                <h3>Añadir Plan</h3>
                
                <div class="form-floating mb-3">
                  <input class="form-control" autocomplete="off" type="text" name="planMovil" id="planMovil" placeholder="...">
                  <label for="planMovil">Plan</label>
                </div>
                <input type="submit" value="send">
              </form>
            </div>
            <div>
              <form action="controller/planes/editarMovil.php" method="post">
                <h3>Editar Plan</h3>
                
                <div class="form-floating mb-3">
                  <input class="form-control" autocomplete="off" type="text" name="codigoMovil" id="codigoMovil" placeholder="...">
                  <label for="codigoMovil">Codigo</label>
                </div>
                
                <div class="form-floating mb-3">
                  <input class="form-control" autocomplete="off" type="text" name="planeditMovil" id="planeditMovil" placeholder="...">
                  <label for="planeditMovil">Plan</label>
                </div>
                <input type="submit" value="send">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>