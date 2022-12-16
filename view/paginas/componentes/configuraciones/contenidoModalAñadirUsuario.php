<div class="modal fade" id="Añadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Usuario</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/usuario/agregar.php" method="post" enctype="multipart/form-data">
          <div class="form-floating mb-3">
            <input class="form-control" autocomplete="off" required type="text" maxlength="8" name="dni" id="dni" placeholder="dni" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
            <label for="dni">DNI</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Nombre" autocomplete="off" required type="text" name="nombre" id="nombre">
            <label for="nombre">Nombre</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="clave" autocomplete="off" required type="password" name="clave" id="clave">
            <label for="clave">Clave</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select form-select-sm" name="tipo" id="tipo">
              <option value="1">Administrador</option>
              <option value="0">Asesor</option>
              <option value="2">Moderador</option>
            </select>
            <label for="tipo">Tipo de Usuario</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>