<?php 

require_once '../../model/ventas.php';

$model = new ventas();

$asesor = $_POST['asesor'];
$sec = $_POST['sec'];
$secant = $_POST['secant'];


$model->editarventa($asesor,$sec,$secant);
?>
<script>
    window.history.back();
</script>