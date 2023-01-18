<?php 
require_once "model/conexion.php";
require_once "model/metas.php";
require_once "model/planes.php";

// conexion
$cone = new conexion();
$consulta = $cone->conectar();

// metas
$metas = new metas();

$abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','+','-','/',' '];

// planes
$planeslist = new planes;
$planesMov = $planeslist->listar();

if ($tipoUsuario === "1") 
{
    $listaMetas = $metas->listar();
    if ($listaMetas != null) 
    {
        foreach ($listaMetas as $m) 
        {
                $portamen69 = trim($m[0]);
                $portamay69 = trim($m[1]);
                $altapost = trim($m[2]);
                $altaprepa = trim($m[3]);
                $portaprepa = trim($m[4]);
                $renovacion = trim($m[5]);
                $hfc_ftth = trim($m[6]);
                $ifi = trim($m[7]);
                $metatotal = $portamen69+$portamay69+$altapost+$altaprepa+$portaprepa+$renovacion+$hfc_ftth+$ifi;
        }
    }
}
elseif ($tipoUsuario === "2")
{
    $listaMetas = $metas->listar();
    if ($listaMetas != null) 
    {
        $conuse = "SELECT * from usuarios where activo='1' and tipo='2'";
        $resuluser = mysqli_query($consulta,$conuse);
        $moderatot = $resuluser->num_rows;
        foreach ($listaMetas as $m) 
        {
                $portamen69 = ceil(trim($m[0]) * 0.7);
                $portamay69 = ceil(trim($m[1]) * 0.7);
                $altapost = ceil(trim($m[2]) * 0.7);
                $altaprepa = ceil(trim($m[3]) * 0.7);
                $portaprepa = ceil(trim($m[4]) * 0.7);
                $renovacion = ceil(trim($m[5]) * 0.7);
                $hfc_ftth = ceil(trim($m[6]) * 0.7);
                $ifi = ceil(trim($m[7]) * 0.7);
                $metatotal = $portamen69+$portamay69+$altapost+$altaprepa+$portaprepa+$renovacion+$hfc_ftth+$ifi;
        }
    }
}
elseif ($tipoUsuario === "0") 
{
    $listaMetas = $metas->listarAsesor($dniUsuario);
    if ($listaMetas != null) 
    {
        foreach ($listaMetas as $m) 
        {
                $portamen69 = trim($m[1]);
                $portamay69 = trim($m[2]);
                $altapost = trim($m[3]);
                $altaprepa = trim($m[4]);
                $portaprepa = trim($m[5]);
                $renovacion = trim($m[6]);
                $hfc_ftth = trim($m[7]);
                $ifi = trim($m[8]);
                $metatotal = $portamen69+$portamay69+$altapost+$altaprepa+$portaprepa+$renovacion+$hfc_ftth+$ifi;
        }
    }
}

if ($tipoUsuario === "1") 
{
    // progreso ventas totales
    $sql = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and estado='1'";
    $resultado = mysqli_query($consulta,$sql);
    $ventasTotalesPr = $resultado->num_rows;

    // progreso portabilidades menores a 69
    $ventasMen69 = 0;
    if ($planesMov != null) 
    {
        foreach ($planesMov as $pr) 
        {
            $plan = str_replace($abecedario, '', $pr[1]);
            if ($plan < 69.90)
            {
                $p = $pr[1];
                $sql = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and estado='1' and producto='1' and tipo='1' and plan='$p'";
                $resultado = mysqli_query($consulta,$sql);
                $cantidad = $resultado->num_rows;
                $ventasMen69 = $ventasMen69+$cantidad;
            }
        }
    }

    // progreso portabilidades mayores a 69
    $ventasMay69 = 0;
    if ($planesMov != null) 
    {
        foreach ($planesMov as $pr) 
        {
            $plan = str_replace($abecedario, '', $pr[1]);
            if ($plan >= 69.90)
            {
                $p = $pr[1];
                $sql = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and estado='1' and producto='1' and tipo='1' and plan='$p'";
                $resultado = mysqli_query($consulta,$sql);
                $cantidad = $resultado->num_rows;
                $ventasMay69 = $ventasMay69+$cantidad;
            }
        }
    }

    // progreso altas postpago
    $sql3 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and producto='1' and tipo='0' and modalidad='1' and estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasAltPost = $resultado3->num_rows;

    // progreso altas prepago
    $sql3 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and producto='1' and tipo='0' and modalidad='0' and estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasAltPre = $resultado3->num_rows;

    // progreso portabilidad prepago
    $sql3 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and producto='1' and tipo='1' and modalidad='0' and estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasPortPre = $resultado3->num_rows;

    // progreso renovaciones
    $sql3 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and producto='1' and tipo='2' and estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasReno = $resultado3->num_rows;

    // progreso fija ftth
    $sql3 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and producto='0' and (modoFija='HFC' or modoFija='FTTH') and estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasFijaFtth = $resultado3->num_rows;

    // progreso fija ifi
    $sql3 = "SELECT * from detalleventas where (month(registro)=month(CURRENT_TIMESTAMP) and year(registro)=year(CURRENT_TIMESTAMP)) and producto='0' and modoFija='IFI' and estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasFijaIfi = $resultado3->num_rows;
}

