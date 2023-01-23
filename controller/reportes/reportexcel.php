<?php
require_once '../../model/conexion.php';

$conexion = new conexion();
$con = $conexion->conectar();

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$mes= date('m');
$año= date('Y');
 
$MesActual = $meses[$mes-1]." del ".$año;

$columnas=['v.dniAsesor, u.nombre, v.dniCliente, c.nombre, v.estado, v.sec, v.origen, v.registro'];

$tabla='ventas as v INNER JOIN usuarios as u INNER JOIN clientes as c on v.dniAsesor=u.dni and v.dniCliente=c.dni';

$fecharequerida= !empty($_POST['busquedareportefechaventa']) ? $_POST['busquedareportefechaventa'] : null;
$dniModeradorMeta= !empty($_POST['busquedareporteasesorventa']) ? $_POST['busquedareporteasesorventa'] : null;
$dniAsesorMeta= !empty($_POST['busquedareporteasesorventa']) ? $_POST['busquedareporteasesorventa'] : null;
$buscarestado= isset($_POST['busquedareporteestadoventa']) ? $_POST['busquedareporteestadoventa'] : null;
$buscar= isset($_POST['busquedareporteventa']) ? $_POST['busquedareporteventa'] : null;

$mesre= date('m', strtotime($fecharequerida));
$añore= date('Y', strtotime($fecharequerida));

$fecharequeridaconver = $meses[$mesre-1]." del ".$añore;

$where='';

if ($fecharequerida != null) 
{
    $name = " - $fecharequeridaconver";
}
elseif ($fecharequerida == null) 
{
    $name = " - $MesActual";
}

if ($dniAsesorMeta != null) {
    $name .= " - ".$dniAsesorMeta;
    if ($buscarestado != null) {
        $name .= " - ".$dniAsesorMeta." - ".$buscarestado;
        if ($buscar!=null) {
            $name .= " - ".$dniAsesorMeta." - ".$buscarestado." - ".$buscar;
        }
    }
    elseif ($buscar!=null) {
        $name .= " - ".$dniAsesorMeta." - ".$buscar;
    }
}
if ($buscarestado != null and $dniAsesorMeta == null) {
    $name .= " - ".$buscarestado;
    if ($buscar!=null) {
        $name .= " - ".$buscarestado." - ".$buscar;
    }
}
elseif ($buscar!=null and $dniAsesorMeta == null and $buscarestado == null) {
    $name .= " - ".$buscar;
}

if (isset($_POST['btngenerarreporteventas'])) 
{
    // nombre del archivo
    header('Content-Type:text/csv; charset=latin1');
    header('Content-Disposition: attachment; filename="Reporte de Ventas'.$name.'.csv"');

    // salida de archivo
    $salida = fopen('php://output', 'w');
    // encabezados
    fputcsv($salida, array('logo de la empresa','nombre de la empresa','fecha de reporte'));
    fputcsv($salida, array('DNI-Asesor','Nombre-Asesor','DNI-Cliente','nombre-Cliente','Estado','SEC','Origen','Fecha de Registro'));
    // consulta para crear el reporte
    if ($fecharequerida != null) 
    {
        $where.="where (month(fechaRegistro)=month('$fecharequerida') and year(fechaRegistro)=year('$fecharequerida')) ";
    }
    elseif ($fecharequerida == null) 
    {
        $where.="where (month(fechaRegistro)=month(CURRENT_TIMESTAMP) and year(fechaRegistro)=year(CURRENT_TIMESTAMP)) ";
    }

    if ($dniAsesorMeta != null) {
        $where.="and dniAsesor='".$dniAsesorMeta."' ";
        if ($buscarestado != null) {
            $where.="and estado='".$buscarestado."' ";
            if ($buscar!=null) {
                $where.=" and (";
                $cont= count($columnasBus);
                for ($i=0; $i < $cont; $i++) { 
                    $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
                }
                $where=substr_replace($where, "", -3);
                $where.=")";
            }
        }
        elseif ($buscar!=null) {
            $where.=" and (";
            $cont= count($columnasBus);
            for ($i=0; $i < $cont; $i++) { 
                $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
            }
            $where=substr_replace($where, "", -3);
            $where.=")";
        }
    }
    if ($buscarestado != null and $dniAsesorMeta == null) {
        $where.="and estado='".$buscarestado."' ";
        if ($buscar!=null) {
            $where.=" and (";
            $cont= count($columnasBus);
            for ($i=0; $i < $cont; $i++) { 
                $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
            }
            $where=substr_replace($where, "", -3);
            $where.=")";
        }
    }
    elseif ($buscar!=null and $dniAsesorMeta == null and $buscarestado == null) {
        $where.="and (";
        $cont= count($columnasBus);
        for ($i=0; $i < $cont; $i++) { 
            $where.=$columnasBus[$i]." like '%".$buscar."%' or ";
        }
        $where=substr_replace($where, "", -3);
        $where.=")";
    }

    $sql = "select ".implode(", ", $columnas)." from $tabla $where order by codigo";
    $reporteventas=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($reporteventas))
    {
        $fechar = date('d/m/y', strtotime($row['fechaRegistro']));
        $fechaa = date('d/m/y', strtotime($row['fechaActualizacion']));
        
        if ($row['estado'] == "0") 
        {
            $estadorepor = "No Requiere";
        }
        elseif ($row['estado'] == "1") 
        {
            $estadorepor = "Concretado";
        }
        elseif ($row['estado'] == "2") 
        {
            $estadorepor = "Pendiente";
        }

        if ($row['modalidad'] == "0") 
        {
            $modalidadrepor = "Prepago";
        }
        elseif ($row['modalidad'] == "1") 
        {
            $modalidadrepor = "Postpago";
        }
        elseif ($row['modalidad'] == "-") 
        {
            $modalidadrepor = "---";
        }

        if ($row['producto'] == "0") 
        {
            $productorepor = "Fija";
        }
        elseif ($row['producto'] == "1") 
        {
            $productorepor = "Movil";
        }

        if ($row['tipo'] == "0") 
        {
            $tiporepor = "Linea Nueva";
        }
        elseif ($row['tipo'] == "1") 
        {
            $tiporepor = "Portabilidad";
        }
        elseif ($row['tipo'] == "2") 
        {
            $tiporepor = "Renovacion";
        }
        elseif ($row['tipo'] == "-") 
        {
            $tiporepor = "---";
        }

        if ($row['tipoFija'] == "0") 
        {
            $tipofijarepor = "Alta";
        }
        elseif ($row['tipoFija'] == "1") 
        {
            $tipofijarepor = "Portabilidad";
        }
        elseif ($row['tipoFija'] == "-") 
        {
            $tipofijarepor = "---";
        }

        fputcsv($salida, array($row['codigo'],
                                $row['dniAsesor'],
                                $row['nombre'],
                                $row['dni'],
                                $row['telefono'],
                                $productorepor,
                                $row['lineaProcedente'],
                                $row['operadorCedente'],
                                $modalidadrepor,
                                $tiporepor,
                                $row['planR'],
                                $row['equipo'],
                                $row['formaDePago'],
                                $row['numeroReferencia'],
                                $row['sec'],
                                $tipofijarepor,
                                $row['planFija'],
                                $row['modoFija'],
                                $estadorepor,
                                $row['observaciones'],
                                $row['promocion'],
                                $row['ubicacion'],
                                $row['distrito'],
                                $fechar,
                                $fechaa));
    }
}
?>