<?php
require_once "../../model/usuarios.php";
$model = new user();
$listaUsuarios = $model->listar();

$dni = isset($_POST['dni']) ? $_POST['dni'] : null;

if ($dni != null) 
{
    $datos = $model->buscarUser($dni);
}

$output=[];
$output['data']= '';

if ($datos != null) 
{
    foreach($datos as $user) 
	{
		$moderador = $user[8];
        $output['data'] .= "<div>";
        $output['data'] .= "<div class='col text-center'>";
        $output['data'] .= "<div class='card'>";
        $output['data'] .= "<div class='card-body m-2'>";
        $output['data'] .= "<h3>Seleccione un Moderador distinto al ya asignado</h3>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";
        $output['data'] .= "</div>";

        $output['data'] .= "<div class='form-floating mb-3 d-none'>";
        $output['data'] .= "<input class='form-control' autocomplete='off' required type='text' maxlength='8' name='dni' id='dni' placeholder='dni' value='$dni'>";
        $output['data'] .= "<label for='dni'>DNI</label>";
        $output['data'] .= "</div>";

        $output['data'] .= "<div class='form-floating mb-3'>";
        $output['data'] .= "<select class='form-select form-select-sm' name='moderador' id='moderador'>";
        if ($listaUsuarios != null) 
        {
            foreach ($listaUsuarios as $x) 
            {
                if ($x[0] == $moderador) 
                {
                    $output['data'] .= "<option selected hidden value='".$x[0]."'>".$x[1]."</option>";
                }
                elseif ($x[3] === "2" && $x[0] != $moderador) 
                {

                    $output['data'] .= "<option value='".$x[0]."'>".$x[1]."</option>";
                }
            }
        }
        $output['data'] .= "</select>";
        $output['data'] .= "<label for='moderador'>Moderador</label>";
        $output['data'] .= "</div>";
	}
}

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>