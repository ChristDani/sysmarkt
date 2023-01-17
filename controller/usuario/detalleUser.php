<?php
require_once("../../model/usuarios.php");

$dni= isset($_POST['dni']) ? $_POST['dni'] : null;

$consultas=new user();
$userdetecte=$consultas->buscarUser($dni);
$moderador=$consultas->listar();

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

if ($userdetecte != null) 
{
	foreach($userdetecte as $udt) 
	{

        $dia= date('N', strtotime($udt[4]));
        $numerodia= date('d', strtotime($udt[4]));
        $mes= date('m', strtotime($udt[4]));
        $año= date('Y', strtotime($udt[4]));
        $hora= date('h:i:s A', strtotime($udt[4]));

        $detectedniUser = $udt[0];
        $detecteNombreUser = trim($udt[1]);
        $detecteTipoUser = $udt[3];
        $detecteFechaUser = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año." / ".$hora;
        $detecteEstadoUser = $udt[5];
        $detectefotoUser = trim($udt[6]);
        $detectemoderadorUser = $udt[8];
    }
}

$output=[];
$output['data']= '';

$output['data'].= "<div class='row row-cols-lg-2'>";
$output['data'].= "<div class='col d-flex justify-content-center align-items-center'>";
$output['data'].= "<img class='img-fluid rounded-5' src='view/static/ProfileIMG/$detectefotoUser'>";
$output['data'].= "</div>";
$output['data'].= "<div class='gap-3 col-xl-6 d-grid align-items-center'>";
$output['data'].= "<h2>$detectedniUser</h2>";
$output['data'].= "<h2>$detecteNombreUser</h2>";

if ($detecteTipoUser === "1") 
{
    $output['data'].= "<h2>Administrador</h2>";
}
elseif ($detecteTipoUser === "2") 
{
    $output['data'].= "<h2>Moderador</h2>";
}
elseif ($detecteTipoUser === "0") 
{
    $output['data'].= "<h2>Asesor</h2>";
}

if ($detecteEstadoUser === "0") 
{
    $output['data'].= "<h2 class='secondary'>Desconectado</h2>";
}
elseif ($detecteEstadoUser === "1") 
{
    $output['data'].= "<h2 class='success'>Conectado</h2>";
}
elseif ($detecteEstadoUser === "2") 
{
    $output['data'].= "<h2 class='warning'>Ausente</h2>";
}
elseif ($detecteEstadoUser === "3") 
{
    $output['data'].= "<h2 class='danger'>Ocupado</h2>";
}
if ($detectemoderadorUser != "---") 
{
    foreach ($moderador as $mdo) {
        if ($mdo[0] == $detectemoderadorUser) 
        {
            $output['data'].= "<h2>Moderador: <span class='text-info small'>".$mdo[1]."</span></h2>";
        }
    }
}
$output['data'].= "</div>";
$output['data'].= "</div>";
$output['data'].= "<div class='d-flex justify-content-between align-items-center text-center'>";
$output['data'].= "<h4 class='text-muted'>Desde el $detecteFechaUser</h4>";
$output['data'].= "</div>";

echo json_encode($output, JSON_UNESCAPED_UNICODE); //por si viene con 'ñ' o tildes...
?>