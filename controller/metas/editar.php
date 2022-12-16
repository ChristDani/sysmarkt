<?php
require_once "../../model/metas.php";

$portamen69 = $_POST['portamen69'];
$portamay69 = $_POST['portamay69'];
$altapost = $_POST['altapost'];
$altaprepa = $_POST['altaprepa'];
$portaprepa = $_POST['portaprepa'];
$renovacion = $_POST['renovacion'];
$hfc_ftth = $_POST['hfc_ftth'];
$ifi = $_POST['ifi'];

$model = new metas();
$model->editar($portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi);
?>
<script>
    window.history.back();
</script>