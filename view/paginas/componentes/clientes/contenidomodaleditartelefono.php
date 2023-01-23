<div class="modal fade" id="EditarTelefono" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Editar</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formularioeditartelefono" action="controller/clientes/editartelefono.php" method="post">
        
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <div class="btn btn-secondary" data-bs-target="#DetallesClient" data-bs-toggle="modal">Volver</div>
        <button form="formularioeditartelefono" class="btn btn-primary">Editar</button>
      </div>
    </div>
  </div>
</div>