<?php
require_once "../../model/usuarios.php";

$dni = $_GET['dni'];

$model = new user();
$model->ocuparEstado($dni);
?>
<script>
    window.history.back();
</script>