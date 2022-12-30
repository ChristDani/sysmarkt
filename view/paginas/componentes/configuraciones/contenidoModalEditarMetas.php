<?php
require_once "model/metas.php";

$metas = new metas();
$listaMetas = $metas->listar();

if ($listaMetas != null) 
{
    foreach ($listaMetas as $m) 
    {
        $editportamen69 = trim($m[0]);
        $editportamay69 = trim($m[1]);
        $editaltapost = trim($m[2]);
        $editaltaprepa = trim($m[3]);
        $editportaprepa = trim($m[4]);
        $editrenovacion = trim($m[5]);
        $edithfc_ftth = trim($m[6]);
        $editifi = trim($m[7]);
    }
} 
?>
<div class="modal fade" id="editarMetas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Metas</h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/metas/editar.php" method="post">

          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Portabilidad menor a 69" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="portamen69" id="portamen69" value="<?php echo $editportamen69; ?>">
            <label for="portamen69">Portabilidad menor a 69</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Portabilidad mayor a 69" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="portamay69" id="portamay69" value="<?php echo $editportamay69; ?>">
            <label for="portamay69">Portabilidad mayor a 69</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Alta Postpago" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="altapost" id="altapost" value="<?php echo $editaltapost; ?>">
            <label for="altapost">Alta Postpago</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Alta Prepago" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="altaprepa" id="altaprepa" value="<?php echo $editaltaprepa; ?>">
            <label for="altaprepa">Alta Prepago</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Portabilidad Prepago" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="portaprepa" id="portaprepa" value="<?php echo $editportaprepa; ?>">
            <label for="portaprepa">Portabilidad Prepago</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Renovacion" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="renovacion" id="renovacion" value="<?php echo $editrenovacion; ?>">
            <label for="renovacion">Renovacion</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="HFC_FTTH" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="hfc_ftth" id="hfc_ftth" value="<?php echo $edithfc_ftth; ?>">
            <label for="hfc_ftth">HFC, FTTH</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" placeholder="IFI" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" type="number" name="ifi" id="ifi" value="<?php echo $editifi; ?>">
            <label for="ifi">IFI</label>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Editar</button>
        </form>
      </div>
    </div>
  </div>
</div>