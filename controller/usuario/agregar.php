<?php
require_once "../../model/usuarios.php";
require_once "../../model/metas.php";
$model = new user();
$metas = new metas();
$listametas = $metas->listar();

$dni = $_POST['dni'];
$dniModerador = $_POST['dniModerador'];
$nombre = $_POST['nombre'];
$clave = sha1(strrev($dni));
$tipo = $_POST['tipo'];

$bus = $model->buscarUser($dni);

if ($bus != null) 
{
    $model->reactivar($dni);
}
else 
{
    $model->insertarUsuario($dni,$nombre,$clave,$tipo,$dniModerador);
    
    foreach($listametas as $lm){
        $portamen69 = ceil($lm[0]*0.5);
        $portamay69 = ceil($lm[1]*0.5);
        $altapost = ceil($lm[2]*0.5);
        $altaprepa = ceil($lm[3]*0.5);
        $portaprepa = ceil($lm[4]*0.5);
        $renovacion = ceil($lm[5]*0.5);
        $hfc_ftth = ceil($lm[6]*0.5);
        $ifi = ceil($lm[7]*0.5);
    }

    $metas->insertarmetausuario($dni,$portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi);
}
?>
<script>
    window.history.back();
</script>