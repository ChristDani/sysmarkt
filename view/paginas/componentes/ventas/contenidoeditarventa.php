<div class="modal fade" id="EditarVenta" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Editar</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formularioVenta" action="controller/ventas/editarVenta.php" method="post">
        
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <div class="btn btn-secondary" data-bs-target="#DetallesVentas" data-bs-toggle="modal">Volver</div>
        <button form="formularioVenta" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>