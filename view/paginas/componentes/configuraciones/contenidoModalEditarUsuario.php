<div class="modal fade" id="EditarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/usuario/editar.php" method="post" enctype="multipart/form-data">
          <input hidden type="text" name="dniedit" id="dniedit"> <!--no mover-->

          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-auto">
              <div class="d-flex flex-column justify-content-center align-items-center ">
                <label class="photoedit overflow-hidden">
                  <input type="file" name="fotoPerfiledit" id="fotoPerfiledit">
                  <input hidden type="text" name="fotoPerfiledit1" id="fotoPerfiledit1">
                  <img id="fotoPerfilmuestra" class="img-fluid rounded-5 overflow-hidden">
                  <img id="fotoPerfileditmuestra" class="img-fluid rounded-5 overflow-hidden d-none">
                </label>
              </div>
            </div>
          </div>

          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Nombre" autocomplete="off" type="text" name="nombreedit" id="nombreedit">
            <label for="nombre">Nombre</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="clave" autocomplete="off" type="password" name="claveedit" id="claveedit">
            <label for="clave">Clave</label>
          </div>
          <input hidden type="text" name="claveedit2" id="claveedit2" readonly>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
      </div>
    </div>
  </div>
</div>