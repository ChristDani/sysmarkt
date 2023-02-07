<?php
require_once "../../model/metas.php";

$model = new metas();

$portamen69 = isset($_POST['portamen69']) ? $_POST['portamen69'] : null;
$portamay69 = isset($_POST['portamay69']) ? $_POST['portamay69'] : null;
$altapost = isset($_POST['altapost']) ? $_POST['altapost'] : null;
$altaprepa = isset($_POST['altaprepa']) ? $_POST['altaprepa'] : null;
$portaprepa = isset($_POST['portaprepa']) ? $_POST['portaprepa'] : null;
$renovacion = isset($_POST['renovacion']) ? $_POST['renovacion'] : null;
$hfc_ftth = isset($_POST['hfc_ftth']) ? $_POST['hfc_ftth'] : null;
$ifi = isset($_POST['ifi']) ? $_POST['ifi'] : null;

$datos = [];
$datos['metas'] = '';

if ($portamen69 != null && $portamay69 != null && $altapost != null && $altaprepa != null && $portaprepa != null && $renovacion != null && $hfc_ftth != null && $ifi != null) 
{
    $model->eliminar();
    $model->insertarmeta($portamen69,$portamay69,$altapost,$altaprepa,$portaprepa,$renovacion,$hfc_ftth,$ifi);
    $datos['metas'] .= "Se registraron las metas";
}
else 
{
    $datos['metas'] .= "No se ingresaron metas a registrar.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>