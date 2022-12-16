<?php
require_once "../../model/usuarios.php";

$dni = $_GET['dni'];

$model = new user();
$model->desactivarEstado($dni);
?>
<script>
    window.history.back();
</script>