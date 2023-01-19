<div class="modal fade" id="editarModerador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Moderadores</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="controller/usuario/cambiarmoderador.php" method="post" id="formulariocambiomoderadores">

                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button form="formulariocambiomoderadores" class="btn btn-primary color">cambiar</button>
            </div>
        </div>
    </div>
</div>