elseif ($tipoUsuario === "2") 
{
    // progreso ventas totales
    $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1' and u.dniModerador='$dniUsuario'";
    $resultado = mysqli_query($consulta,$sql);
    $ventasTotalesPr = $resultado->num_rows;

    // progreso portabilidades menores a 69
    $ventasMen69 = 0;
    if ($planesMov != null) 
    {
        foreach ($planesMov as $pr) 
        {
            $plan = str_replace($abecedario, '', $pr[1]);
            if ($plan < 69.90)
            {
                $p = $pr[1];
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1' and u.dniModerador='$dniUsuario' and dv.producto='1' and dv.tipo='1' and dv.plan='$p'";
                $resultado = mysqli_query($consulta,$sql);
                $cantidad = $resultado->num_rows;
                $ventasMen69 = $ventasMen69+$cantidad;
            }
        }
    }

    // progreso portabilidades mayores a 69
    $ventasMay69 = 0;
    if ($planesMov != null) 
    {
        foreach ($planesMov as $pr) 
        {
            $plan = str_replace($abecedario, '', $pr[1]);
            if ($plan >= 69.90)
            {
                $p = $pr[1];
                $sql = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1' and u.dniModerador='$dniUsuario' and dv.producto='1' and dv.tipo='1' and dv.plan='$p'";
                $resultado = mysqli_query($consulta,$sql);
                $cantidad = $resultado->num_rows;
                $ventasMay69 = $ventasMay69+$cantidad;
            }
        }
    }

    // progreso altas postpago
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and u.dniModerador='$dniUsuario' and dv.producto='1' and dv.tipo='0' and dv.modalidad='1' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasAltPost = $resultado3->num_rows;

    // progreso altas prepago
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and u.dniModerador='$dniUsuario' and dv.producto='1' and dv.tipo='0' and dv.modalidad='0' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasAltPre = $resultado3->num_rows;

    // progreso portabilidad prepago
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and u.dniModerador='$dniUsuario' and dv.producto='1' and dv.tipo='1' and dv.modalidad='0' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasPortPre = $resultado3->num_rows;

    // progreso renovaciones
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and u.dniModerador='$dniUsuario' and dv.producto='1' and dv.tipo='2' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasReno = $resultado3->num_rows;

    // progreso fija ftth
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and u.dniModerador='$dniUsuario' and dv.producto='0' and (dv.modoFija='HFC' or dv.modoFija='FTTH') and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasFijaFtth = $resultado3->num_rows;

    // progreso fija ifi
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v inner join usuarios as u on dv.sec=v.sec and v.dniAsesor=u.dni where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and u.dniModerador='$dniUsuario' and dv.producto='0' and dv.modoFija='IFI' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasFijaIfi = $resultado3->num_rows;
}

elseif ($tipoUsuario === "0") 
{
    // progreso ventas totales
    $sql = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1' and v.dniAsesor='$dniUsuario'";
    $resultado = mysqli_query($consulta,$sql);
    $ventasTotalesPr = $resultado->num_rows;

    // progreso portabilidades menores a 69
    $ventasMen69 = 0;
    if ($planesMov != null) 
    {
        foreach ($planesMov as $pr) 
        {
            $plan = str_replace($abecedario, '', $pr[1]);
            if ($plan < 69.90)
            {
                $p = $pr[1];
                $sql = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1' and v.dniAsesor='$dniUsuario' and dv.producto='1' and dv.tipo='1' and dv.plan='$p'";
                $resultado = mysqli_query($consulta,$sql);
                $cantidad = $resultado->num_rows;
                $ventasMen69 = $ventasMen69+$cantidad;
            }
        }
    }

    // progreso portabilidades mayores a 69
    $ventasMay69 = 0;
    if ($planesMov != null) 
    {
        foreach ($planesMov as $pr) 
        {
            $plan = str_replace($abecedario, '', $pr[1]);
            if ($plan >= 69.90)
            {
                $p = $pr[1];
                $sql = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and dv.estado='1' and v.dniAsesor='$dniUsuario' and dv.producto='1' and dv.tipo='1' and dv.plan='$p'";
                $resultado = mysqli_query($consulta,$sql);
                $cantidad = $resultado->num_rows;
                $ventasMay69 = $ventasMay69+$cantidad;
            }
        }
    }

    // progreso altas postpago
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and v.dniAsesor='$dniUsuario' and dv.producto='1' and dv.tipo='0' and dv.modalidad='1' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasAltPost = $resultado3->num_rows;

    // progreso altas prepago
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and v.dniAsesor='$dniUsuario' and dv.producto='1' and dv.tipo='0' and dv.modalidad='0' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasAltPre = $resultado3->num_rows;

    // progreso portabilidad prepago
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and v.dniAsesor='$dniUsuario' and dv.producto='1' and dv.tipo='1' and dv.modalidad='0' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasPortPre = $resultado3->num_rows;

    // progreso renovaciones
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and v.dniAsesor='$dniUsuario' and dv.producto='1' and dv.tipo='2' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasReno = $resultado3->num_rows;

    // progreso fija ftth
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and v.dniAsesor='$dniUsuario' and dv.producto='0' and (dv.modoFija='HFC' or dv.modoFija='FTTH') and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasFijaFtth = $resultado3->num_rows;

    // progreso fija ifi
    $sql3 = "SELECT * from detalleventas as dv inner join ventas as v on dv.sec=v.sec where (month(dv.registro)=month(CURRENT_TIMESTAMP) and year(dv.registro)=year(CURRENT_TIMESTAMP)) and v.dniAsesor='$dniUsuario' and dv.producto='0' and dv.modoFija='IFI' and dv.estado='1'";
    $resultado3 = mysqli_query($consulta,$sql3);
    $ventasFijaIfi = $resultado3->num_rows;
}
?>