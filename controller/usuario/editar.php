<?php
require_once "../../model/usuarios.php";
$model = new user();

$dni = $_POST['dniedit'];
$nombre = $_POST['nombreedit'];
$clave = !empty($_POST['claveedit']) ? sha1($_POST['claveedit']) : $_POST['claveedit2'];

if ($_FILES['fotoPerfiledit']['name']) 
{
    $fotoPerfil = $_FILES['fotoPerfiledit']['name'];
        $dirfinal2 = "../../view/static/ProfileIMG/".$fotoPerfil;
        copy($_FILES['fotoPerfiledit']['tmp_name'],$dirfinal2);
}
else 
{
    $fotoPerfil = $_POST['fotoPerfiledit1'];
}

$model->editarUsuario($dni,$nombre,$clave,$fotoPerfil);
?>
<script>
    window.history.back();
</script>