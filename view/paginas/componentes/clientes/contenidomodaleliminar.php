<div class="modal fade" id="eliminar" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Eliminar</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Estas seguro que deseas eliminar <span id="textodeeliminacion"></span>, al ejecutar esta operacion ya no hay vuelta atras.
        <form id="formularioeliminarclienotelef" action="controller/clientes/eliminar.php" method="post">
            <input hidden type="text" name="tipo" id="tipo">
            <input hidden type="text" name="codigo" id="codigo">
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <div class="btn btn-secondary" data-bs-target="#DetallesClient" data-bs-toggle="modal">Volver</div>
        <button form="formularioeliminarclienotelef" class="btn btn-primary">Eliminar</button>
      </div>
    </div>
  </div>
</div>