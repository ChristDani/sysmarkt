<?php
require_once "../../model/usuarios.php";

$dni = $_GET['dni'];

$model = new user();
$model->reposarEstado($dni);
?>
<script>
    window.history.back();
</script>