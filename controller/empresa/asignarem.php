<?php 
require_once '../../model/empresa.php';

$empresa = new empresa();

$nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;

if (!empty($_FILES['logo'])) 
{
    $logo = $_FILES['logo']['name'];
        $dirfinal = "../../view/static/empresa/".$logo;
        copy($_FILES['logo']['tmp_name'],$dirfinal);
}
else 
{
    $logo = "logosysmarkt.png";
}
if (!empty($_FILES['icono'])) 
{
    $icono = $_FILES['icono']['name'];
        $dirfinal2 = "../../view/static/empresa/".$icono;
        copy($_FILES['icono']['tmp_name'],$dirfinal2);
}
else 
{
    $icono = "iconosysmarkt.png";
}

$datos = [];
$datos['empresa'] = '';

if ($nombre != null) 
{
    $empresa->eliminarEmpresa();
    $empresa->insertarEmpresa($nombre,$logo,$icono);
    $datos['empresa'] .= "Se registró la empresa con el nombre: '$nombre', logo: '$logo' e icono: '$icono'";
}
else 
{
    $datos['empresa'] .= "No se ingresó el nombre de la empresa a registrar.";
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>