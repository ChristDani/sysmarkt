<div class="modal fade" id="planesMoviles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Planes Moviles</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row m-0">
          <div class="col-auto d-none" id="contenidoagregarplanMovil">
            <h3>Añadir Plan</h3>
            
            <div class="form-floating mb-3">
              <textarea class="form-control" autocomplete="off" type="text" id="planMovil" placeholder="..."></textarea>
              <label for="planMovil">Plan</label>
            </div>
            <input class="btn color" type="button" value="Cancelar" onclick="ocultarAgregarMovil();">
            <input class="btn color" type="submit" value="Agregar" onclick="agregarplanMovil();">
          </div>
          <div class="col-auto d-none" id="contenidoeditarplanMovil">
            <h3>Editar Plan</h3>
            
            <div class="form-floating mb-3 d-none">
              <input class="form-control" autocomplete="off" type="text" id="codigoMovil" placeholder="...">
              <label for="codigoMovil">CodigoMovil</label>
            </div>

            <div class="form-floating mb-3 d-none">
              <input class="form-control" autocomplete="off" type="text" id="planeditMovilactual" placeholder="...">
              <label for="planeditMovilactual">Plan</label>
            </div>
            
            <div class="form-floating mb-3">
              <textarea class="form-control" autocomplete="off" type="text" id="planeditMovil" placeholder="..."></textarea>
              <label for="planeditMovil">Plan</label>
            </div>
            <input class="btn color" type="button" value="Cancelar" onclick="ocultarEdicionMovil();">
            <input class="btn color" type="submit" value="Editar" onclick="editarplanMovil();">
          </div>
          <div class="col" style="height: 60vh; overflow-x: auto;">
            <table class="table">
              <thead>
                <tr>
                  <th class="color">N°</th>
                  <th class="color">Descripción</th>
                  <th class="color" colspan="2">Acciones</th>
                </tr>
              </thead>
              <tbody id="contenidoMovil">
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="mostrarAgregarMovil();">Agregar</button>
      </div>
    </div>
  </div>
</div>