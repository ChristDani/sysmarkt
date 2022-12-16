<div class="modal fade" id="CambiarTipoUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Asender</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-justify">
        <h3 id="nombreUserCambiar"></h3>
      </div>
      <div class="modal-footer justify-content-between">
        <div class="btn btn-secondary" data-bs-target="#InfoUser" data-bs-toggle="modal">Volver</div>
        <form action="controller/usuario/cambiarTipo.php" method="post">
          <input hidden type="text" name="dnicambiar" id="dnicambiar">
          <input hidden type="text" name="tipocambiar" id="tipocambiar">
          <button type="submit" class="btn color" id="btnascdesc"></button>
        </form>
      </div>
    </div>
  </div>
</div>