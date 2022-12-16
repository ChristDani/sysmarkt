<?php
require_once "../../model/usuarios.php";
$model = new user();

$dni = $_POST['dnicambiar'];
if ($_POST['tipocambiar'] === "0") 
{
    $tipo = "2";
}
elseif ($_POST['tipocambiar'] === "1") 
{
    $tipo = "0";
}
elseif ($_POST['tipocambiar'] === "2") 
{
    $tipo = "0";
}

$model->cambiarTipoUsuario($dni,$tipo);
?>
<script>
    window.history.back();
</script>