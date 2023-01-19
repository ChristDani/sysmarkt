<div class="modal fade" id="planesFija" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Planes Fija</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row m-0">
          <div class="col-auto d-none" id="contenidoagregarplan">
            <h3>Añadir Plan</h3>
            
            <div class="form-floating mb-3">
              <input class="form-control" autocomplete="off" type="text" id="planFija" placeholder="...">
              <label for="planFija">Plan</label>
            </div>
            <input class="btn color" type="button" value="Cancelar" onclick="ocultarAgregarFija();">
            <input class="btn color" type="submit" value="Agregar" onclick="agregarplanFija();">
          </div>
          <div class="col-auto d-none" id="contenidoeditarplan">
            <h3>Editar Plan</h3>
            
            <div class="form-floating mb-3 d-none">
              <input class="form-control" autocomplete="off" type="text" id="codigoFija" placeholder="...">
              <label for="codigoFija">CodigoFija</label>
            </div>

            <div class="form-floating mb-3 d-none">
              <input class="form-control" autocomplete="off" type="text" id="planeditFijaactual" placeholder="...">
              <label for="planeditFija">Plan</label>
            </div>
            
            <div class="form-floating mb-3">
              <input class="form-control" autocomplete="off" type="text" id="planeditFija" placeholder="...">
              <label for="planeditFija">Plan</label>
            </div>
            <input class="btn color" type="button" value="Cancelar" onclick="ocultarEdicionFija();">
            <input class="btn color" type="submit" value="Editar" onclick="editarplanFija();">
          </div>
          <div class="col" style="height: 60vh; overflow-x: auto;" id="listado">
            <table class="table ">
              <thead>
                <tr>
                  <th class="color">N°</th>
                  <th class="color">Descripción</th>
                  <th class="color" colspan="2">Acciones</th>
                </tr>
              </thead>
              <tbody id="contenidoFija">
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="mostrarAgregarFija();">Agregar</button>
      </div>
    </div>
  </div>
</div>