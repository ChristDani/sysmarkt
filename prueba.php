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
