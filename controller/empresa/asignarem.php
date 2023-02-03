<?php 
require_once '../../model/empresa.php';

$empresa = new empresa();

$nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
// $logo = !empty($_POST['logo']) ? $_POST['logo'] : null;
// $icono = !empty($_POST['icono']) ? $_POST['icono'] : null;

if ($_FILES['logo']['name']) 
{
    $logo = $_FILES['logo']['name'];
        $dirfinal2 = "../../view/static/ProfileIMG/".$logo;
        copy($_FILES['logo']['tmp_name'],$dirfinal2);
}
else 
{
    $logo = "logo-claro.png";
}
if ($_FILES['icono']['name']) 
{
    $icono = $_FILES['icono']['name'];
        $dirfinal2 = "../../view/static/ProfileIMG/".$icono;
        copy($_FILES['icono']['tmp_name'],$dirfinal2);
}
else 
{
    $icono = "icono.png";
}

$datos = [];
$datos['empresa'] = '';

if ($nombre != null) 
{
    $empresa->insertarEmpresa($nombre,$logo,$icono);
    $datos['empresa'] .= "Se registró la empresa con el nombre: '$nombre', logo: '$logo' e icono: '$icono'";
}
else 
{
    $datos['empresa'] .= "No se ingresó un usuario a registrar.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>