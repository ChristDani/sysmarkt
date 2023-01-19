<?php
require_once "../../model/usuarios.php";
$model = new user();

$dni = $_POST['dni'];
$moderador = $_POST['moderador'];

$model->cambiarmoderador($dni,$moderador);
?>
<script>
    window.history.back();
</script>