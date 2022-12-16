<?php
require_once "model/usuarios.php";

$modal = new user();
$listaUsuarios = $modal->listar();

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

if ($listaUsuarios != null) 
{
    foreach ($listaUsuarios as $u) 
    { 
        if ($u[0] === $dniUsuario) 
        {

            $dia= str_replace('-', '/', date('N', strtotime($u[4])));
            $numerodia= str_replace('-', '/', date('d', strtotime($u[4])));
            $mes= str_replace('-', '/', date('m', strtotime($u[4])));
            $año= str_replace('-', '/', date('Y', strtotime($u[4])));
            $hora= str_replace('-', '/', date('h:i:s A', strtotime($u[4])));

            // forma corta
            // $dia= date('N', strtotime($u[4]));
            // $numerodia= date('d', strtotime($u[4]));
            // $mes= date('m', strtotime($u[4]));
            // $año= date('Y', strtotime($u[4]));
            // $hora= date('h:i:s A', strtotime($u[4]));
            
            $configdniUser = $u[0];
            $configNombreUser = trim($u[1]);
            $configClaveUser = $u[2];
            $configTipoUser = $u[3];
            $configFechaUser = $diassemana[$dia-1].", ".$numerodia." de ".$meses[$mes-1]." del ".$año." / ".$hora;
            $configEstadoUser = $u[5];
            $configfotoUser = trim($u[6]);
        }
    }
} 
?>
<?php include_once "componentes/header.php"; ?>
<?php include_once "componentes/configuraciones/contenidoConfiguracion.php"; ?>
<?php include_once "componentes/footer.php"; ?>