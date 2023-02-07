<?php
require_once '../../model/empresa.php';

$empresa = new empresa();

$nombre = $_POST['nombreempresa'];

if ($_FILES['logoempresa']['name']) 
{
    $logo = $_FILES['logoempresa']['name'];
        $dirfinal = "../../view/static/empresa/".$logo;
        copy($_FILES['logoempresa']['tmp_name'],$dirfinal);
}
else 
{
    $logo = $_POST['textlogoempresa'];
}

if ($_FILES['iconoempresa']['name']) 
{
    $icono = $_FILES['iconoempresa']['name'];
        $dirfinal2 = "../../view/static/empresa/".$icono;
        copy($_FILES['iconoempresa']['tmp_name'],$dirfinal2);
}
else 
{
    $icono = $_POST['texticonoempresa'];
}

$empresa->editarEmpresa($nombre,$logo,$icono);
?>
<script>
    window.history.back();
</script>