<div class="modal fade" id="Promociones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Promociones</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row m-0">
          <div class="col-auto d-none" id="contenidoagregarPromo">
            <h3>Añadir Promoción</h3>
            
            <div class="form-floating mb-3">
              <textarea class="form-control" autocomplete="off" type="text" id="Promo" placeholder="..."></textarea>
              <label for="Promo">Promoción</label>
            </div>
            <input class="btn color" type="button" value="Cancelar" onclick="ocultarAgregarPromo();">
            <input class="btn color" type="submit" value="Agregar" onclick="agregarPromo();">
          </div>
          <div class="col-auto d-none" id="contenidoeditarPromo">
            <h3>Editar Promoción</h3>
            
            <div class="form-floating mb-3 d-none">
              <input class="form-control" autocomplete="off" type="text" id="codigoPromo" placeholder="...">
              <label for="codigoPromo">CodigoPromo</label>
            </div>

            <div class="form-floating mb-3 d-none">
              <input class="form-control" autocomplete="off" type="text" id="editPromoactual" placeholder="...">
              <label for="editPromoactual">Promoción</label>
            </div>
            
            <div class="form-floating mb-3">
              <textarea class="form-control" autocomplete="off" type="text" id="editPromo" placeholder="..."></textarea>
              <label for="editPromo">Promoción</label>
            </div>
            <input class="btn color" type="button" value="Cancelar" onclick="ocultarEdicionPromo();">
            <input class="btn color" type="submit" value="Editar" onclick="editarPromo();">
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
              <tbody id="contenidoPromo">
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="mostrarAgregarPromo();">Agregar</button>
      </div>
    </div>
  </div>
</div>