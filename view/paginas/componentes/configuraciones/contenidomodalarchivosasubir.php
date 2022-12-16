<div class="modal fade" id="agregararchivos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir Archivos</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/archivos/agregar.php" method="post" enctype="multipart/form-data">
          
            <h3>Ubicaciones</h3>
            <div class="row">
              <div class="col-lg-6 mb-3">
                  <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                      <input type="file" name="cac" id="cac">
                      <h3 class="my-auto" id="letrerocac">SUBIR CAC</h3>
                  </label>
              </div>
              <div class="col-lg-6 mb-3">
                  <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                      <input type="file" name="dac" id="dac">
                      <h3 class="my-auto" id="letrerodac">SUBIR DAC</h3>
                  </label>
              </div>
              <div class="col-lg-6 mb-3">
                  <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                      <input type="file" name="acd" id="acd">
                      <h3 class="my-auto" id="letreroacd">SUBIR ACD</h3>
                  </label>
              </div>
              <div class="col-lg-6 mb-3">
                  <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                      <input type="file" name="cadena" id="cadena">
                      <h3 class="my-auto" id="letrerocadena">SUBIR CADENA</h3>
                  </label>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-3">
                <h3>Productos</h3>
                <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                    <input type="file" name="productos" id="productos">
                    <h3 class="my-auto" id="letreroproducto">SUBIR PRODUCTOS</h3>
                </label>
              </div>
              <div class="col-lg-6 mb-3">
                <h3>Masiva</h3>
                <label class="filein align-items-center d-grid filein justify-content-center p-lg-5 p-sm-0">
                    <input type="file" name="masiva" id="masiva">
                    <h3 class="my-auto" id="letreromasiva">SUBIR MASIVA</h3>
                </label>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('cac').addEventListener("change", function() {
    cambiarDatocac();
  }, false)

  document.getElementById('dac').addEventListener("change", function() {
    cambiarDatodac();
  }, false)

  document.getElementById('acd').addEventListener("change", function() {
    cambiarDatoacd();
  }, false)

  document.getElementById('cadena').addEventListener("change", function() {
    cambiarDatocadena();
  }, false)

  document.getElementById('productos').addEventListener("change", function() {
    cambiarDatoproducto();
  }, false)

  document.getElementById('masiva').addEventListener("change", function() {
    cambiarDatomasiva();
  }, false)

  function cambiarDatocac()
  {
    let valor = document.getElementById('cac').files[0].name;
    let letrero = document.getElementById('letrerocac')

    letrero.innerHTML = valor;
  }

  function cambiarDatodac()
  {
    let valor = document.getElementById('dac').files[0].name;
    let letrero = document.getElementById('letrerodac')

    letrero.innerHTML = valor;
  }

  function cambiarDatoacd()
  {
    let valor = document.getElementById('acd').files[0].name;
    let letrero = document.getElementById('letreroacd')

    letrero.innerHTML = valor;
  }

  function cambiarDatocadena()
  {
    let valor = document.getElementById('cadena').files[0].name;
    let letrero = document.getElementById('letrerocadena')

    letrero.innerHTML = valor;
  }

  function cambiarDatoproducto()
  {
    let valor = document.getElementById('productos').files[0].name;
    let letrero = document.getElementById('letreroproducto')

    letrero.innerHTML = valor;
  }

  function cambiarDatomasiva()
  {
    let valor = document.getElementById('masiva').files[0].name;
    let letrero = document.getElementById('letreromasiva')

    letrero.innerHTML = valor;
  }
</script>